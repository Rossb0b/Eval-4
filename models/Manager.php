<?php 
/**
 * Class representing a manager
 */
abstract class Manager
{
  /**
   * @var PDO
   */
  protected $database;

  /**
   * Init the database connexion
   */
  public function __construct()
  {
    if(!is_object($this->database))
    {
      $this->database = Database::getInstance();
    }
  }
}
