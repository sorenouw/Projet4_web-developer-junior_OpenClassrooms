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
  public function editPost(){
    // Récupération du post
     $articleManager = new ArticleManager();
      $id = $_GET['id'];
      $article = new Article(Array(
          'id'=>$id,
      ));
      $editPost = $articleManager->getPost($article);

      // édition
     if (isset($_POST['3']) && !empty($_POST)) {
         $post = $_POST['post'];
         $id = $_GET['id'];
         $validation = true;
         if (empty($post)) {
             $validation = false;
         }
         if ($validation === true) {
           $articleManager = new ArticleManager();
           $article = new Article(Array(
             'content'=>$post,
             'id'=> $id,
         ));
         $articleManager->editPost($article);
             header('Location: index.php?action=admin');
         }
     }
     require('view/backend/editPost.php');
  }
  public function editComment(){
    // Récupération du commentaire
     $commentManager = new CommentManager();
      $id = $_GET['comment_id'];
      $comment = new Comment(Array(
          'id'=>$id,
      ));
      $editComment = $commentManager->getComment($comment);

     if (isset($_POST['2']) && !empty($_POST)) {
         $newComment = $_POST['comment'];
         $id = $_GET['comment_id'];
         $validation = true;
         if (empty($newComment)) {
             $validation = false;
         }
         if ($validation === true) {
           $commentManager = new CommentManager();
           $comment = new Comment(Array(
             'comment'=>$newComment,
             'id'=> $id,
         ));
         $commentManager->editComment($comment);
             header('Location: index.php?action=commentView&id=' . $_GET['id']);
         }
     }
     require('view/backend/editComment.php');
  }
  public function newPost(){
    // poster un article
    if (isset($_POST['5']) && !empty($_POST)) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $validation = true;
        if (empty($title) && empty($content)) {
            $validation = false;
        }
        if ($validation === true) {

          $articleManager = new ArticleManager();
          $article = new Article(Array(
            'title'=> $title,
            'content'=> $content,
          ));
          $articleManager->add($article);
          header('Location: index.php');
        }
    }
    require('view/backend/newPost.php');
  }
}
