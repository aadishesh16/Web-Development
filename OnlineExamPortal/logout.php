<?php 
error_reporting(0);
session_start();
unset($_SESSION['stdname']);

        $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php'); ?>