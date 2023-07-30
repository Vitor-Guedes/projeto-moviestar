<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
        <a href="{{ base_path() }}" class="navbar-brand">
            <img src="{{ base_path() }}/images/logo.svg" alt="MovieStar" id="logo">
            <span id="moviestar-title">MovieStar</span>
        </a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbar"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <form action="{{ base_path() }}/search" method="get" id="search-form" class="form-inline my-2 my-lg-0">
            <input type="text" name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Filmes" aria-label="Search">
            <button class="btn my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <?php if ($userData) : ?>

                    <li class="nav-item">
                        <a href="{{ base_path() }}/newmovie" class="nav-link">
                            <i class="far fa-plus-square"></i> Incluir Filme
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ base_path() }}/dashboard" class="nav-link">Meus Filmes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ base_path() }}/edit/profile" class="nav-link bold">
                            $userData->name
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ base_path() }}/logout" class="nav-link">Sair</a>
                    </li>
                        
                <?php else : ?>

                    <li class="nav-item">
                        <a href="{{ base_path() }}/auth" class="nav-link">Entrar | Cadastrar</a>
                    </li>

                <?php endif ;?>
            </ul>
        </div>
    </nav>
</header>