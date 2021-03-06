<?php
session_start();

$app = __DIR__;


require_once "{$app}/classes/Validator.php";
require_once "{$app}/classes/ErrorHandler.php";
require_once "{$app}/classes/Hash.php";
require_once "{$app}/classes/Database.php";
require_once "{$app}/classes/Auth.php";


$database = new Database();
$hash = new Hash;
$auth = new Auth($database, $hash);
$errorHandler = new ErrorHandler;
$database->table('users');

?>
