<?php
class Article {
  private $_login;
  private $_comment;
  private $_date;
  private $_id;
  private $_postId;

  public function __construct(Array $data){
    $this->hydrate($data);
  }

  public function hydrate(Array $data){
    if(isset($data["login"])){
      $this->setTitle($data[ "login"]);
    }
    if(isset($data["comment"])){
      $this->setContent($data[ "comment"]);
    }
    if(isset($data["date_publish"])){
      $this->setDate($data[ "date_publish"]);
    }
    if(isset($data["id"])){
      $this->setId($data[ "id"]);
    }
    if(isset($data["postId"])){
      $this->setPostId($data[ "postId"]);
    }
  }

  // Getters
  public function login(){
    return $this->_login;
  }

  public function comment(){
    return $this->_comment;
  }

  public function date(){
    return $this->_date;
  }
  public function id(){
    return $this->_id;
  }
  public function postId(){
    return $this->_postId;
  }

  // Setters
  public function setTitle($login){
    if(is_string($login)){
      $this->_login = $login;
    }

  }
  public function setContent($comment){
    if(is_string($comment)){
      $this->_comment = $comment;
    }
  }
  public function setDate($date){
    $this->_date = $date;
  }
  public function setId($id){
    $this->_id = $id;
  }
  public function setPostId($postId){
    $this->_postId = $postId;
  }
}
