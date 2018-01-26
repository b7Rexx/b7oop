<?php
require_once '../class/DBOperation.php';

$session = new Session();
$session->login_session_check();
$db_operation = new DBOperation();
setcookie('setuser','ok',time()+(24*60*60));

if (!empty($_POST)) {
    $email = $_POST['user'];
    $pass = $_POST['pass'];
    $set_user = (isset($_POST['set_user']))?'ok':'no';
    $result = $db_operation->select_db( 'users');
    while ($row = mysqli_fetch_assoc($result)) {
        if ($email == $row['email'] && password_verify($pass, $row['pass'])) {
            $_SESSION['user'] = $email;
            if($set_user == 'ok'){
                setcookie('setuser','ok',time()+(24*60*60));
                $_SESSION['ok']='close to set cookie';
            }
            header('location: http://b7oop.com/welcome.php');
            die;
        }
    }
    $_SESSION['login_msg'] = 'Login failed';
    header('location: http://b7oop.com/login.php');
    die;
}