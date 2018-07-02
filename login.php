<?php
session_start();
if (!empty($_POST)) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog', 'root');
    } catch (\Exception $e) {
        var_dump($e);
    }
    $req = $bdd->prepare("SELECT * FROM user WHERE name = :name AND password = :password");
    $req->execute(array(

  "name" => $login,
  "password" => $password,
));
    $data = $req->fetch(PDO::FETCH_ASSOC);
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
