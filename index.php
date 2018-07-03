<?php
session_start();
require "Article.php";
require "ArticleManager.php";
$articleManager = new ArticleManager();
$articles = $articleManager->getList();

?>

<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
    <?php include("nav.php"); ?>

<?php foreach ($articles as $article): ?>

  <div class="news">
      <h3><?php echo htmlspecialchars($article->title()); ?></h3>
      <p><?php echo htmlspecialchars($article->content()); ?>
      <br />
      <em>Publié le<?php echo htmlspecialchars($article->date()); ?> </em>
      <em><a href="commentView.php?id=<?php echo $article->id() ?>">Comments</a></em>
      </p>
  </div>

<?php endforeach; ?>





		<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
