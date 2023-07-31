{% extends "template.php" %}

{% block content %}
{% include('components/header.php') %}
<div id="main-container" class="container-fluid">
    <h2 class="section-title">
        Novos Filmes
    </h2>
    <p class="section-description">
        Veja as criticas dos ultimos filmes adicionados no MovieStar
    </p>
</div>
{% include('components/footer.php') %}
{% endblock %}