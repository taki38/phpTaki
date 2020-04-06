<?php
include 'header.php';
require_once 'pdo_connection.php';
require_once 'functions.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
 // je ferais le traitement de mon formulaire d'inscription

    $errors = validateFormUser();

    if(count($errors) ==  0){
        $errors = registerUser($pdo, $errors);
        if(count($errors) == 0){
            header('Location: login.php');
        }
    }

}

?>
<!DOCTYPE html>
 <html>
    <head>
        <title>Se connecter</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     </head>
     <body>
         <div class="container">
             <h1>S'inscrire</h1>
             <form method="post" action="inscription.php">
               <fieldset>
                 <legend>Formulaire d'inscription</legend>
                 
                 <div class="form-group">
                   <label for="nom">Entrez votre login</label>
                   <input type="text" class="form-control" name="login" id="login" placeholder="hisuka">
                 </div>
                 <div class="form-group">
                   <label for="nom">Entrez votre nom</label>
                   <input type="text" class="form-control" name="nom" id="nom" placeholder="SEHAILIA">
                 </div>
                 <div class="form-group">
                   <label for="nom">Entrez votre prenom</label>
                   <input type="text" class="form-control" name="prenom" id="prenom" placeholder="TakiEddine">
                 </div>
                
                 
               </fieldset>
               <button  type="submit" class="btn btn-success">valider</button>
             </form>
         </div>
         <ul>
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
</ul>
<a href="login.php">j'ai déja un compte !</a>
   


    </body>
    </html>
