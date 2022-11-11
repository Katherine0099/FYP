<?php

$conn = mysqli_connect('localhost','root','','food_db') or die('connection failed');

// PayPal configuration 
define('PAYPAL_ID', 'sb-6xuy75777804@business.example.com'); 

define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'http://localhost/project/paypal_success_payment.php'); 

define('PAYPAL_CANCEL_URL', 'http://localhost/project/paypal_cancel_payment.php'); 

define('PAYPAL_CURRENCY', 'MYR'); 

// Database configuration 

// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

?>