<?php
session_start();

Class Session
{
//Property


//Methods

    /**
     * redirects to login if user session not set
     */

    function __construct()
    {
        if(isset($_COOKIE['user'])){
            $_SESSION['user'] = $_COOKIE['user'];
        }
    }

    function welcome_session_check()
    {
        if (!isset($_SESSION['user'])) {
            header('location: http://b7oop.com/login.php');
            die;
        }
    }


    /**
     * redirects to welcome if user session already set
     */

    function login_session_check()
    {
        if (isset($_SESSION['user'])) {
            header('location: http://b7oop.com');
            die;
        }
    }

    /**
     * Display error during login  -- message
     */
    function displayLoginMsg()
    {
        if (isset($_SESSION['login_msg'])) {
            echo "<div class='form-control alert-warning'>";
            echo "{$_SESSION['login_msg']}";
            echo "</div>";
            unset($_SESSION['login_msg']);
        }
    }

    /**
     * Display register error --message
     */
    function displayRegisterMsg()
    {
        if (isset($_SESSION['register_msg'])) {
            echo "<div class='form-control alert-warning'>";
            echo "{$_SESSION['register_msg']}";
            echo "</div>";
            unset($_SESSION['register_msg']);
        }
    }

    //adds register info on register of new user
    function add_info()
    {
        if (!isset($_SESSION['reg_add_info'])) {
            header('location: http://b7db.com/welcome.php');
            die;
        }
        unset($_SESSION['reg_add_info']);
    }

    //logout
    function logout()
    {
        setcookie('user', '', 100, '/', 'b7oop.com');
        unset($_SESSION['user']);
        session_destroy();

    }


    function set_cookie_user($email)
    {
        setcookie('user', $email, time() + 3600, '/', 'b7oop.com');
    }
}