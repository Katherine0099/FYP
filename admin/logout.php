<?php

session_start();

session_destroy();

session_start();

$_SESSION['logged_out'] = 'Success';

echo "<script>window.open('login.php','_self')</script>";

?>