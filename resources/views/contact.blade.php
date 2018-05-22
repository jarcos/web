@extends('layouts.base')

@section('content')

    <div class="form-header"></div>

    <div class="form container">
        <h2>Formulario de contacto</h2>
        <div class="col-12 col-md-8 ml-auto mr-auto mt-5 mb-5">
            <p>Estás a un paso de crear una página web para tu asociación. Rellena los datos del formulario de abajo y la página web se generará de forma automática tras unos segundos.</p>
            <p>Los datos como la dirección, teléfono, CIF u otros datos privados no serán públicos, jamás.</p>
        </div>
        <div class="col-12 col-md-8 ml-auto mr-auto mt-5 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form action="{{ route('contact') }}" method="POST">
                        {{ csrf_field() }}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Tu nombre:</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Escribe tu nombre..." required>
                        </div>

                        <div class="form-group">
                            <label for="email">Tu correo electrónico:</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Escribe tu correo electrónico..." required>
                        </div>

                        <input type="text" name="email2" class="d-none">

                        <div class="form-group">
                            <label for="subject">Asunto:</label>
                            <select id="subject" class="form-control" name="subject" required>
                                <option value="Obtener información">Obtener información</option>
                                <option value="Somos un refugio y queremos usar ProteCMS">Somos un refugio y queremos usar ProteCMS</option>
                                <option value="Soy desarrollador/diseñador/traductor y quiero colaborar">Soy desarrollador/diseñador/traductor y quiero colaborar</option>
                                <option value="Somos una empresa y queremos colaborar con el proyecto">Somos una empresa y queremos colaborar con el proyecto</option>
                                <option value="Otro asunto">Otro asunto</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">Mensaje:</label>
                            <textarea id="text" class="form-control" name="text" placeholder="Escribe el mensaje..." rows="10" required></textarea>
                        </div>

                        <div class="form-group mt-5 text-right">
                            <button class="btn btn-outline-primary btn-lg">Continuar <i class="fas fa-angle-right"></i></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection