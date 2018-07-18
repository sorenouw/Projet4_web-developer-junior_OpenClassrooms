<?php
class Database{
  private static $dbHost = "localhost";
  private static $dbName = "blog";
  private static $dbUser = "root";
  private static $dbUserPassword = "";
  private static $connection = null;
  public static function connect(){
    try {
      self::$connection = new PDO("mysql:host=". self::$dbHost .";dbname=". self::$dbName .";charset=utf8", self::$dbUser , self::$dbUserPassword);
    } catch (Exception $e) {
      die($e->getMessage());
    }
    return self::$connection;
  }
}
