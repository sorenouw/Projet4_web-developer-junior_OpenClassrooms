<?php
session_start();
require "User.php";
require "UserManager.php";

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $userManager = new UserManager();
    $login = $_POST["login"];
    $password = $_POST["password"];
     $user = new User(Array(
       'login' => $login,
       'password' => $password,
     ));
     $data = $userManager->getUser($user);
    if ($data!=false) {
        $message = "Connexion réussie";
        $_SESSION["user"] = $login;
        header("location:admin.php");
    } else {
        $message = "Échec";
    }
}

?>
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

    <?php require('template.php'); ?>
