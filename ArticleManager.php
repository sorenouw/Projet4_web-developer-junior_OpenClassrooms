<?php
require "Manager.php";

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
}