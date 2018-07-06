<?php
class FrontController{
  public function home(){
    $articleManager = new ArticleManager();
    $articles = $articleManager->getList();
    require ('view/frontend/home.php');
  }
  public function commentView(){
    // Récupération du billet
        $articleManager = new ArticleManager();
      $id = $_GET['id'];
      $article = new Article(array(
          'id'=>$id,
      ));
      $post = $articleManager->getPost($article);

    // post de commentaire
    if (isset($_POST['1']) && !empty($_POST)) {
        $auteur = $_POST['author'];
        $commentaire = $_POST['comment'];
        $postId = $_GET['id'];
        $validation = true;
        if (empty($auteur) && empty($commentaire)) {
            $validation = false;
        }
        if ($validation === true) {
            $commentManager = new CommentManager();
            $comment = new Comment(array(
          'login'=> $auteur,
          'comment'=> $commentaire,
          'postId'=> $postId,
        ));
            $commentManager->add($comment);
        }
    } elseif (isset($_POST['2'])) {
        $id = $_GET['comment_id'];
        $commentManager = new CommentManager();
        $comment = new Comment(array(
      'id'=> $id,
    ));
        $commentManager->report($comment);
    } elseif (isset($_POST['5'])) {
        $id = $_GET['comment_id'];
        $commentManager = new CommentManager();
        $comment = new Comment(array(
      'id'=> $id,
    ));
        $commentManager->delete($comment);
    }

    // récupération des Commentaires
    $commentManager = new CommentManager();
    $postId = $_GET['id'];
    $comment = new Comment(array(
        'postId'=>$postId,
    ));
    $comments = $commentManager->getList($comment);

    require ('view/frontend/commentView.php');
  }
  public function login(){
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $userManager = new UserManager();
        $login = $_POST["login"];
        $password = $_POST["password"];
         $user = new User(Array(
           'login' => $login,
           'password' => $password,
         ));
         $data = $userManager->getUser($user);
        if ($data!=false) {
            $message = "Connexion réussie";
            $_SESSION["user"] = $login;
            header("location:admin.php");
        } else {
            $message = "Échec";
        }
    }
    require ('view/frontend/login.php');
  }
}
