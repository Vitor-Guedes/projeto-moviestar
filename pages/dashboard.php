<?php 
    $userData = $userDao->verifyToken(true);
    
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou.</p>
    <div class="col-md-12" id="add-movie-container">
        <a href="<?= BASE_URL ?>/newmovie" class="btn card-btn">
            <i class="fas fa-plus"></i> Adicionar Filme
        </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Nota</th>
                <th scope="col" class="action-column">Ações</th>
            </thead>
            <tbody>
                <?php foreach ($movieDao->getMoviesByUserId($userData->id) as $movie) : ?>
                    <tr>
                        <td scope="row">1</td>
                        <td><a href="<?= BASE_URL ?>/movie/<?= $movie->id ?>" class="table-movie-title"><?= $movie->title ?></a></td>
                        <td><i class="fas fa-star"></i> <?= $movie->rating ?></td>
                        <td class="actions-column">
                            <a href="<?= BASE_URL ?>/edit-movie/<?= $movie->id ?>" class="edit-btn"><i class="far fa-edit"></i> Editar </a>
                            <form action="<?= BASE_URL ?>/process/movie/delete" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $movie->id ?>">
                                <button type="submit" class="delete-btn">
                                    <i class="fas fa-times"></i> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>
</div>