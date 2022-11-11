<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Your Orders</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / orders </p>
   </div>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
         ?>
               <div class="box">
                  <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                  <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                  <p> total price : <span>RM <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                  <p> order status : <span style="color:<?php if ($fetch_orders['order_status'] == 'pending') {
                                                            echo 'red';
                                                         } else {
                                                            echo 'green';
                                                         } ?>;"><?php echo $fetch_orders['order_status']; ?></span> </p>
                  <p> payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                               echo 'red';
                                                            } else {
                                                               echo 'green';
                                                            } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['order_placed'])) { ?>

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
      icon: 'success',
      title: 'Order placed succesfully!'
   })
</script>

<?php }

unset($_SESSION["order_placed"]);
?>

<?php if (isset($_SESSION['payment_success'])) { ?>

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
      icon: 'success',
      title: 'Payment success and order placed!'
   })
</script>

<?php }

unset($_SESSION["payment_success"]);
?>

</html>