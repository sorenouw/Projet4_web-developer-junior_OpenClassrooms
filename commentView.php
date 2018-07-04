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
  $article = new Article(Array(
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
      $comment = new Comment(Array(
      'login'=> $auteur,
      'comment'=> $commentaire,
      'postId'=> $postId,
    ));
    $commentManager->add($comment);
    }
} elseif (isset($_POST['2'])) {
  $id = $_GET['comment_id'];
  $commentManager = new CommentManager();
  $comment = new Comment(Array(
  'id'=> $id,
));
$commentManager->report($comment);
}

// récupération des Commentaires
$commentManager = new CommentManager();
$postId = $_GET['id'];
$comment = new Comment(Array(
    'postId'=>$postId,
));
$commentFinal = $commentManager->getList($comment);

?>



  <?php $title = 'Mon blog'; ?>
  <?php ob_start(); ?>
  <?php include("nav.php"); ?>


  <h2>Mon super blog !</h2> <a href="index.php">Retour à la liste des post</a>


<?php foreach ($post as $post): ?>
  <article class="news">
    <h3>
        <?php echo htmlspecialchars($post->title()); ?>
        <em>le <?php echo $post->date(); ?></em>
    </h3>

    <p>
      <?php
    echo nl2br(htmlspecialchars($post->content()));
    ?>
    </p>
  </article>
<?php endforeach; ?>


  <h2>Commentaires</h2>
<?php foreach ($commentFinal as $comment): ?>
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
