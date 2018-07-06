<?php $title = 'Nouveau Post'; ?>

<?php ob_start(); ?>
        <h1>Rédiger un un nouveau post !</h1>
        <p><a href="index.php?action=admin">Retour à l'interface d'admninistration</a></p>


<form action="index.php?action=newPost" method="post">
  <div>
      <label for="title">Titre</label><br />
      <input type="text" id="title" name="title" />
  </div>
  <div>
      <label for="content">Contenu</label> <br />
      <textarea id="content" name="content" rows="10" cols="80"></textarea>
  </div>
    <div>
        <input type="submit" name="5" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>

	<?php require('view/frontend/template.php'); ?>
