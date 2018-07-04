<?php
require_once "Manager.php";

class ArticleManager extends Manager {

  public function add(Article $article){
    $req = $this->getDb()->prepare("INSERT INTO post (title, content,date_publish) VALUES (:title, :content, now()) ");
    $req->execute(array(
      'title'=> $article->title(),
      'content'=> $article->content(),
    ));
   }
   public function getList(){
     $articles = [];
     $req = $this->getDb()->query("SELECT id, title, content, date_publish FROM post ORDER BY date_publish DESC LIMIT 0, 5");
     while ($data = $req->fetch()){
       $articles[]=new Article($data);
     }
     return $articles;
   }
   public function getPost(Article $article){
     $req = $this->getDb()->prepare("SELECT id, title, content, date_publish FROM post WHERE id = :id");
     $req->execute(array(
       'id'=> $article->id(),
   ));
   while ($data = $req->fetch()){
     $getPost[]=new Article($data);
   }
   return $getPost;
   }
   public function editPost(Article $article){
     $req = $this->getDb()->prepare("UPDATE post SET content = :content WHERE id = :id");
     $req->execute(array(
     'content'=> $article->content(),
     'id'=> $article->id(),
));
   }
   public function delete(){
     $req= $this->getDb()->prepare("DELETE FROM comment WHERE id = :id");
     $req->execute(array(
             'id'=> $article->id(),
         ));
   }
}
