<?php
session_start();

Class Session
{
//Property


//Methods

    /**
     * redirects to login if user session not set
     */
    function welcome_session_check()
    {
        if (isset($_COOKIE['rem_user'])) {
            $_SESSION['user'] = $_COOKIE['rem_user'];
        }
        if (!isset($_SESSION['user'])) {
            header('location: http://b7oop.com');
            die;
        }
    }


    /**
     * redirects to welcome if user session already set
     */

    function login_session_check()
    {
        if (isset($_COOKIE['rem_user'])) {
            $_SESSION['user'] = $_COOKIE['rem_user'];
        }
        if (isset($_SESSION['user'])) {
            header('location: http://b7oop.com/welcome.php');
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
    function add_info(){
        if (!isset($_SESSION['reg_add_info'])) {
            header('location: http://b7db.com/welcome.php');
            die;
        }
        unset($_SESSION['reg_add_info']);
    }

    //logout
    function logout(){
        setcookie('user','',100);
        unset($_SESSION['user']);
    }
}