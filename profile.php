<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Profile</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / profile </p>
   </div>

   <section class="contact">

      <form action="" method="post">
         <h3>Profile</h3>
         <img style="width: 50%" src="images/user-icon.png" alt="">
         <?php


         // $conn = mysqli_connect("localhost", "root", "", "food_db");
         # already declare in config.php no need declare one more times at here.

         $query = "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
         $query_run = mysqli_query($conn, $query);


         while ($row = mysqli_fetch_array($query_run)) {


         ?>

            <input type="text" name="name" required value="<?= $row['name']; ?>" class="box">
            <input type="email" name="email" required value="<?= $row['email']; ?>" class="box">
            <input type="phone_number" name="phone_number" required value="<?= $row['phone_number']; ?>" class="box">
            <a href="update_profile.php" class="btn" style="background-color:#3EB489">update info</a>

            <p style="font-size:20px; color:#686A6C" class="address"><i class="fas fa-map-marker-alt"></i><span><?php if ($row['address'] == '') {
                                                                                                                     echo 'please enter your address';
                                                                                                                  } else {
                                                                                                                     echo $row['address'];
                                                                                                                  } ?></span></p>
            <a href="update_address.php" class="btn" style="background-color:#3EB489">update address</a>
         <?php
         }
         ?>
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['addr_updated'])) { ?>

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
         title: 'Address updated successfully!'
      })
   </script>

<?php }

unset($_SESSION["addr_updated"]);
?>

</html>