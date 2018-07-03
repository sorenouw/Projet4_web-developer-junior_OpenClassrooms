<?php
require "Manager.php";

class CommentManager extends Manager {

  public function add(Comment $comment){
    $req = $this->getDb()->prepare("INSERT INTO comment (login, comment, post_id) VALUES (:login, :comment, :post_id) ");
    $req->execute(array(
      'title'=> $comment->login(),
      'content'=> $comment->comment(),
      'post_id'=> $comment->post_id(),
    ));
   }
   public function getList(){
     $commentaires = [];
     $req = $this->getDb()->query("SELECT * FROM comment WHERE post_id = :post_id  ORDER BY date_publish DESC LIMIT 0, 5");
     $req->execute(array(
       'post_id'=> $article->post_id(),
   ));
     while ($data = $req->fetch()){
       $commentaires[]=new Comment($data);
     }
     return $commentaires;
   }
   public function getComment(Comment $comment){
     $req = $this->getDb()->prepare("SELECT * FROM comment WHERE id = :id");
     $req->execute(array(
       'id'=> $comment->id(),
   ));
   while ($data = $req->fetch()){
     $getComment[]=new Comment($data);
   }
   return $getComment;
   }
   public function editComment(){

   }
   public function delete(){

   }
}
