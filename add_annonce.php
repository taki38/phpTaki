<?php
include 'homepage.php';

require_once 'pdo_connection.php';
require_once 'functions.php';
$errors = [];
$image_link = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateForm();
    $errors = $returnValidation['errors'];

    if( count($errors) === 0) {
        add_annonce($pdo);
        header('Location: list_annonces.php');
    }
}
?>

<html>

<div class="container my-2">
    <h1 class="text-center shadow p-2">Ajouter une annonce</h1>
    <form method="post" action="add_annonce.php" class="p-5 shadow" >

        <div class="form-group">
            <label>titre de l'annonce</label>
            <input type="text" name="titre" class="form-control" placeholder="Titre de l'annonce">
        </div>
        <div class="form-group">
            <label>contenu de l'annonce</label>
            <input type="text" name="contenu" class="form-control" placeholder="Contenu de l'annonce">
        </div>
        <div class="form-group">
            <label>Lien de l'image</label>
            <input type="text" name="image_link" class="form-control" placeholder="url de l'image">
        </div>
        <button  type="submit" class="btn btn-success" href="list_annonces.php">Ajouter</button>
        
        <?php
            if(count($errors) != 0){
                echo('<h2>Erreurs lors de la dernière soumission du formulaire: </h2>');
                foreach($errors as $error){
                    echo('<div class="error">'.$error.'</div>');
                }
            }
            
        ?>
    </form>
</div>
</html>