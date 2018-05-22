@component('mail::message')
# Nuevo mensaje de contacto

**Nombre**: {{ request()->get('name') }}

**Correo electrónico**: {{ request()->get('email') }}

**Asunto**: {{ request()->get('subject') }}


**Mensaje**:

{{ request()->get('text') }}
@endcomponent
