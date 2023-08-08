<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
        <a href="{{ url_for('home') }}" class="navbar-brand">
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
                {% if (user) %}
                    <li class="nav-item">
                        <a href="{{ url_for('movie.add') }}" class="nav-link">
                            <i class="far fa-plus-square"></i> Incluir Filme
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url_for('dashboard') }}" class="nav-link">Meus Filmes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url_for('user.edit-profile') }}" class="nav-link bold">
                            {{ user.name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url_for('logout') }}" class="nav-link">Sair</a>
                    </li>
                {% else %}
                    <li class="nav-item">
                        <a href="{{ url_for('account') }}" class="nav-link">Entrar | Cadastrar</a>
                    </li>
                {% endif %}
            </ul>
        </div>
    </nav>
</header>