{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}

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
</div>
{% endblock %}