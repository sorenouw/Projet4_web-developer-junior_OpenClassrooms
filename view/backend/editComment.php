<?php $title = 'editer'; ?>

<?php ob_start(); ?>
<body>
  <h2>Modifier ce commentaire.</h2>
  <form class="" action="index.php?action=editComment&id=<?= $_GET['id']?>&comment_id=<?= $editComment->id() ?>" method="post">
    <textarea cols="50" rows="10" name="comment"><?php echo nl2br(htmlspecialchars($editComment->comment())); ?></textarea>
    <br>
    <button type="submit" name="2">Modifier !</button>
  </form>


	<?php $content = ob_get_clean(); ?>

	<?php require('view/frontend/template.php'); ?>
