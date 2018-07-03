<?php
session_start();
// Connexion à la base de données

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Récupération du billet
$req = $bdd->prepare("SELECT id, title, content, date_publish FROM post WHERE id = ?");
$req->execute(array($_GET['id']));
$post = $req->fetch();



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


// récupération des Commentaires
$req = $bdd->prepare("SELECT * FROM comment WHERE post_id = :post_id  ORDER BY date_publish DESC LIMIT 0, 5");
$req->execute(array(
  'post_id'=> $_GET['id'],
));
?>



  <?php $title = 'Mon blog'; ?>
  <?php ob_start(); ?>
  <?php include("nav.php"); ?>


  <h2>Mon super blog !</h2> <a href="index.php">Retour à la liste des post</a>



  <article class="news">
    <h3>
        <?php echo htmlspecialchars($post['title']); ?>
        <em>le <?php echo $post['date_publish']; ?></em>
    </h3>

    <p>
      <?php
    echo nl2br(htmlspecialchars($post['content']));
    ?>
    </p>
  </article>

  <h2>Commentaires</h2>

  <?php while ($comment = $req->fetch()) {
        ?>
    <div class="comment">
      <div class="comment_content">
        <p><strong><?php echo htmlspecialchars($comment['login']); ?></strong> le
          <?php echo $comment['date_publish']; ?></p>
        <p>
          <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
      </div>
      <div class="comment_button">
          <?php if (!empty($_SESSION["user"])) {
            ?>
          <a href="editComment.php?id=<?= $_GET['id']?>&comment_id=<?= $comment['id'] ?>"> modifier</a>
          <?php
        } ?>
            <form class="" action=comment.php?id=<?php echo $_GET[ 'id']; ?>&comment_id=<?php echo $comment['id']?> method="post">
              <button type="submit" name="2">Signaler !</button>
            </form>
      </div>
    </div>
  <?php
    }
?>
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
