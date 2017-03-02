<?php
require_once 'app/init.php';
  if (!empty($_POST))
  {
    $validator = new Validator($database, $errorHandler);
    $validation = $validator->check($_POST, [
      'email' => [
        'required' => true,
        'maxlength' => 200,
        'unique' => 'users',
        'email' => true
      ],
      'username' => [
        'required' => true,
        'minlength' => 3,
        'maxlength' => 20,
        'unique' => 'users'
      ],
      'password' => [
        'required' => true,
        'minlength' => 5
      ]
    ]);

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $created = $auth->create([
      'email' => $email,
      'username' => $username,
      'password' => $password
    ]);
    if ($created)
    {
      header('Location: index.php');
    }
  }
?>

<! doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUP</title>
  </head>
  <body>
    <form action="signup.php" method="post">
      <fieldset>
        <legend>Sign UP</legend>
        <label>
          Email
          <input type="text" name="email">
        </label>
        <label>
          Username
          <input type="text" name="username">
        </label>
        <label>
          Password
          <input type="password" name="password">
        </label>
      </fieldset>
      <input type="submit" value="signup">
    </form>
  </body>
  </html>