<?php

require"Database.php";


class Manager{
  private $_db;

  public function __construct(){
    $this->_db = Database::connect();
  }
}
