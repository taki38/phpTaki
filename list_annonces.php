
<?php
require_once 'pdo_connection.php';
?>
<?php
        include 'menu.php';
        ?>
<html>
<h1>Liste des annonces disponnibles en base de donnée</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Contenu</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $reponse = $pdo->query('SELECT * FROM annonce');
        while ($data = $reponse->fetch())
        {
            ?>

    <tr>
                <td><?php echo($data['id']); ?></td>
                <td><?php echo($data['titre']); ?></td>
                <td><?php echo($data['contenu']); ?></td>
                <td><?php echo($data['image_link']); ?></td>

    </tr>
    <?php
        }
        $reponse->closeCursor();
        ?>

  </tbody>
</table>
</html>