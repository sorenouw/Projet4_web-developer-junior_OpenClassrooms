<?php
session_start();
require "Article.php";
require "ArticleManager.php";

// poster un article
if (isset($_POST['5']) && !empty($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $validation = true;
    if (empty($title) && empty($content)) {
        $validation = false;
    }
    if ($validation === true) {

      $articleManager = new ArticleManager();
      $article = new Article(Array(
        'title'=> $title,
        'content'=> $content,
      ));
      $articleManager->add($article);
        // header('Location: admin.php');
    }
}
?>

<?php $title = 'Nouveau Post'; ?>

<?php ob_start(); ?>
        <h1>Rédiger un un nouveau post !</h1>
        <p><a href="admin.php">Retour à l'interface d'admninistration</a></p>


<form action="post.php" method="post">
  <div>
      <label for="title">Titre</label><br />
      <input type="text" id="title" name="title" />
  </div>
  <div>
      <label for="content">Contenu</label> <br />
      <textarea id="content" name="content" rows="10" cols="80"></textarea>
  </div>
    <div>
        <input type="submit" name="5" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
