{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}

{% set userOwnsMovie = (user.id == movie.user_id) %}
{% set alreadyReviwed = reviewService.hasAlreadyReviwed(movie.id, user.id) %}
<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title">{{ movie.title }}</h1>
            <p class="movie-details">
                <span>Duração: {{ movie.length }}</span>
                <span class="pipe"></span>
                <span>{{ movie.category }}</span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> {{ reviewService.getRatings(movie.id) }} </span>
            </p>
            <iframe allowfullscreen src="{{ movie.trailer }}" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipbord-write; encryted-media; gyroscope; picture-in-picture"></iframe>
            <p>{{ movie.description }}</p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image: url('{{ movie.getImageMovie() }}');"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 class="reviews-title">Avaliações:</h3>
        </div>
        {% if user and not userOwnsMovie and not alreadyReviwed %}
            <div class="offset-md-1 col-md-10" id="review-form-container">
                <h4>Envie sua avaliação</h4>
                <p class="page-description">Preencha o formuário com a nota e comentario sobre o filme</p>
                <form action="{{ url_for('review.store') }}" id="review-form" method="post">
                    <input type="hidden" name="movie_id" value="{{ movie.id }}">
                    <div class="form-group">
                        <label for="rating">Nota do Filme:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Selecione</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Seu Comentário</label>
                        <textarea name="review" id="review" cols="30" rows="5" class="form-control" placeholder="O que achou do filme?"></textarea>
                    </div>
                    <input type="submit" value="Enviar comentário" class="btn card-btn">
                </form>
            </div>
        {% endif %}
        {% for review in reviewService.getMovieReview(movie.id) %}
            {% include('components/userreviews.php') %}
        {% else %}
            <p class="empty-list">Não ha comentarios para esse filme ainda</p>
        {% endfor %}
    </div>
</div>

{% include('components/footer.php') %}
{% endblock %}