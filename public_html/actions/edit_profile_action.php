<?php
require_once '../class/DBOperation.php';

if (!empty($_POST)) {
    if (isset($_POST['edit_id'])) {
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
        $contact = (isset($_POST['contact'])) ? $_POST['contact'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $bio = (isset($_POST['bio'])) ? $_POST['bio'] : '';
        $id = $_POST['edit_id'];

        $db_operation = new DBOperation();
        $edit_info = $db_operation->edit_info($gender,$address,$contact,$bio,$id,$name);

        if ($edit_info) {
            header('location: http://b7oop.com/edit_profile.php');
            die;
        }

    } else {
        header('location: http://b7oop.com/welcome.php');
        die;
    }
}