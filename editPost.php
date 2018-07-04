<?php
// Connexion à la base de données
session_start();
require "Article.php";
require "ArticleManager.php";

// Récupération du post
 $articleManager = new ArticleManager();
  $id = $_GET['id'];
  $article = new Article(Array(
      'id'=>$id,
  ));
  $editPost = $articleManager->getPost($article);

  // édition
 if (isset($_POST['3']) && !empty($_POST)) {
     $post = $_POST['post'];
     $id = $_GET['id'];
     $validation = true;
     if (empty($post)) {
         $validation = false;
     }
     if ($validation === true) {
       $articleManager = new ArticleManager();
       $article = new Article(Array(
         'content'=>$post,
         'id'=> $id,
     ));
     $articleManager->editPost($article);
         header('Location: admin.php');
     }
 }

?>
<?php $title = 'edit post'; ?>

<?php ob_start(); ?>
<body>
<?php foreach ($editPost as $post): ?>
  <form class="" action="editPost.php?id=<?= $post->id(); ?>" method="post">
    <p><?php echo nl2br(htmlspecialchars($post->title())); ?></p>
    <textarea name="post"><?php echo nl2br(htmlspecialchars($post->content())); ?></textarea>
    <input type="submit" name="3" />
  </form>
<?php endforeach; ?>


	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>
