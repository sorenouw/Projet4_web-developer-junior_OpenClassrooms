<?php
class Commentaire {
  private $_login;
  private $_content;
  private $_date;
  private $_id;
  private $_reported;

  public function __construct(Array $data){
    $this->hydrate($data);
  }

  public function hydrate(Array $data){
    if(isset($data["login"])){
      $this->setLogin($data[ "login"]);
    }
    if(isset($data["comment"])){
      $this->setComment($data[ "comment"]);
    }
    if(isset($data["date_publish"])){
      $this->setDate($data[ "date_publish"]);
    }
    if(isset($data["post_id"])){
      $this->setPostId($data[ "post_id"]);
    }
    if(isset($data["reported"])){
      $this->setReported($data[ "reported"]);
    }

  }

  // Getters
  public function login(){
    return $this->_title;
  }

  public function comment(){
    return $this->_content;
  }

  public function date(){
    return $this->_date;
  }
  public function post_id(){
    return $this->_id;
  }
  public function reported(){
    return $this->_reported;
  }
  // Setters
  public function setLogin($login){
    if(is_string($login)){
      $this->_title = $login;
    }

  }
  public function setComment($comment){
    if(is_string($comment)){
      $this->_content = $comment;
    }
  }
  public function setDate($date){
    $this->_date = $date;
  }
  public function setPostId($post_id){
    $this->_id = $post_id;
  }
  public function setReported($reported){
    $this->_reported = $reported;
  }
}
