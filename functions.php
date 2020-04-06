<?php
session_start();
function isUserConnecter(){
  
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
        $_SESSION['utilisateur'] = $res;
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

function add_annonce($pdo){
  
    var_dump($_POST);
     die();
     $nomUser = $_SESSION['utilisateur']['nom'].' '.$_SESSION['utilisateur']['prenom'];
    $req = $pdo->prepare(
        'INSERT INTO annonce(im age_link, contenu, titre, nom_prenom_utilisateur )
    VALUES(:image_link, :contenu, :titre)');

    $req->execute([
        'image_link' => $_POST['image_link'],
        'contenu' => $_POST['contenu'],
        'titre' => $_POST['titre'],
        'nom_prenom_utilisateur' => $user['nom']
        
    ]);

}

function validateForm() {
    $errors = [];
   
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez saisir le titre de la planète';
    }
   
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Veuillez saisir le contenu';
    }

    if ( empty($_POST['image_link'])) {
        $errors[] = 'Veuillez saisir l\'url de l\'image';
    }

    return ['errors'=>$errors];
}





?>