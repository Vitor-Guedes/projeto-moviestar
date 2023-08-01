{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}

{% include('components/messages.php') %}

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adiciona sua critica e compartilhe com o mundo!</p>
        <form action="{{ url_for('movie.store') }}" method="post" id="add-movie-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Digite o titulo do seu filme" class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Imagem</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="length">Duração</label>
                <input type="text" name="length" id="length" placeholder="Digite a duração do filme" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Categoria</label>
                <select type="text" name="category" id="category" class="form-control">
                    <option value=""></option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Ficção">Ficção</option>
                    <option value="Terror">Terror</option>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Treiler</label>
                <input type="text" name="trailer" id="trailer" placeholder="Insira o link do trailer" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Descreva o filme"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar Filme">
        </form>
    </div>
</div>

{% include('components/footer.php') %}
{% endblock %}