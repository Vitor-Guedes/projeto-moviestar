<?php
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);
    $user = $userDao->findById($userId);

    if (!$user) {
        (new Message(BASE_URL))->setMessage(
            'Usuário não encontrado!',
            'error',
            '/'
        );
    }

    if ($user->id === $userData->id) {
        (new Message(BASE_URL))->setMessage(
            '',
            '',
            '/edit/profile'
        );
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?= $user->getFullName() ?></h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $user->getImageUser() ?>');"></div>
                <h3 class="about-title">Sobre:</h3>
                <?php if (!empty($user->bio)) : ?>
                    <p class="profile-description"><?= $user->bio ?></p>
                <?php else : ?>
                    <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
                <?php endif ; ?>
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes que enviou:</h3>
                <div class="movies-container">
                    <?php if(!($userMovies = $movieDao->getMoviesByUserId($user->id))) : ?>
                        <p class="empty-list">Ainda não há filmes cadastrados!</p>
                    <?php else : ?>
                        <?php foreach ($userMovies as $movie) : ?>
                            <?php require(TEMPLATES_DIR . '/movie-card.php') ?>
                        <?php endforeach ; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>