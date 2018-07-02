<?php

require"Database.php";


class Manager{


  public function __construct(){

    $this->_db = Database::connect();
  }
}
