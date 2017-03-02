<?php
class Auth 
{
  protected $database;
  public function __construct(Database $database) 
  {
    $this->database = $database;
  }

  public function build() {
    return $this->database->query("
      CREATE TABLE IF NOT EXISTS users
      (
        id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(200) NOT NULL UNIQUE,
        username VARCHAR(20) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
      )
    ");
  }
}