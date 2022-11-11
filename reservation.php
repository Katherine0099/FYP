<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['send'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
   $number = $_POST['number'];

   $date = $_POST['date'];
   $time = $_POST['time'];
   $date = mysqli_real_escape_string($conn, $date);
   $time = mysqli_real_escape_string($conn, $time);

   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND phone_number = '$phone_number' AND number = '$number' AND date = '$date' AND time = '$time' AND message = '$msg'") or die('query failed');

   if (mysqli_num_rows($select_message) > 0) {
      $_SESSION['res_error'] = 1;
   } else {
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, phone_number, number, date, time, message) VALUES('$user_id', '$name', '$email', '$phone_number', '$number', '$date', '$time', '$msg')") or die('query failed');
      $_SESSION['res'] = 1;
      header('location:reservation_list.php');
   }
}

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
      <h3 style="color:white">Make a Reservation</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / reservation </p>
   </div>

   <section class="contact">

      <?php

      $reservation_query = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id' AND reser_status = 'On going'");

      if (mysqli_num_rows($reservation_query) > 0) { ?>
         <div style="display: flex; justify-content: center; margin-bottom: 20px;">
            <a href="reservation_list.php" class="btn" style="width: 100%; max-width: 50rem; text-align: center;background-color:#3EB489">Current Reservation List</a>
         </div>

      <?php } ?>



      <form action="" method="post">
         <h3>Restaurant Reservation</h3>

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
            <input type="number" name="number" required placeholder="enter number of diners" class="box" min="1">
            <label style="font-size:18px ; color:#686A6C" for="checkin-date">Select Dine-in Date & Time:</label>
            <input type="date" id="checkin-date" name="date" required class="box">
            <input type="time" id="appt" name="time" min="10:00" max="20:00" value="13:00" class="box" required>
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="Confirm Reservation" name="send" class="btn" style="background-color:#3EB489">
         <?php
         }
         ?>
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['res_error'])) { ?>

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
         title: 'Reservation already made!'
      })
   </script>

<?php }

unset($_SESSION["res_error"]);
?>

</html>