@extends('layouts.base')

@section('content')

    <div class="new-shelter-header"></div>

    <div class="new-shelter container">
        <h2>Registrar una nueva asociación</h2>
        <div class="col-12 col-md-8 ml-auto mr-auto mt-5 mb-5">
            <p>Estás a un paso de crear una página web para tu asociación. Rellena los datos del formulario de abajo y la página web se generará de forma automática tras unos segundos.</p>
            <p>Los datos como la dirección, teléfono, CIF u otros datos privados no serán públicos, jamás.</p>
        </div>
        <div class="col-12 col-md-8 ml-auto mr-auto mt-5 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form action="{{ route('new_shelter') }}" method="POST">
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

                        <h4>Datos de la asociación</h4>

                        <div class="form-group">
                            <label for="name">Nombre de la asociación:</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Ej. Asociación Lara" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico de la asociación:</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Ej. asociacionlara@gmail.com" value="{{ old('email') }}">
                            <input type="text" id="emailw" class="form-control d-none" name="email2" placeholder="Ej. asociacionlara@gmail.com" value="">
                        </div>

                        <div class="form-group">
                            <label for="cif">Identificador fiscal:</label>
                            <input type="text" id="cif" class="form-control" name="cif" placeholder="Ej. A58818501" value="{{ old('cif') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="Ej. +34 690 12 34 56" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="Ej. c/ Del Coral, 5" value="{{ old('address') }}">
                        </div>

                        <div class="form-group">
                            <label for="country_id">País:</label>
                            <select id="country_id" class="form-control select-country" name="country_id">
                                @foreach (DB::table('countries')->orderBy('name')->get() as $country)
                                    <option value="{{ $country->id }}" {{ $country->iso === 'ES' ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="state_id">Provincia:</label>
                            <select id="state_id" class="form-control select-state" name="state_id">
                                <option value="" disabled selected>Seleccione una provincia</option>
                                @foreach (DB::table('states')->where('country_id', 205)->orderBy('name')->get() as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="city_id">Ciudad:</label>
                            <select id="city_id" class="form-control select-city" name="city_id" disabled>
                                <option value="" disabled selected>Debe seleccionar una provicina</option>
                            </select>
                            <small class="form-text text-muted">
                                Si no encuentra la ciudad, seleccione otra y repórtelo a un administrador
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción de la asociación:</label>
                            <textarea id="description" class="form-control" name="description" placeholder="Explica brevemente vuestra asociación" rows="5">{{ old('description') }}</textarea>
                        </div>

                        <hr>

                        <h4>Datos de la página web</h4>

                        <div class="form-group">
                            <label for="subdomain">Dirección de la página web</label>
                            <div class="input-group">
                                <input type="text" id="subdomain" class="form-control text-right" name="subdomain" placeholder="Ej. asociacionlara" value="{{ old('subdomain') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">.protecms.com</span>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Una vez creada la página web podréis indicar un dominio propio
                            </small>
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