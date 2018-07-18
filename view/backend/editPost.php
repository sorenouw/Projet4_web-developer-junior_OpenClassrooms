<?php $title = 'edit post'; ?>

<?php ob_start(); ?>
<body>
  <h2>Modifier cet article.</h2>
  <form class="" action="index.php?action=editPost&id=<?= $editPost->id(); ?>" method="post">
    <p><?php echo nl2br(htmlspecialchars($editPost->title())); ?></p>
    <textarea class="editor" cols="50" rows="10" name="post"><?php echo nl2br(htmlspecialchars($editPost->content())); ?></textarea>
    <button type="submit" name="3">Modifier !</button>
  </form>



	<?php $content = ob_get_clean(); ?>

	<?php require('view/frontend/template.php'); ?>
