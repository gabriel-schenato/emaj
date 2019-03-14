<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">        
        <a class="navbar-brand" href="{{ route('institucional.home') }}">
            <img src="/images/logo_branca.png" height="80" width="75" alt="EMAJ" id="logo" class="navbar-brand">
            EMAJ
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('institucional.home') }}" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="{{ route('institucional.sobre') }}" class="nav-link">Sobre</a></li>
                <li class="nav-item"><a href="practice-areas.html" class="nav-link">Como Funciona</a></li>
                <li class="nav-item"><a href="attorneys.html" class="nav-link">Contato</a></li>
                <li class="nav-item"><a href="{{ route('portal.home') }}/" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->