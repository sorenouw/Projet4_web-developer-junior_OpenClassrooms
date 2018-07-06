<?php


class CommentManager extends Manager
{
    public function add(Comment $comment)
    {
        $req = $this->getDb()->prepare("INSERT INTO comment (login, comment, post_id) VALUES (:login, :comment, :post_id) ");
        $req->execute(array(
      'login'=> $comment->login(),
      'comment'=> $comment->comment(),
      'post_id'=> $comment->postId(),
    ));
    }
    public function getList(Comment $comment)
    {
        $commentaires = [];
        $req = $this->getDb()->prepare("SELECT * FROM comment WHERE post_id = :post_id  ORDER BY date_publish DESC LIMIT 0, 5");
        $req->execute(array(
       'post_id'=> $comment->postId(),
   ));
        while ($data = $req->fetch()) {
            $commentaires[]=new Comment($data);
        }
        return $commentaires;
    }
    public function getComment(Comment $comment)
    {
        $req = $this->getDb()->prepare("SELECT * FROM comment WHERE id = :id");
        $req->execute(array(
       'id'=> $comment->id(),
   ));
        while ($data = $req->fetch()) {
            $getComment[]=new Comment($data);
        }
        return $getComment;
    }
    public function editComment(Comment $comment)
    {
      $req = $this->getDb()->prepare("UPDATE comment SET comment = :comment WHERE id = :id");
      $req->execute(array(
      'comment'=> $comment->comment(),
      'id'=> $comment->id(),
 ));
    }
    public function delete(Comment $comment)
    {
      $req= $this->getDb()->prepare("DELETE FROM comment WHERE id = :id");
      $req->execute(array(
              'id'=> $comment->id(),
          ));
    }
    public function report(Comment $comment)
    {
        $req = $this->getDb()->prepare("UPDATE comment SET reported = 1 WHERE id = :id");
        $req->execute(array(
         'id'=> $comment->id(),
     ));
    }
    public function getReported()
    {
      $getReported=[];
        $req = $this->getDb()->query("SELECT * FROM comment WHERE reported = '1'  ORDER BY date_publish DESC");
        while ($data = $req->fetch()){
          $getReported[]=new Comment($data);
        }
        return $getReported;
    }
    public function deleteAll(Comment $comment){
      $req= $this->getDb()->prepare("DELETE FROM comment WHERE post_id = :post_id");
      $req->execute(array(
              'post_id'=> $comment->postId(),
          ));
    }
}