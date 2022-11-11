<?php

require 'Carbon/autoload.php';

use Carbon\Carbon;

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   // $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
      $_SESSION['empty_cart'] = 1;
   } else {

      if ($method == 'paypal') {
      } elseif ($method == 'cash on delivery') {
         $order_code = "ORDER" . date("YmdHis") . "D" . $user_id;
         mysqli_query($conn, "INSERT INTO `orders`(order_code, user_id, name, number, email, method, address, total_products, total_price, placed_on) 
         VALUES('$order_code', '$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $_SESSION['order_placed'] = 1;
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         header('location:orders.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">checkout</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / checkout </p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$' . $fetch_cart['price'] . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
      <div class="grand-total"> grand total : <span>RM <?php echo $grand_total; ?>/-</span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <h3>place your order</h3>
         <div class="flex">

            <?php

            // $conn = mysqli_connect("localhost", "root", "", "food_db");
            # already declare in config.php no need declare one more times at here.

            $user_id = $_SESSION['user_id'];

            $cart_total = 0;
            $item_number = 0;

            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($cart_query) > 0) {
               while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                  $item_number += $cart_item['quantity'];
                  $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
                  $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                  $cart_total += $sub_total;
               }
            }

            $now = Carbon::now()->format('YmdHis');
            $name = $_SESSION['user_name'];

            $item_name = $name . "_orders_" . $now;

            $query = "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
            $query_run = mysqli_query($conn, $query);


            while ($row = mysqli_fetch_array($query_run)) {


            ?>

               <div class="inputBox">
                  <span>Your Name :</span>
                  <input type="text" name="name" required value="<?= $row['name']; ?>">
               </div>
               <div class="inputBox">
                  <span>Your Number :</span>
                  <input type="number" name="number" required value="<?= $row['phone_number']; ?>">
               </div>
               <div class="inputBox">
                  <span>Your Email :</span>
                  <input type="email" name="email" required value="<?= $row['email']; ?>">
               </div>
               <div class="inputBox">
                  <span>Payment Method :</span>
                  <select id="method" name="method">
                     <option value="cash on delivery">Cash on delivery</option>
                     <!-- <option value="credit card">credit card</option> -->
                     <option value="paypal">PayPal</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Address :</span>
                  <input type="text" min="0" name="address" required value="<?= $row['address']; ?>">
               </div>


               <!-- paypal input -->

               <!-- Identify your business so that you can collect the payments. -->

               <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

               <!-- Specify a Buy Now button. -->
               <input type="hidden" name="cmd" value="_xclick">
               <!-- Specify details about the item that buyers will purchase. -->

               <input type="hidden" name="item_name" value="<?php echo $item_name; ?>">

               <input type="hidden" name="item_number" value="<?php echo $item_number; ?>">

               <input type="hidden" name="amount" value="<?php echo $cart_total; ?>">

               <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

               <!-- Specify URLs -->

               <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">

               <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

               <!-- paypal input -->


               <!-- <div class="inputBox">
                  <span>address line 01 :</span>
                  <input type="text" name="street" required placeholder="e.g. street name">
               </div>
               <div class="inputBox">
                  <span>city :</span>
                  <input type="text" name="city" required placeholder="e.g. mumbai">
               </div>
               <div class="inputBox">
                  <span>state :</span>
                  <input type="text" name="state" required placeholder="e.g. maharashtra">
               </div>
               <div class="inputBox">
                  <span>country :</span>
                  <input type="text" name="country" required placeholder="e.g. india">
               </div>
               <div class="inputBox">
                  <span>pin code :</span>
                  <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
               </div> -->
         </div>
         <input id="cash_btn" type="submit" value="order now" class="btn" name="order_btn" style="background-color:#3EB489">
         <input id="paypal_btn" type="submit" value="order now" formaction="<?php echo PAYPAL_URL; ?>" class="btn" name="order_btn" style="display: none;">
      <?php
            }
      ?>
      </form>

   </section>


   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
      $('#method').change(function() {
         var payment_method = $(this).find(':selected').val();
         if (payment_method == "paypal") {
            $('#paypal_btn').show();
            $('#cash_btn').hide();
         } else if (payment_method == "cash on delivery") {
            $('#paypal_btn').hide();
            $('#cash_btn').show();

         }
      })
   </script>

</body>

<?php if (isset($_SESSION['empty_cart'])) { ?>

   <script>
      const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 3000,
         width: '500px',
         timerProgressBar: true,
         didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
      })

      Toast.fire({
         icon: 'error',
         title: 'Your cart is empty!'
      })
   </script>

<?php }

unset($_SESSION["empty_cart"]);
?>

</html>