<?php
session_start();
// Connexion à la base de données
require "Article.php";
require "ArticleManager.php";
require "Comment.php";
require "CommentManager.php";

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Récupération du billet
	$articleManager = new ArticleManager();
  $id = $_GET['id'];
  $article = new Article(Array(
      'id'=>$id,
  ));
  $post = $articleManager->getPost($article);

  // récupération des Commentaires
  $commentManager = new CommentManager();
  $postId = $_GET['id'];
  $comment = new Comment(Array(
      'postId'=>$postId,
  ));
  $commentFinal = $commentManager->getList($comment);



// post de commentaire
if (isset($_POST['1']) && !empty($_POST)) {
    $auteur = $_POST['author'];
    $commentaire = $_POST['comment'];
    $validation = true;
    if (empty($auteur) && empty($commentaire)) {
        $validation = false;
    }
    if ($validation === true) {
        $req = $bdd->prepare("INSERT INTO comment (login, comment, post_id) VALUES (:login, :comment, :post_id) ");
        $req->execute(array(
      'login'=> $auteur,
      'comment'=> $commentaire,
      'post_id'=> $_GET['id'],
    ));
    }
} elseif (isset($_POST['2'])) {
    $req = $bdd->prepare("UPDATE comment SET reported = 1 WHERE id = :id");
    $req->execute(array(
        'id'=> $_GET['comment_id'],

    ));
}

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
          <form class="" action=comment.php?id=<?php echo $_GET[ 'id']; ?>&comment_id=<?php echo $comment->id();?> method="post">
            <button type="submit" name="2">Signaler !</button>
          </form>
    </div>
  </div>
<?php endforeach; ?>

    <form action="comment.php?id=<?= $_GET['id']  ?>" method="post">
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
