<?php
session_start();
// Connexion à la base de données
require "Article.php";
require "ArticleManager.php";
require "Comment.php";
require "CommentManager.php";

// delete post
if (isset($_POST['4'])) {
    $id = $_GET['id'];

    $articleManager = new ArticleManager();
    $article = new Article(array(
      'id'=>$id,
  ));
    $articleManager->delete($article);
    // delete all comments of this post
    $commentManager = new CommentManager();
    $comment = new Comment(array(
  'postId'=> $id,
));
    $commentManager->deleteAll($comment);
    var_dump('Supprimé');
// delete comment
} elseif (isset($_POST['5'])) {
    $id = $_GET['comment_id'];
    $commentManager = new CommentManager();
    $comment = new Comment(array(
  'id'=> $id,
));
    $commentManager->delete($comment);
}

// Récupération des post
$articleManager = new ArticleManager();
$articles = $articleManager->getList();

// Reported comments
$commentManager = new CommentManager();
$getReported = $commentManager->getReported();
?>


<?php $title = 'admin'; ?>

<?php ob_start(); ?>

<header class="admin">
	<p><?php echo 'Bienvenue ' . $_SESSION["user"]?></p>
	<p><a href="index.php">Retourner sur l'accueil</a></p>
	<a href="post.php">poster</a>
</header>

<div class="admin">
	<section class="post">
		<table>
<?php foreach ($articles as $post): ?>
  <tr>
    <td>
      <h3><?php echo htmlspecialchars($post->title()); ?></h3>
    </td>
    <td>
      <a href="editPost.php?id=<?php echo $post->id(); ?>">Éditer</a>
    </td>
    <td>
      <a href="commentView.php?id=<?php echo $post->id(); ?>">Lire</a>
    </td>
    <td>
      <form class="" action=admin.php?id=<?php echo $post->id(); ?> method="post">
        <button type="submit" name="4">Supprimer</button>
      </form>
    </td>
  </tr>
<?php endforeach; ?>
		</table>
	</section>

	<section class="comment">
<?php foreach ($getReported as $comment): ?>
    <p><strong><?php echo htmlspecialchars($comment->login()); ?></strong> le <?php echo $comment->date(); ?>
    <p><?php echo nl2br(htmlspecialchars($comment->comment())); ?></p>
    <form class="" action=admin.php?id=<?php echo $comment->id(); ?> method="post">
      <button type="submit" name="5">Supprimer</button>
    </form>
<?php endforeach; ?>
	</section>
</div>


		<?php $content = ob_get_clean(); ?>

		<?php require('template.php'); ?>
