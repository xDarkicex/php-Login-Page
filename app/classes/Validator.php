<?php

class Validator
{
  protected $database;
  protected $errorHandler;
  protected $rules = ['required', 'minlength', 'maxlength', 'unique', 'emaail'];
  public function __construct(Database $database, ErrorHandler $errorHandler)
  {
    $this->database = $database;
    $this->errorHandler = $errorHandler;
  }
  public function check($items, $rules)
  {
    foreach($items as $item => $value)
    {
      if(in_array($item, array_key($rules)))
      {
        $this->validate([
          'field' => $item,
          'value' => $value,
          'rule' => $rules[$item]
        ]);
      }
    }
    return $this;
  }
  protected function validate($item)
  {
    $field = $item['field'];
    foreach($item['rules'] as $rule => $satisfier)
    {
      if(in_array($rule, $this->rules))
      {
        if(!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier]))
        {
          echo 'error';
        }
      }

    }
  }
  protected function required($field, $value, $satisfier)
  {
    return !empty(trim($value));
  }
  protected function minlength($field, $value, $satisfier)
  {
    return mb_strlen($value) >= $satisfier;
  }
  protected function maxlength($field, $value, $satisfier)
  {
    return mb_strlen($value) <= $satisfier;
  }
  protected function email($field, $value, $satisfier)
  {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
}