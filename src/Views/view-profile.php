{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}

{% include('components/messages.php') %}

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title">{{ _user.getFullName() }}</h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('{{ _user.getImageUser() }}');"></div>
                <h3 class="about-title">Sobre:</h3>
                {% if not _user.bio %}
                    <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
                {% else %}
                    <p class="profile-description">{{ _user.bio }}</p>
                {% endif %}
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes que enviou:</h3>
                <div class="movies-container">
                    {% for movie in movieService.getMoviesByUserId(_user.id) %}
                        {% include('components/moviecard.php') %}
                    {% else %}
                        <p class="empty-list">Ainda não há filmes cadastrados!</p>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
</div>
{% include('components/footer.php') %}
{% endblock %}