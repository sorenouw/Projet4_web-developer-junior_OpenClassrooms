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
    <?php include("headerImg.php"); ?>
<section class="index_posts">
  <?php foreach ($articles as $article): $content = substr($article->content(), 0, 500); ?>

    <div class="index_post">
        <h3><?php echo htmlspecialchars($article->title()); ?></h3>
        <em>Publié le <?php echo htmlspecialchars($article->date()); ?></em>
        <p><?php echo htmlspecialchars($content . ".."); ?></p>
        <p><a href="commentView.php?id=<?php echo $article->id() ?>">Lire ce chapitre</a></p>

    </div>
  <?php endforeach; ?>

</section>





		<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
