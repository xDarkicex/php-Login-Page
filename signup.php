<?php
require_once 'app/init.php';

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