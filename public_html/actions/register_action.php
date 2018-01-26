<?php
require_once '../class/DBOperation.php';
$db_operation = new DBOperation();

if (!empty($_POST)) {
    if (isset($_POST['reg_info'])) {

        $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
        $contact = (isset($_POST['contact'])) ? $_POST['contact'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $bio = (isset($_POST['bio'])) ? $_POST['bio'] : '';
        $id = $_POST['reg_info'];

        $add_info = $db_operation->edit_info($gender,$address,$contact,$bio,$id);
        if ($add_info) {
            header('location: http://b7oop.com/welcome.php');
            die;
        }

    } else {

        $user = $_POST['user'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        $user_register_check = $db_operation->select_db( 'users');
        while ($row_name = mysqli_fetch_assoc($user_register_check)) {
            if ($email == $row_name['email']) {
                $_SESSION['register_msg'] = 'User Already Exists';
                header('location: http://b7oop.com/register.php');
                die;
            }
        }

        if ($pass == $cpass) {
            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

            $insert_user = $db_operation->insert_db($user,$email,$hash_pass);
            if ($insert_user) {
                $_SESSION['user'] = $email;
                $_SESSION['reg_add_info'] = 'ok';
                header('location: http://b7oop.com/add_info.php');
                die;
            }
        } else {
            $_SESSION['register_msg'] = 'Password not match';
            header('location: http://b7oop.com/register.php');
            die;
        }
    }

} else {
    header('location: http://b7oop.com/register.php');
    die;
}