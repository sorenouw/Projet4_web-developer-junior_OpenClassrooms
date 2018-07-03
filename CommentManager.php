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
     while ($data = $req->fetch()){
       $commentaires[]=new Comment($data);
     }
     return $commentaires;
   }
   public function delete(){

   }
   public function getComment(Comment $comment){
     $req = $this->getDb()->prepare("SELECT id, title, content, date_publish FROM post WHERE id = :id");
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
}
