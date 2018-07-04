<?php
// Connexion à la base de données
session_start();
require "Article.php";
require "ArticleManager.php";
require "Comment.php";
require "CommentManager.php";

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
         header('Location: comment.php?id=' . $_GET['id']);
     }
 }

 // Récupération du commentaire
 	$commentManager = new CommentManager();
   $id = $_GET['id'];
   $comment = new Comment(Array(
       'id'=>$id,
   ));
   $editComment = $commentManager->getCommen($comment);

?>
<?php $title = 'editer'; ?>

<?php ob_start(); ?>
<body>
<?php foreach ($editComment as $commentt): ?>

<?php endforeach; ?>
  <form class="" action="editComment.php?id=<?= $_GET['id']?>&comment_id=<?= $comment->id() ?>" method="post">
    <textarea name="comment"><?php echo nl2br(htmlspecialchars($comment->comment())); ?></textarea>
    <input type="submit" name="2" />
  </form>

	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>
