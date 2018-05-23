<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/#features">Características</a></li>
                    <li><a href="/#gallery">Galería</a></li>
                    <li><a href="{{ route('shelters') }}">Asociaciones</a></li>
                    <li><a href="{{ route('contact') }}">Contacto</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <ul>
                    <li class="d-none"><a href="/preguntas-frecuentes">Preguntas frecuentes</a></li>
                    <li><a href="{{ route('policy') }}">Política de privacidad</a></li>
                    <li><a href="{{ route('terms') }}">Términos y condiciones</a></li>
                    <li><a href="https://github.com/protecms" target="_blank">Para desarrolladores</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6 social">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <p>Redes sociales de proyecto</p>
                    </div>
                </div>
                <div class="icons row text-center">
                    <div class="col-4">
                        <a href="https://facebook.com/protecms"><i class="fab fa-facebook fa-fw fa-3x" title="Facebook ProteCMS"></i></a>
                    </div>
                    <div class="col-4">
                        <a href="https://twitter.com/protecms"><i class="fab fa-twitter fa-fw fa-3x" title="Twitter ProteCMS"></i></a>
                    </div>
                    <div class="col-4">
                        <a href="https://github.com/protecms"><i class="fab fa-github fa-fw fa-3x" title="Github ProteCMS"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <p class="copyright">Copyright &copy; 2015-{{ date('Y') }} - Todos los derechos reservados.</p>
            <p class="author">Creado por
                <a href="http://jaimesares.com" target="_blank">
                    <img src="{{ asset('images/jaimesares.jpg') }}" class="rounded-circle avatar" alt=""> Jaime Sares
                </a>
            </p>
        </div>
    </div>
</footer>