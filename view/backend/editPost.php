<?php $title = 'edit post'; ?>

<?php ob_start(); ?>
<body>
  <h2>Modifier cet article.</h2>
<?php foreach ($editPost as $post): ?>
  <form class="" action="index.php?action=editPost&id=<?= $post->id(); ?>" method="post">
    <p><?php echo nl2br(htmlspecialchars($post->title())); ?></p>
    <textarea class="editor" cols="50" rows="10" name="post"><?php echo nl2br(htmlspecialchars($post->content())); ?></textarea>
    <button type="submit" name="3">Modifier !</button>
  </form>
<?php endforeach; ?>


	<?php $content = ob_get_clean(); ?>

	<?php require('view/frontend/template.php'); ?>
