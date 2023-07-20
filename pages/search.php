<?php
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);
  
    $query = $_GET['search'];
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Você esta buscando por: <?= $query ?></h2>
    <p class="section-description">
        Veja as criticas dos ultimos filmes adicionados no MovieStar
    </p>
    <div class="movies-container">
        <?php if(!($searchMovies = $movieDao->findByTitle("%$query%"))) : ?>
            <p class="empty-list">Não há filmes para essa busca ! <a href="<?= BASE_URL ?>">Voltar</a></p>
        <?php else : ?>
            <?php foreach ($searchMovies as $movie) : ?>
                <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
            <?php endforeach ; ?>
        <?php endif ?>
    </div>
</div>