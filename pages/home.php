<?php 
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">
        Novos Filmes
    </h2>
    <p class="section-description">
        Veja as criticas dos ultimos filmes adicionados no MovieStar
    </p>
    <div class="movies-container">
        <?php if(!($lastestMovies = $movieDao->getLastMovies())) : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php else : ?>
            <?php foreach ($lastestMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>

    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <?php if(!($categoryMovies = $movieDao->getMoviesByCategory('Ação'))) : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php else : ?>
            <?php foreach ($categoryMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>

    <h2 class="section-title">Terror</h2>
    <p class="section-description">Veja os melhores filmes de Terror</p>
    <div class="movies-container">
        <?php if(!($categoryMovies = $movieDao->getMoviesByCategory('Terror'))) : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php else : ?>
            <?php foreach ($categoryMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>

    <h2 class="section-title">Drama</h2>
    <p class="section-description">Veja os melhores filmes de Drama</p>
    <div class="movies-container">
        <?php if(!($categoryMovies = $movieDao->getMoviesByCategory('Drama'))) : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php else : ?>
            <?php foreach ($categoryMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>

    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de Comédia</p>
    <div class="movies-container">
        <?php if(!($categoryMovies = $movieDao->getMoviesByCategory('Comédia'))) : ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
        <?php else : ?>
            <?php foreach ($categoryMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>
</div>