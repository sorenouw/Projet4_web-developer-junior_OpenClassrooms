<?php $title = 'Erreur 404'; ?>
<?php ob_start(); ?>

  <img src="public/img/404.jpg" alt="" class="">
  <br>
  <a href="#">Oops !</a>

<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
