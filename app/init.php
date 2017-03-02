<?php
session_start();

$app = __DIR__;

require_once "{$app}/classes/Database.php";
require_once "{$app}/classes/Auth.php";


$database = new Database();
$auth = new Auth($database);
$database->table('users');

?>
