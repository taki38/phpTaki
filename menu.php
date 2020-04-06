<?php
include 'header.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Dauphine</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="list_annonces.php">Voir les annonces</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="add_annonce.php">Ajouter une annonce</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Se déconnecter</a>
            </li>
        </ul>
    </div>
</nav>
