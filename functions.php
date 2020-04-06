<?php

function isUserConnecter(){
    session_start();
    if($_SESSION['utilisateur']){
        return $_SESSION['utilisateur'];
    } else {
        header('Location: login.php');
    }
}

function login($pdo, $login) {
    $errors = [];
    try{
        $req = $pdo->prepare(
            'SELECT * FROM utilisateur where (login = :login)');
        $req->execute([
            'login' => $login,
            
        ]);
    } catch (PDOException $exception){
        var_dump($exception);
        die();
    }
    $res = $req->fetch();
  
    if($res == false){
        $errors[] = 'Utilisateur inconnu';
        session_destroy();
    } else {
        $_SESSION['utilisateur'] = $res['login'];
        
    }
    return $errors;
}

function registerUser($pdo, $errors){
    try{
        $req = $pdo->prepare(
            'INSERT INTO utilisateur(login, nom, prenom)
    VALUES(:login, :nom, :prenom)');
        $req->execute([
            'login' => $_POST['login'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom']
        
        ]);
    } catch (PDOException $exception){
        if($exception->getCode() === '23000'){
            $errors[] = 'login déjà utilisé';
        }
    }
    return $errors;
}


function validateFormUser(){
    $error = [];
    if(empty($_POST['login'])){
        $error[] = 'Veuillez saisir votre login';
    }
    if(empty($_POST['nom'])){
        $error[] = 'Veuillez saisir le nom';
    }


    if(empty($_POST['prenom'])){
        $error[] = 'Veuillez saisir le prenom';
    }


    return $error;
}

function add_annonce($pdo, $imageUrl){
  
    $req = $pdo->prepare(
        'INSERT INTO annonce(image_link, contenu, titre, nom_prenom_utilisateur )
    VALUES(:image_link, :contenu, :titre, :nom_prenom_utilisateur)');

    $req->execute([
        'image_link' => $imageUrl,
        'contenu' => $_POST['contenu'],
        'titre' => $_POST['titre'],
        'nom_prenom_utilisateur' => $_SESSION['utilisateur'],
        
    ]);

}

function validateForm() {
    $errors = [];
    $imageUrl = null;
    $allowedExtension = ['image/png','image/jpeg','image/gif'];
    if($_FILES['image']['size'] == 0){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez ajouter une image</div>';
    }
    if(in_array($_FILES['image']['type'],$allowedExtension)){
        if($_FILES['image']['size'] < 8000000){
            $extension = explode('/', $_FILES['image']['type'])[1];
            $imageUrl = uniqid().'.'.$extension;
            move_uploaded_file($_FILES['image']['tmp_name'],'images/upload/'.$imageUrl);
        }
        else {
            $errors[] = '<div class="alert alert-danger" role="alert">Fichier trop lourd</div> ';
        }
    } 
   
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez saisir le titre de la planète';
    }
   
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Veuillez saisir le contenu';
    }


    return ['errors'=>$errors, 'image'=>$imageUrl];
}





?>