<?php
// Connexion à la base de données
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

 if (isset($_POST['2']) && !empty($_POST)) {
     $newComment = $_POST['comment'];
     $validation = true;
     if (empty($newComment)) {
         $validation = false;
     }
     if ($validation === true) {
         $req = $bdd->prepare("UPDATE comment SET comment = :comment WHERE id = :comment_id");
         $req->execute(array(
      'comment'=> $newComment,
      'comment_id'=> $_GET['comment_id'],
    ));
         header('Location: comment.php?id=' . $_GET['id']);
     }
 }

  $req = $bdd->prepare("SELECT * FROM comment WHERE id = :comment_id");
  $req->execute(array(
        'comment_id'=> $_GET['comment_id']
  ));

?>
<?php $title = 'editerg'; ?>

<?php ob_start(); ?>
<body>
  <?php while ($comment = $req->fetch()) {
    ?>
  <form class="" action="editComment.php?id=<?= $_GET['id']?>&comment_id=<?= $comment['id'] ?>" method="post">
    <textarea name="comment"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></textarea>
    <input type="submit" name="2" />
  </form>
  <?php
}
  ?>
	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>
