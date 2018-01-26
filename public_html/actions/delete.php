<?php
require_once '../class/DBOperation.php';

$db_operation = new DBOperation();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db_operation->delete_user_with_id('users',$id);
}
header('location: http://b7oop.com');
die;