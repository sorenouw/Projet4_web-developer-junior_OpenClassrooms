<?php
class Database{
  private static $dbHost = "db745485631.db.1and1.com";
  private static $dbName = "db745485631";
  private static $dbUser = "dbo745485631";
  private static $dbUserPassword = "JeanForteroche0.";
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
