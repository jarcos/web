@component('mail::message')
# Bienvenidos a ProteCMS

Hola,

Antes de nada me presento, soy Jaime, el creador de proyecto. Muchas gracias por confiar en el proyecto.

La página web de vuestra asociación se ha registrado correctamente. Los datos del registro son los siguientes:

**Nombre**: {{ $data['shelter']->name }}

**Correo electrónico**: {{ $data['shelter']->email }}

**Dirección de la página web**: {{ $data['shelter']->getUrl() }}


Los datos de acceso del usuario administrador son:

**Correo electrónico**: {{ $data['shelter']->email }}

**Contraseña**: {{ $data['password'] }}

@component('mail::button', ['url' => $data['shelter']->getUrl()])
    Acceder a la página web
@endcomponent

@component('mail::button', ['url' => $data['shelter']->getUrl() . '/admin'])
    Acceder al panel de administración
@endcomponent

Si tiene alguna duda o sugerencia, no dudes en ponerte en contacto a través del formulario de contacto de la página web de proyecto o dentro del panel de administración en la sección Soporte.

Un saludo,<br>
Jaime
@endcomponent
