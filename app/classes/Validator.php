<?php

class Validator
{
  protected $database;
  protected $errorHandler;
  protected $rules = ['required', 'minlength', 'maxlength', 'unique', 'emaail'];
  protected $messages = [
    'required' => 'The :field field is required.',
    'minlength' => 'The :field field must be a minimun of :satisfier characters.',
    'maxlength' => 'The :field field must be a maximun of :satisfier characters.',
    'email' => 'Must be valid email address.',
    'unique' => 'This :field is already taken.'
  ];
  public function __construct(Database $database, ErrorHandler $errorHandler)
  {
    $this->database = $database;
    $this->errorHandler = $errorHandler;
  }
  public function check($items, $rules)
  {
    foreach($items as $item => $value)
    {
      if(in_array($item, array_keys($rules)))
      {
        $this->validate([
          'field' => $item,
          'value' => $value,
          'rules' => $rules[$item]
        ]);
      }
    }
    return $this;
  }

  public function fails()
  {
    return $this->errorHandler->has_errors();
  }
  public function errors()
  {
    return $this->errorHandler;
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
          $this->errorHandler->add_error(
            str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]),
            $field
          );
        }
      }

    }
  }
  protected function unique($field, $value, $satisfier)
  {
    return !$this->database->table($satisfier)->exists([
      $field => $value
    ]);
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