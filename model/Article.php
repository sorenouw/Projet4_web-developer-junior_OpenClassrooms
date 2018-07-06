<?php
class Article {
  private $_title;
  private $_content;
  private $_date;
  private $_id;

  public function __construct(Array $data){
    $this->hydrate($data);
  }

  public function hydrate(Array $data){
    if(isset($data["title"])){
      $this->setTitle($data[ "title"]);
    }
    if(isset($data["content"])){
      $this->setContent($data[ "content"]);
    }
    if(isset($data["date_publish"])){
      $this->setDate($data[ "date_publish"]);
    }
    if(isset($data["id"])){
      $this->setId($data[ "id"]);
    }
  }

  // Getters
  public function title(){
    return $this->_title;
  }

  public function content(){
    return $this->_content;
  }

  public function date(){
    return $this->_date;
  }
  public function id(){
    return $this->_id;
  }

  // Setters
  public function setTitle($title){
    if(is_string($title)){
      $this->_title = $title;
    }

  }
  public function setContent($content){
    if(is_string($content)){
      $this->_content = $content;
    }
  }
  public function setDate($date){
    $this->_date = $date;
  }
  public function setId($id){
    $this->_id = $id;
  }
}
