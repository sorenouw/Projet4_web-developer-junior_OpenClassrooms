<?php
session_start();
// Connexion à la base de données
require "Article.php";
require "ArticleManager.php";
require "Comment.php";
require "CommentManager.php";


// Récupération du billet
    $articleManager = new ArticleManager();
  $id = $_GET['id'];
  $article = new Article(array(
      'id'=>$id,
  ));
  $post = $articleManager->getPost($article);




// post de commentaire
if (isset($_POST['1']) && !empty($_POST)) {
    $auteur = $_POST['author'];
    $commentaire = $_POST['comment'];
    $postId = $_GET['id'];
    $validation = true;
    if (empty($auteur) && empty($commentaire)) {
        $validation = false;
    }
    if ($validation === true) {
        $commentManager = new CommentManager();
        $comment = new Comment(array(
      'login'=> $auteur,
      'comment'=> $commentaire,
      'postId'=> $postId,
    ));
        $commentManager->add($comment);
    }
} elseif (isset($_POST['2'])) {
    $id = $_GET['comment_id'];
    $commentManager = new CommentManager();
    $comment = new Comment(array(
  'id'=> $id,
));
    $commentManager->report($comment);
} elseif (isset($_POST['5'])) {
    $id = $_GET['comment_id'];
    $commentManager = new CommentManager();
    $comment = new Comment(array(
  'id'=> $id,
));
    $commentManager->delete($comment);
}

// récupération des Commentaires
$commentManager = new CommentManager();
$postId = $_GET['id'];
$comment = new Comment(array(
    'postId'=>$postId,
));
$comments = $commentManager->getList($comment);

?>



  <?php $title = 'Mon blog'; ?>
  <?php ob_start(); ?>
  <?php include("nav.php"); ?>
  <?php include("headerImg.php"); ?>
<p><a class="right" href="index.php">Retour à l'accueil'</a></p>

<?php foreach ($post as $post): ?>
  <article class="post_view">
    <h3><?php echo htmlspecialchars($post->title()); ?></h3>
    <p>
      <?php
    echo nl2br(htmlspecialchars($post->content()));
    ?>
    </p>
		<em>le <?php echo $post->date(); ?></em>
  </article>
<?php endforeach; ?>


  <h2>Commentaires</h2>
<?php foreach ($comments as $comment): ?>
  <div class="comment">
    <div class="comment_content">
      <p><strong><?php echo htmlspecialchars($comment->login()); ?></strong> le
        <?php echo $comment->date(); ?></p>
      <p>
        <?php echo nl2br(htmlspecialchars($comment->comment())); ?>
      </p>
    </div>
    <div class="comment_button">
        <?php if (!empty($_SESSION["user"])) {
        ?>
        <a href="editComment.php?id=<?= $_GET['id']?>&comment_id=<?= $comment->id(); ?>"> modifier</a>
				<form class="" action=commentView.php?id=<?php echo $post->id(); ?>&comment_id=<?= $comment->id(); ?> method="post">
					<button type="submit" name="5">Supprimer</button>
				</form>
        <?php
    } ?>
          <form class="" action=commentView.php?id=<?= $_GET[ 'id']; ?>&comment_id=<?= $comment->id();?> method="post">
            <button type="submit" name="2">Signaler !</button>
          </form>
    </div>
  </div>
<?php endforeach; ?>

    <form action="commentView.php?id=<?= $_GET['id']  ?>" method="post">
      <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
      </div>
      <div>
        <label for="comment">Commentaire</label> <br />
        <textarea id="comment" name="comment"></textarea>
      </div>
      <div>
        <input type="submit" name="1" />
      </div>
    </form>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
