<?php
session_start();
// Connexion à la base de données

try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// delete post
if (isset($_POST['4'])) {
    $req= $bdd->prepare("DELETE FROM post WHERE id = :id");
    $req->execute(array(
            'id'=> $_GET['id'],
        ));
    var_dump('Supprimé');
} elseif (isset($_POST['5'])) {
        $req= $bdd->prepare("DELETE FROM comment WHERE id = :id");
        $req->execute(array(
            'id'=>$_GET['id']
        ));
    }
// Récupération des post
  $req = $bdd->query("SELECT id, title, content, date_publish FROM post ORDER BY date_publish DESC");


?>



<?php $title = 'admin'; ?>

<?php ob_start(); ?>

<header class="admin">
	<p><?php echo 'Bienvenue ' . $_SESSION["user"]?></p>
	<p><a href="index.php">Retourner sur l'accueil</a></p>
	<a href="post.php">poster</a>
</header>
<div class="admin">
	<section class="post">
		<table>
			<?php while ($post = $req->fetch()) {
    ?>
			<tr>
				<td>
					<h3><?php echo htmlspecialchars($post['title']); ?></h3>
				</td>
				<td>
					<a href="editPost.php?id=<?php echo $post['id']; ?>">Éditer</a>
				</td>
				<td>
					<a href="comment.php?id=<?php echo $post['id']; ?>">Lire</a>
				</td>
				<td>
					<form class="" action=admin.php?id=<?php echo $post['id']; ?> method="post">
						<button type="submit" name="4">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php
} ?>
		</table>
	</section>

	<section class="comment">
		<?php
    // récupération des Commentaires
        $req = $bdd->prepare("SELECT * FROM comment WHERE reported = '1'  ORDER BY date_publish DESC");
    $req->execute(array(	));
     while ($comment = $req->fetch()) {
         ?>
	<p><strong><?php echo htmlspecialchars($comment['login']); ?></strong> le <?php echo $comment['date_publish']; ?>

		<p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
		<form class="" action=admin.php?id=<?php echo $comment['id']; ?> method="post">
			<button type="submit" name="5">Supprimer</button>
		</form>
		<?php
     }?>
	</section>
</div>


		<?php $content = ob_get_clean(); ?>

		<?php require('template.php'); ?>
