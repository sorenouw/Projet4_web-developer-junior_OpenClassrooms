<header>
<h1>Jean Forteroche</h1>
<nav>
  <?php if (!empty($_SESSION["user"])) {
    ?>
    <em><a href="admin.php">Interface d'administration</a></em>
  	<?php
} else {
        ?>
      <form class="" action="login.php" method="get">
        <button type="submit" name="button" class="">Se connecter</button>
      </form>
  <?php
    }
    ?>
</nav>
</header>
