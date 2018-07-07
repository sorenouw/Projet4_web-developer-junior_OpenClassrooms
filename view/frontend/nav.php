<header>
<h1>Jean Forteroche</h1>
<nav>
  <?php if (!empty($_SESSION["user"])) {
    ?>
    <em><a href="index.php?action=admin">Administration</a></em>
  	<?php
} else {
        ?>
      <form class="" action="index.php?action=login" method="post">
        <button type="submit" name="button" class="">Se connecter</button>
      </form>
  <?php
    }
    ?>
</nav>
</header>
