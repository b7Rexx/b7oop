<?php
require_once '../class/DBOperation.php';

setcookie('set_user',   '',100);
$session = new Session();
$session->logout();
header('location: http://b7oop.com');
die;
?>