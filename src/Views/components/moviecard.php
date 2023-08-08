<div class="card movie-card">
    <div class="card-img-top" style="background-image: url({{ movie.getImageMovie() }});"></div>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i> 
            <span class="rating"> {{ movie.rating }} </span>
        </p>
        <h5 class="card-title"> 
            <a href="{{ url_for('movie.view', {id: movie.id}) }}">{{ movie.title }}</a>
        </h5>
        <a href="{{ url_for('movie.view', {id: movie.id}) }}" class="btn btn-primary rate-btn">Avaliar</a>
        <a href="{{ url_for('movie.view', {id: movie.id}) }}" class="btn btn-primary rate-btn">Conhecer</a>
    </div>
</div>