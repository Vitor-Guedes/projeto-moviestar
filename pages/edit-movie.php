<?php
    $userData = $userDao->verifyToken(true);
        
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);
    $movie = $movieDao->findById($movieId);

    if ($movie->user_id !== $userData->id) {
        (new Message(BASE_URL))->setMessage(
            'Filme não encontrado!',
            'error',
            '/'
        );
    }
?>

<div class="main-container container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $movie->title ?></h1>
                <p class="page-description">Altere os dados do filme no formulario abaixo:</p>
                <form id="edit-movie-form" action="<?= BASE_URL ?>/process/update/movie" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $movie->id ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="<?= $movie->title ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="length">Duração</label>
                        <input type="text" name="length" id="length" value="<?= $movie->length ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria</label>
                        <select type="text" name="category" id="category" class="form-control">
                            <option value=""></option>
                            <option value="Ação" <?= $movie->category === 'Ação' ? 'selected' : '' ?>>Ação</option>
                            <option value="Drama" <?= $movie->category === 'Drama' ? 'selected' : '' ?>>Drama</option>
                            <option value="Comédia" <?= $movie->category === 'Comédia' ? 'selected' : '' ?>>Comédia</option>
                            <option value="Fantasia" <?= $movie->category === 'Fantasia' ? 'selected' : '' ?>>Fantasia</option>
                            <option value="Ficção" <?= $movie->category === 'Ficção' ? 'selected' : '' ?>>Ficção</option>
                            <option value="Terror" <?= $movie->category === 'Terror' ? 'selected' : '' ?>>Terror</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Treiler</label>
                        <input type="text" name="trailer" id="trailer" value="<?= $movie->trailer ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Descreva o filme"><?= $movie->description ?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Atualizar Filme">
                </form>
            </div>
            <div class="col-md-3">
                <div class="movie-image-container" style="background-image: url('<?= $movie->getImageMovie() ?>');"></div>
            </div>
        </div>
    </div>
</div>