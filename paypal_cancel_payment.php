<?php
session_start();
$_SESSION['payment_failed'] = 1;
// session_write_close();
header('location:cart.php');

?>