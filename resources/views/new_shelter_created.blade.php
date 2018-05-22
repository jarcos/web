@extends('layouts.base')

@section('content')

    <div class="new-shelter-created-header"></div>

    <div class="new-shelter container">
        <h2>Asociación registrada correctamente</h2>
        <div class="col-12 col-lg-8 ml-auto mr-auto mt-5 mb-5">
            <p>Se ha registrado la asociación con éxito. En unos minutos recibiréis un mensaje en el correo electrónico indicado con los datos de acceso tanto a la página web como al panel de administración.</p>
        </div>
        <div class="col-12 col-lg-8 ml-auto mr-auto mt-5 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form action="">

                        <h4>Datos de la asociación</h4>

                        <div class="form-group">
                            <label for="name">Nombre de la asociación:</label>
                            <input type="text" id="name" class="form-control" value="{{ $shelter->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico de la asociación:</label>
                            <input type="email" id="email" class="form-control" value="{{ $shelter->email }}" readonly>
                        </div>

                        <hr>

                        <h4>Datos del usuario administrador</h4>

                        <div class="form-group">
                            <label for="useremail">Correo electrónico del administrador:</label>
                            <input type="email" id="useremail" class="form-control" value="{{ $shelter->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Contraseña del administrador:</label>
                            <input type="text" id="userpassword" class="form-control" value="{{ $password }}" readonly>
                            <small class="form-text text-muted">
                                La contraseña se ha encriptado antes de ser almacenada
                            </small>
                        </div>

                        <h4>Datos de la página web</h4>

                        <div class="form-group">
                            <label for="url">Dirección de la página web:</label>
                            <input type="email" id="url" class="form-control" value="http://{{ $shelter->subdomain }}.protecms.com" readonly>
                        </div>

                        <div class="form-group text-center">
                            <a href="http://{{ $shelter->subdomain }}.protecms.com" class="btn btn-outline-primary btn-lg" target="_blank">Ir a la página web <i class="fas fa-external-link-alt"></i></a>
                        </div>

                        <div class="form-group text-center">
                            <a href="http://{{ $shelter->subdomain }}.protecms.com/admin" class="btn btn-primary btn-lg" target="_blank">Acceder al panel de administración <i class="fas fa-external-link-alt"></i></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection