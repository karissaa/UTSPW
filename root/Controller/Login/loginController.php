<?php
    session_start();
    session_destroy();

    $login_failed;
    $signup_failed;

    if(isset($_GET['failed_login'])) $login_failed = true;
    else $login_failed = false;

    if(isset($_GET['failed_signup'])) $signup_failed = true;
    else $signup_failed = false;


    $post_destination = 'loginChecking.php';
    $signUpDestination = 'signUpLogic.php';

    include "../../View/Login/loginView.php";
?>