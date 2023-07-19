<?php $userDao->verifyToken(true); ?>

<div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
        <form action="<?= BASE_URL ?>/process/update-user" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?= $userData->id ?>">
            <div class="row align-center">
                <div class="col-md-6">
                    <h1><?= $userData->getFullName() ?></h1>
                    <p class="page-description">Altere seus dados no formulário abaixo:</p>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Digite seu nome" value="<?= $userData->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" readonly id="email" name="email" class="form-control disable" placeholder="Digite seu email" value="<?= $userData->email ?>">
                    </div>
                    <input type="submit" value="Alterar" class="btn card-btn">
                </div>
                <div class="col-md-6">
                    <div id="profile-image-container" style="background-image: url('<?= $userData->getImageUser() ?>');"></div>
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="bio">Sobre você</label>
                        <textarea class="form-control" name="bio" id="bio" cols="30" rows="5" placeholder="Conte quem é, o que faz e onde trabalha."><?= $userData->bio ?></textarea>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" id="change-password-container">
            <div class="col-md-4">
                <h2>Alterar a senha</h2>
                <p class="page-description">Digite a nova senha e confirme, para alterar a senha:</p>
                <form action="<?= BASE_URL ?>/process/update-password" method="post">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua nova senha">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmação de Senha</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Digite sua nova senha">
                    </div>
                    <input type="submit" value="Alterar Senha" class="btn card-btn">
                </form>
            </div>
        </div>
    </div>
</div>