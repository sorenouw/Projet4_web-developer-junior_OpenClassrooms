<?php
// Connexion à la base de données
session_start();
require "Article.php";
require "ArticleManager.php";
require "Comment.php";
require "CommentManager.php";

// Récupération du commentaire
 $commentManager = new CommentManager();
  $id = $_GET['comment_id'];
  $comment = new Comment(Array(
      'id'=>$id,
  ));
  $editComment = $commentManager->getComment($comment);

 if (isset($_POST['2']) && !empty($_POST)) {
     $newComment = $_POST['comment'];
     $id = $_GET['comment_id'];
     $validation = true;
     if (empty($newComment)) {
         $validation = false;
     }
     if ($validation === true) {
       $commentManager = new CommentManager();
       $comment = new Comment(Array(
         'comment'=>$newComment,
         'id'=> $id,
     ));
     $commentManager->editComment($comment);
         header('Location: commentView.php?id=' . $_GET['id']);
     }
 }



?>
<?php $title = 'editer'; ?>

<?php ob_start(); ?>
<body>
  <h2>Modifier ce commentaire.</h2>
<?php foreach ($editComment as $comment): ?>
  <form class="" action="editComment.php?id=<?= $_GET['id']?>&comment_id=<?= $comment->id() ?>" method="post">
    <textarea cols="50" rows="10" name="comment"><?php echo nl2br(htmlspecialchars($comment->comment())); ?></textarea>
    <br>
    <button type="submit" name="2">Modifier !</button>
  </form>
<?php endforeach; ?>


	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>
