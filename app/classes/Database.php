<?php

class Database
{
  protected $host = '127.0.0.1';
  protected $database = 'website';
  protected $username = 'root';
  protected $password = '';
  protected $pdo;
  protected $verbose = true;
  protected $table;
  protected $statement;
  public function __construct() 
  {
    try 
    {
      $this->pdo = new PDO("mysql:host={$this->host}; dbname={$this->database}", $this->username, $this->password);
      if($this->verbose)
      {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    }
    catch(PDOExcepton $error)
    {
      die($this->verbose ? $error->getMessage() : '');
    }
  }
    public function query($sql) 
    {
      return $this->pdo->query($sql);
    }
    public function table($table)
    {
      $this->table = $table;
      return $this;
    }
    public function insert($data)
    {
      $keys = array_keys($data);
      $fields = '`' . implode('`, `', $keys) . '`';
      $placeholders = ':' . implode(', :', $keys);
      $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
      $this->statement = $this->pdo->prepare($sql);
      return $this->statement->execute($data);
    }
    public function where($field, $operator, $value)
    {
      $this->statement = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$field} {$operator} :vlue");
      $this->statement->execute(['value'=>$value]);
      return $this;
    }
    public function exists($data) 
    {
      $field = array_keys($data)[0];
      return $this->where($field, "=", $data[$field])->count() ? true : false;
    }
    public function count()
    {
      return $this->statement->rowCount();
    }
    public function get() 
    {
      return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function first()
    {
      return $this->statement->get()[0];
    }
}
