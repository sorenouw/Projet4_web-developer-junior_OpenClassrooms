<?php
require "Manager.php";

class ArticleManager extends Manager {

  public function add(Article $article){
    $req = $this->_db->prepare("INSERT INTO post (title, content,date_publish) VALUES (:title, :content, now()) ");
    $req->execute(array(
      'title'=> $article->title(),
      'content'=> $article->content(),
    ));
   }
   public function getList(){
     $articles = [];
     $req = $this->_db->query("SELECT id, title, content, DATE_FORMAT(date_publish, '%d/%m/%Y à %Hh%imin%ss') AS date_publish FROM post ORDER BY date_publish DESC LIMIT 0, 5");
     while ($data = $req->fetch()){
       $articles[]=new Article($data);
     }
     return $articles;
   }
}
