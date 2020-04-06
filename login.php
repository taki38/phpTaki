<?php
include 'menu2.php';
?>
<?php
session_start();

require_once 'functions.php';
require_once 'pdo_connection.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    // je ferais le traitement de mon formulaire d'inscription

    $errors = login($pdo, $_POST['login']);

    var_dump('ici');
    var_dump($errors);
    if( count($errors) == 0){
       
       header('Location: homepage.php');
       exit();
    }
    
}
?>


<html>

<body>
<h1>Login</h1>
    <form method="post">
        <input type="text" name="login" placeholder="login">
        <input type="nom" name="nom" placeholder="nom">
        <input type="submit">
    </form>

<?php
if(isset($errors)){
    if(count($errors)>0){
        echo('<h2>Les erreurs : </h2>');
        foreach ($errors as $error){
            echo('<li>'.$error.'</li>');
        }
    }
}

?>

<a href="inscription.php">Pas encore de compte ?</a>
</body>
</html>
