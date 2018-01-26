<?php
/**
 * Created by PhpStorm.
 * User: brexx
 * Date: 1/26/2018
 * Time: 10:41 AM
 */

require_once '../class/DBOperation.php';
$db_operation = new DBOperation();

if(!empty($_GET)) {
    $id = $_GET['id'];
    $row = $db_operation->select_user_detail('images',$id);
    $path = "../img/uploads/".$row['image'];
    unlink($path);
    $db_operation->del_post_image($id);
}
header('location:   ../welcome.php');
die;