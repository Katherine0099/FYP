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
   <title>Your Reservation</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Your Reservations</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / your reservations </p>
   </div>

   <section class="placed-orders">

      <h1 class="title">Your Reservations</h1>

      <div class="box-container">

         <?php
         $res_query = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id' AND reser_status = 'On going'") or die('query failed');
         if (mysqli_num_rows($res_query) > 0) {
            while ($fetch_res = mysqli_fetch_assoc($res_query)) {
         ?>
               <div class="box">
                  <p> Name : <span><?php echo $fetch_res['name']; ?></span> </p>
                  <p> Email : <span><?php echo $fetch_res['email']; ?></span> </p>
                  <p> Number of Diners : <span><?php echo $fetch_res['number']; ?></span> </p>
                  <p> Date : <span><?php echo $fetch_res['date']; ?></span> </p>
                  <p> Time : <span><?php echo $fetch_res['time']; ?></span> </p>
                  <p> Reservation Status : <span style="color:<?php if ($fetch_res['reser_status'] == 'On going') {
                                                                  echo 'red';
                                                               } else {
                                                                  echo 'green';
                                                               } ?>;"><?php echo $fetch_res['reser_status']; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no reservations yet!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['res'])) { ?>

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
         title: 'Reservation successful!'
      })
   </script>

<?php }

unset($_SESSION["res"]);
?>

</html>