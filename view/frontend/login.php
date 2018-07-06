<?php $title = 'login'; ?>

<?php ob_start(); ?>
  <body>
<p><a href="index.php">Retourner sur l'accueil</a></p>
    <p><?php if (isset($message)) {
    echo $message;
}  ?></p>
    <form class="" action="login.php" method="post">
      <input type="text" name="login" value="" placeholder="login">
      <input type="text" name="password" value="" placeholder="password">
      <button type="submit" name="button">CLIQUEEEEEEEEEEEZ</button>
    </form>


    <?php $content = ob_get_clean(); ?>

    <?php require('view/frontend/template.php'); ?>
