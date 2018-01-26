<?php
/**
 * Created by PhpStorm.
 * User: brexx
 * Date: 1/26/2018
 * Time: 12:19 PM
 */

require_once '../class/DBOperation.php';
$db_operation = new DBOperation();

if(!empty($_GET)) {
    $id = $_GET['id'];
    $db_operation->delete_comment($id);
}
header('location:   ../welcome.php');
die;