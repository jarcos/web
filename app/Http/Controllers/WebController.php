<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\NewShelter;
use App\Models\Form;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Shelter;
use App\Models\ShelterConfig;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shelters()
    {
        return view('shelters');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('terms');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function policy()
    {
        return view('policy');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(Request $request)
    {
        if ($request->method() === 'POST') {

            if ($request->get('email2') !== null) {
                return redirect('/');
            }

            $v = Validator::make(request()->all(), [
                'name' => 'required|max:200',
                'email' => 'required|email|max:200',
                'subject' => 'required|max:200',
                'text' => 'required|max:2000'
            ]);

            if ($v->fails()) {
                session()->flash('flash', [
                    'title' => 'Error al enviar el mensaje',
                    'text' => 'Por favor, compruebe los campos del formulario. Si el problema persiste contacte mediante una red social o usando su cliente de correo electrónico',
                    'type' => 'error'
                ]);

                return redirect()->back()->withErrors($v);
            }

            Mail::to(config('mail.from.address'))->send(new Contact());

            session()->flash('flash', [
                'title' => 'Mensaje enviado correctamente',
                'text' => 'Gracias por contactar. Le responderemos lo antes posible.',
                'type' => 'success'
            ]);

            return redirect()->back();
        }

        return view('contact');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new_shelter(Request $request)
    {
        if ($request->method() === 'POST') {

            if ($request->get('email2') !== null) {
                return redirect('/');
            }

            $v = Validator::make(request()->all(), [
                'name' => 'required|max:200',
                'email' => 'required|email|max:200|unique:shelters,email',
                'cif' => 'max:200',
                'phone' => 'required|max:200',
                'address' => 'required|max:200',
                'country_id' => 'required|exists:countries,id',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',
                'description' => 'required|max:500',
                'subdomain' => 'required|unique:shelters,subdomain'
            ]);

            if ($v->fails()) {
                session()->flash('flash', [
                    'title' => 'Error al registrar la asociación',
                    'text' => 'Por favor, compruebe los campos del formulario. Si el problema persiste contacte con un administrador a través del formulario de contacto o mediante una red social.',
                    'type' => 'error'
                ]);

                return redirect()->back()->withErrors($v)->withInput();
            }

            $return = $this->createShelter($request);

            if (! $return) {
                session()->flash('flash', [
                    'title' => 'Error al registrar la asociación',
                    'text' => 'Por favor, compruebe los campos del formulario. Si el problema persiste contacte con un administrador a través del formulario de contacto o mediante una red social.',
                    'type' => 'error'
                ]);

                return redirect()->back()->withInput();
            }

            session()->flash('flash', [
                'title' => 'Asociación registrada correctamente',
                'text' => 'Gracias por confiar en el proyecto, su asociación ha sido registrada con éxito. En pocos minutos recibirá un correo electronico con el resumen de la configuración. Ya puede acceder al panel de administración y empezar a configurar su página web.',
                'type' => 'success'
            ]);

            Mail::to($request->get('email'))
                ->bcc(config('mail.from.address'))
                ->send(new NewShelter($return));

            session()->flash('install', [
                'shelter' => $return['shelter'],
                'password' => $return['password']
            ]);

            return redirect()->route('new_shelter_created');
        }

        return view('new_shelter');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new_shelter_created()
    {
        if (! session()->has('install')) {
            return redirect()->route('index');
        }

        return view('new_shelter_created', [
            'shelter' => session()->get('install.shelter'),
            'password' => session()->get('install.password'),
        ]);
    }

    public function createShelter(Request $request)
    {
        DB::beginTransaction();

        try {
            $shelter = Shelter::forceCreate([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subdomain' => $request->get('subdomain'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'country_id' => $request->get('country_id'),
                'state_id' => $request->get('state_id'),
                'city_id' => $request->get('city_id'),
                'cif' => $request->get('cif'),
                'description' => $request->get('description'),
            ]);

            $config = ShelterConfig::getDefaults();

            $config['web_animals_contactemail'] = $shelter->email;

            $shelter->setConfigs($config);

            $password = strtolower(str_random(8));
            $user = User::forceCreate([
                'shelter_id' => $shelter->id,
                'name' => 'Administrador',
                'email' => $request->get('email'),
                'password' => $password,
                'type' => 'admin',
                'status' => 'active'
            ]);

            /**
             * Categories.
             */
            $category = PostCategory::forceCreate([
                'shelter_id' => $shelter->id,
                'title' => 'General',
                'slug'  => 'general',
            ]);
            PostCategory::forceCreate([
                'shelter_id' => $shelter->id,
                'title' => 'Noticias',
                'slug'  => 'noticias',
            ]);
            PostCategory::forceCreate([
                'shelter_id' => $shelter->id,
                'title' => 'Eventos',
                'slug'  => 'eventos',
            ]);
            /*
             * Posts
             */
            Post::forceCreate([
                'shelter_id' => $shelter->id,
                'category_id'     => $category->id,
                'status'          => 'published',
                'published_at'    => date('Y-m-d\TH:i'),
                'comments_status' => 1,
                'user_id' => $user->id,
                'title'   => 'Bienvenid@ a la web de tu protectora',
                'slug'    => 'bienvenido-a-la-web-de-tu-protectora',
                'text'    => '<p>¡La web de tu protectora se ha generado correctamente!</p><p>Si quieres editar este artículo puedes hacerlo en el panel de administración</p>',
            ]);
            /*
             * Pages
             */
            $pages[] = Page::forceCreate([
                'shelter_id' => $shelter->id,
                'status'       => 'published',
                'published_at' => date('Y-m-d\TH:i'),
                'user_id' => $user->id,
                'title'   => 'Quiénes somos',
                'slug'    => 'quienes-somos',
                'text'    => '<p>Modifica esta p&aacute;gina con los datos e historia de la protectora.</p>
<p>Muchos usuarios quieren saber c&oacute;mo se fund&oacute;. C&oacute;mo empez&oacute; todo. Esta p&aacute;gina es perfecta para ello.</p>
<p>Puedes modificarla a trav&eacute;s del panel de administraci&oacute;n, en la secci&oacute;n P&aacute;ginas.</p>',
            ]);
            $pages[] = Page::forceCreate([
                'shelter_id' => $shelter->id,
                'status'       => 'published',
                'published_at' => date('Y-m-d\TH:i'),
                'user_id' => $user->id,
                'title'   => 'Ayúdanos',
                'slug'    => 'ayudanos',
                'text'    => '<p>Modifica esta p&aacute;gina con las opciones que tienen los voluntarios y no voluntarios de ayudar a la protectora.</p>
<p>Hay muchos tipos de ayuda: transporte, donaciones, limpieza, etc. Describe c&oacute;mo pueden ayudar y qu&eacute; tienen que hacer.</p>
<p>Esta p&aacute;gina la puedes modificar en el panel de administraci&oacute;n.</p>',
            ]);
            $pages[] = Page::forceCreate([
                'shelter_id' => $shelter->id,
                'status'       => 'published',
                'published_at' => date('Y-m-d\TH:i'),
                'user_id' => $user->id,
                'title'   => 'Donaciones',
                'slug'    => 'donaciones',
                'text'    => '<p>Modifica esta p&aacute;gina con los datos de la cuenta bancaria donde poder realizar ingresos y otras formas de donaciones.</p>
<p>Esta p&aacute;gina la puedes modificar en el panel de administraci&oacute;n.</p>',
            ]);
            /**
             * Forms.
             */
            $form = Form::forceCreate([
                'shelter_id' => $shelter->id,
                'email'  => $shelter->email,
                'status' => 'published',
                'user_id' => $user->id,
                'title'   => 'Contacto',
                'slug'    => 'contacto',
                'subject' => 'Contacto',
                'text'    => '<p>Puedes contactar con nosotros mediante el siguiente formulario.</p>',
            ]);
            $fields = [
                'name'    => 'text',
                'subject' => 'text',
                'email'   => 'email',
                'message' => 'textarea',
            ];
            $order = 1;
            foreach ($fields as $key => $value) {
                $form->fields()->forceCreate([
                    'form_id' => $form->id,
                    'order'    => $order,
                    'name'     => $order,
                    'type'     => $value,
                    'required' => 1,
                    'title' => ucfirst(trans('validation.attributes.'.$key)),
                ]);
                $order++;
            }
            /**
             * Widgets.
             */
            $widget = Widget::forceCreate([
                'shelter_id' => $shelter->id,
                'status' => 'active',
                'side'   => 'left',
                'order'  => 1,
                'type'   => 'menu',
                'title' => 'Menú principal',
            ]);
            $widget->links()->forceCreate([
                'widget_id' => $widget->id,
                'type' => 'link',
                'title' => 'Inicio',
                'link'  => '/',
            ]);
            foreach ($pages as $page) {
                $widget->links()->forceCreate([
                    'widget_id' => $widget->id,
                    'type' => 'link',
                    'title' => $page->title,
                    'link'  => '/pagina/'.$page->id.'-'.$page->slug,
                ]);
            }
            $widget->links()->forceCreate([
                'widget_id' => $widget->id,
                'type' => 'link',
                'title' => $form->title,
                'link'  => '/formulario/'.$form->id.'-'.$form->slug,
            ]);
            $widget = Widget::forceCreate([
                'shelter_id' => $shelter->id,
                'status' => 'active',
                'side'   => 'left',
                'order'  => 2,
                'type'   => 'menu',
                'title' => 'Animales',
            ]);
            $widget->links()->forceCreate([
                'widget_id' => $widget->id,
                'type' => 'link',
                'title' => 'Todos los animales',
                'link'  => '/animales',
            ]);
            $widget->links()->forceCreate([
                'widget_id' => $widget->id,
                'type' => 'link',
                'title' => 'Perros en adopción',
                'link'  => '/animales?especie=perros&estado=en-adopcion',
            ]);
            $widget->links()->forceCreate([
                'widget_id' => $widget->id,
                'type' => 'link',
                'title' => 'Gatos en adopción',
                'link'  => '/animales?especie=gatos&estado=en-adopcion',
            ]);
            Widget::forceCreate([
                'shelter_id' => $shelter->id,
                'status' => 'active',
                'side'   => 'right',
                'order'  => 1,
                'type'   => 'protecms',
                'file'   => 'animals_search',
                'title' => 'Buscador de animales',
            ]);
            Widget::forceCreate([
                'shelter_id' => $shelter->id,
                'status' => 'active',
                'side'   => 'right',
                'order'  => 2,
                'type'   => 'protecms',
                'file'   => 'last_animals',
                'title' => 'Últimas fichas',
            ]);

            DB::commit();

            return [
                'shelter' => $shelter,
                'password' => $password,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return false;
    }
}
