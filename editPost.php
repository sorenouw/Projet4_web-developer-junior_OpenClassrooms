<?php
// Connexion à la base de données
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

 if (isset($_POST['3']) && !empty($_POST)) {
     $post = $_POST['post'];
     $validation = true;
     if (empty($post)) {
         $validation = false;
     }
     if ($validation === true) {
         $req = $bdd->prepare("UPDATE post SET content = :content WHERE id = :id");
         $req->execute(array(
      'content'=> $post,
      'id'=> $_GET['id'],
    ));
         header('Location: index.php');
     }
 }

  $req = $bdd->prepare("SELECT * FROM post WHERE id = :id");
  $req->execute(array(
        'id'=> $_GET['id']
  ));

?>
<?php $title = 'edit post'; ?>

<?php ob_start(); ?>
<body>
  <?php while ($post = $req->fetch()) {
    ?>
  <form class="" action="editPost.php?id=<?= $post['id'] ?>" method="post">
    <p><?php echo nl2br(htmlspecialchars($post['title'])); ?></p>
    <textarea name="post"><?php echo nl2br(htmlspecialchars($post['content'])); ?></textarea>
    <input type="submit" name="3" />
  </form>
  <?php
}
  ?>
	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>
