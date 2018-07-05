<?php
class User {
  private $_login;
  private $_password;
  private $_mail;

  public function __construct(Array $data){
    $this->hydrate($data);
  }

  public function hydrate(Array $data){
    if(isset($data["login"])){
      $this->setLogin($data[ "login"]);
    }
    if(isset($data["password"])){
      $this->setPassword($data[ "password"]);
    }
    if(isset($data["mail"])){
      $this->setMail($data[ "mail"]);
    }
  }

  // Getters
  public function login(){
    return $this->_login;
  }

  public function password(){
    return $this->_password;
  }

  public function mail(){
    return $this->_mail;
  }

  // Setters
  public function setLogin($login){
    if(is_string($login)){
      $this->_login = $login;
    }

  }
  public function setPassword($password){
    if(is_string($password)){
      $this->_password = $password;
    }
  }
  public function setMail($mail){
    $this->_mail = $mail;
  }
}
