<?php $title = 'login'; ?>

<?php ob_start(); ?>
  <body>
<p><a href="index.php">Retourner sur l'accueil</a></p>
    <p><?php if (isset($message)) {
    echo $message;
}  ?></p>
    <form class="" action="index.php?action=login" method="post">
      <input type="text" name="login" value="" placeholder="login">
      <input type="password" name="password" value="" placeholder="password">
      <button type="submit" name="button">Connection</button>
    </form>


    <?php $content = ob_get_clean(); ?>

    <?php require('view/frontend/template.php'); ?>
