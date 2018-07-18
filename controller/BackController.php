<?php
class BackController
{
    public function admin(){

        // Récupération des post
        $articleManager = new ArticleManager();
        $articles = $articleManager->getList();

        // Reported comments
        $commentManager = new CommentManager();
        $getReported = $commentManager->getReported();

        require('view/backend/admin.php');
    }
    public function deletePost()
    {
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

        header('Location: index.php?action=admin');
        require('view/backend/admin.php');
    }
    public function deleteComment(){
          $id = $_GET['id'];
          $commentManager = new CommentManager();
          $comment = new Comment(array(
    'id'=> $id,
  ));
        $commentManager->delete($comment);
        header('Location: index.php?action=admin');
        require('view/backend/admin.php');
      }
    public function editPost()
    {
        // Récupération du post
        $articleManager = new ArticleManager();
        $id = $_GET['id'];
        $checkPost = $articleManager->checkPost($id);
        if($checkPost){
        $editPost = $articleManager->getPost($id);

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
                $article = new Article(array(
             'content'=>$post,
             'id'=> $id,
         ));
                $articleManager->editPost($article);
                header('Location: index.php?action=admin');
            }
        }
        require('view/backend/editPost.php');
      } else {
        header("location:index.php?action=404");
      }
      }
    public function editComment()
    {
        // Récupération du commentaire
        $commentManager = new CommentManager();
        $id = $_GET['comment_id'];

        $articleManager = new ArticleManager();
        $post_id = $_GET['id'];

        $checkComment = $commentManager->checkComment($id);
        $checkPost = $articleManager->checkPost($post_id);
        if($checkComment & $checkPost){
        $editComment = $commentManager->getComment($id);

        if (isset($_POST['2']) && !empty($_POST)) {
            $newComment = $_POST['comment'];
            $id = $_GET['comment_id'];
            $validation = true;
            if (empty($newComment)) {
                $validation = false;
            }
            if ($validation === true) {
                $commentManager = new CommentManager();
                $comment = new Comment(array(
             'comment'=>$newComment,
             'id'=> $id,
         ));
                $commentManager->editComment($comment);
                header('Location: index.php?action=commentView&id=' . $_GET['id']);
            }
        }
        require('view/backend/editComment.php');
      } else {
        header("location:index.php?action=404");
      }
    }
    public function newPost()
    {
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
                $article = new Article(array(
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
