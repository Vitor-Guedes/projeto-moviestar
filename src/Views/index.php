{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}
<div id="main-container" class="container-fluid">
    <h2 class="section-title">
        Novos Filmes
    </h2>
    <p class="section-description">
        Veja as criticas dos ultimos filmes adicionados no MovieStar
    </p>
    <div class="movies-container">
        {% for movie in movieService.getLastMovies() %}
            {% include('components/moviecard.php') %}
        {% else %}
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        {% endfor %}
    </div>
</div>
{% include('components/footer.php') %}
{% endblock %}