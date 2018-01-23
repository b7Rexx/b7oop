<?php
require_once '../class/DBOperation.php';

$session = new Session();
$session->logout();
header('location: http://b7oop.com');
die;
?>