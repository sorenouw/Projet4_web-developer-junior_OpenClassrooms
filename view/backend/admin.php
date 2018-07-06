<?php $title = 'admin'; ?>

<?php ob_start(); ?>

<header class="admin">
	<p><?php echo 'Bienvenue ' . $_SESSION["user"]?></p>
	<p><a href="index.php">Retourner sur l'accueil</a></p>
	<a href="index.php?action=post">poster</a>
</header>

<div class="admin_page">
	<section class="admin_post">
    <h2>Liste des articles</h2>
		<table>
<?php foreach ($articles as $post): ?>
  <tr>
    <td>
      <h3><?php echo htmlspecialchars($post->title()); ?></h3>
    </td>
    <td>
      <a href="index.php?action=editPost&id=<?php echo $post->id(); ?>">Éditer</a>
    </td>
    <td>
      <a href="index.php?action=commentView&id=<?php echo $post->id(); ?>">Lire</a>
    </td>
    <td>
      <form class="" action="index.php?action=delete&id=<?php echo $post->id(); ?>" method="post">
        <button type="submit" name="4">Supprimer</button>
      </form>
    </td>
  </tr>
<?php endforeach; ?>
		</table>
	</section>

	<section class="admin_comment">
    <h2>Liste des commentaires signalés</h2>
    <table>
      <?php foreach ($getReported as $comment): ?>
        <tr>
          <td><p><strong><?php echo htmlspecialchars($comment->login()); ?></strong> le <?php echo $comment->date(); ?><p/></td>
<td><p><?php echo nl2br(htmlspecialchars($comment->comment())); ?></p></td>
<td>          <form class="" action="index.php?action=admin&id=<?php echo $comment->id(); ?>" method="post">
            <button type="submit" name="5">Supprimer</button>
          </form></td>

        </tr>

      <?php endforeach; ?>
    </table>

	</section>
</div>


		<?php $content = ob_get_clean(); ?>

		<?php require('view/frontend/template.php'); ?>
