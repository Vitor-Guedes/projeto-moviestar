{% extends "template.php" %}

{% block content %}

{% include('components/header.php') %}

{% include('components/messages.php') %}

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="{{ url_for('login') }}" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Digite seu email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" placeholder="Digite sua senha" id="password" name="password">
                    </div>
                    <button class="btn card-btn" type="submit">Entrar</button>
                </form>
            </div>
            <div class="col-md-4" id="register-container">
                <h2>Criar Conta</h2>
                <form action="{{ url_for('register') }}" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Digite seu Nome" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome</label>
                        <input type="text" class="form-control" placeholder="Digite seu sobrenome" id="lastname" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Digite seu email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" placeholder="Digite sua senha" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmação de Senha</label>
                        <input type="password" class="form-control" placeholder="Confirme sua senha" id="confirmpassword" name="confirmpassword">
                    </div>
                    <button class="btn card-btn" type="submit">Cadastrar-se</button>
                </form>
            </div>
        </div>
    </div>
</div>
{% endblock %}