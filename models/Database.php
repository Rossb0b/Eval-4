<?php 
/**
 * Class representing a database
 */
abstract class Database
{
  /**
   * Get the instance of database
   * @return PDO
   */
  public static function getInstance()
  {
    return require '../conf/database.conf.php';
  }
}
