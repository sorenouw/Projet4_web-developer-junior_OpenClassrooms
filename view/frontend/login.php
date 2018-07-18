<?php $title = 'login'; ?>
<?php ob_start(); ?>
<?php include("view/frontend/nav.php"); ?>
<?php include("view/frontend/headerImg.php"); ?>

  <body>
<p><a href="index.php">Retourner sur l'accueil</a></p>

    <form class="" action="index.php?action=login" method="post">
      <input type="text" name="login" value="" placeholder="login">
      <input type="password" name="password" value="" placeholder="password">
      <br>
      <button type="submit" name="button">Connection</button>
    </form>

    <p><?php if (isset($message)) {
    echo $message;
}  ?></p>
    <?php $content = ob_get_clean(); ?>

    <?php require('view/frontend/template.php'); ?>
