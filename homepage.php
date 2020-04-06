<?php
    require_once 'functions.php';
    $user = isUserConnecter();
?>

<html>
<head>
    <?php
    include 'header.php';
    ?>
</head>
<body>
<?php
    include 'menu.php';
?>
<h1>Bonjour <?php echo($user['nom']);?></h1>
</body>
</html>
