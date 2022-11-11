<?php

include 'config.php';

session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['logged_out'] = 1;
header('location:login.php');

?>