<?php
/**
 * Created by PhpStorm.
 * User: brexx
 * Date: 1/26/2018
 * Time: 11:29 AM
 */
require_once '../class/DBOperation.php';
$db_operation = new DBOperation();
if(!empty($_POST)){
    $comment = $_POST['comment'];
    $image_id = $_POST['image_id'];
    $user_id = ($db_operation->select_user_detail('users',$_SESSION['user']))['id'];
    $db_operation->insert_into_comment($comment,$user_id,$image_id);
}
header('location: ../index.php');
