<header class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('images/logos/logo_original.png') }}" alt="ProteCMS">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/#features">Características</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#gallery">Galería</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shelters') }}">Asociaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com/protecms" target="_blank"><i class="fab fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://twitter.com/protecms" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
            </ul>
        </div>
    </div>
</header>