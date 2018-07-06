<?php
class BackController{
  public function admin(){
    // delete post
    if (isset($_POST['4'])) {
        $id = $_GET['id'];
        $articleManager = new ArticleManager();
        $article = new Article(array(
          'id'=>$id,
      ));
        $articleManager->delete($article);
        // delete all comments of this post
        $commentManager = new CommentManager();
        $comment = new Comment(array(
      'postId'=> $id,
    ));
        $commentManager->deleteAll($comment);
    // delete comment
    } elseif (isset($_POST['5'])) {
        $id = $_GET['id'];
        $commentManager = new CommentManager();
        $comment = new Comment(array(
      'id'=> $id,
    ));
        $commentManager->delete($comment);
    }

    // Récupération des post
    $articleManager = new ArticleManager();
    $articles = $articleManager->getList();

    // Reported comments
    $commentManager = new CommentManager();
    $getReported = $commentManager->getReported();

    require ('view/backend/admin.php');
  }
}
