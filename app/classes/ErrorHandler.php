<?php

class ErrorHandler
{
  protected $errors;
  public function add_error($error, $key = null)
  {
    if($key)
    {
      $this->errors[$key][] = $error;
    }
    else
    {
      $this->errors[] = $error;
    }
  }
  public function has_errors()
  {
    return count($this->all()) ? true : false;
  }
  public function all()
  {
    
  }
}