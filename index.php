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
<section class="section_posts">
  <?php foreach ($articles as $article): $content = substr($article->content(), 0, 150); ?>

    <div class="post">
        <h3><?php echo htmlspecialchars($article->title()); ?></h3>
        <p><?php echo htmlspecialchars($content . ".."); ?>
        <br />
        <em>Publié le<?php echo htmlspecialchars($article->date()); ?> </em>
        <em><a href="commentView.php?id=<?php echo $article->id() ?>">Comments</a></em>
        </p>
    </div>

  <?php endforeach; ?>

</section>





		<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
