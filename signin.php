<?php
require_once 'app/init.php';

?>
<! doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
  </head>
    <body>
      <form action="signin.php" method="post">
        <fieldset>
          <legend>Sign In</legend>
          <label>
            Username
            <input type="text" name="username">
          </label>
          <label>
            Password
            <input type="password" name="password">
          </label>
        </fieldset>
        <input type="submit" value="signin">
      </form>
    </body>
  </html>