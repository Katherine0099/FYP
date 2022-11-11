<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};


if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name);

   $email = $_POST['email'];
   $email = filter_var($email);
   $phone_number = $_POST['phone_number'];
   $phone_number = filter_var($phone_number);

   $select_email = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND id != '$user_id'");
   if (mysqli_num_rows($select_email) > 0) {
      $_SESSION['email_taken'] = 1;
      session_write_close();
      header('location: update_profile.php');
   }

   $select_number = mysqli_query($conn, "SELECT * FROM `users` WHERE phone_number = '$phone_number' AND id != '$user_id'");
   if (mysqli_num_rows($select_number) > 0) {
      $_SESSION['phone_taken'] = 1;
      session_write_close();
      header('location: update_profile.php');
   }

   if ($_POST['old_pass'] && mysqli_num_rows($select_number) == 0 && mysqli_num_rows($select_email) == 0) {
      $select_old_pass = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
      while ($check_pass = mysqli_fetch_assoc($select_old_pass)) {

         if (($check_pass['password']) != md5($_POST['old_pass'])) {
            $_SESSION['old_pw_not_matched'] = 1;
         }
         if ($check_pass['password'] == md5($_POST['old_pass'])) {
            if (!$_POST['new_pass'] || !$_POST['confirm_pass']) {
               $_SESSION['empty_pw'] = 1;
            }
            if ($_POST['new_pass'] != $_POST['confirm_pass']) {
               $_SESSION['confirm_pw_not_matched'] = 1;
            }
            if ($_POST['new_pass'] == $_POST['confirm_pass'] && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])) {
               $new_pass = md5($_POST['new_pass']);
               $update_info = "update users set name='$name', email='$email', phone_number='$phone_number', password='$new_pass' where id='$user_id'";
               $run_enquiry = mysqli_query($conn, $update_info);
               $_SESSION['updated'] = 1;
            }
         }
      };
   }

   if (!$_POST['old_pass'] && mysqli_num_rows($select_number) == 0 && mysqli_num_rows($select_email) == 0) {
      $update_info = "update users set name='$name', email='$email', phone_number='$phone_number' where id='$user_id'";
      $run_enquiry = mysqli_query($conn, $update_info);
      $_SESSION['updated'] = 1;
   }

   header('location: profile.php');
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

   <!-- header section starts  -->
   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Update Profile</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / update profile </p>
   </div>

   <!-- header section ends -->

   <section class="form-container update-form">

      <form action="" method="post">
         <h3>update profile</h3>
         <img style="width: 50%" src="images/user-icon.png" alt="">
         <?php


         // $conn = mysqli_connect("localhost", "root", "", "food_db");
         # already declare in config.php no need declare one more times at here.

         $query = "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
         $query_run = mysqli_query($conn, $query);


         while ($row = mysqli_fetch_array($query_run)) {


         ?>

            <input type="text" name="name" value="<?= $row['name']; ?>" class="box" maxlength="50">
            <input type="email" name="email" value="<?= $row['email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="text" name="phone_number" value="<?= $row['phone_number']; ?>" class=" box" min="0" max="9999999999" maxlength="10">
            <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="update now" name="submit" class="btn" style="background-color:#3EB489">
         <?php
         }
         ?>
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['phone_taken'])) { ?>

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
         title: 'Phone number already used by other user!'
      })
   </script>

<?php }

unset($_SESSION["phone_taken"]);
?>

<?php if (isset($_SESSION['old_pw_not_matched'])) { ?>

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
         title: 'Old password not matched!'
      })
   </script>

<?php }

unset($_SESSION["old_pw_not_matched"]);
?>

<?php if (isset($_SESSION['empty_pw'])) { ?>

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
         title: 'Password cannot be empty!'
      })
   </script>

<?php }

unset($_SESSION["empty_pw"]);
?>

<?php if (isset($_SESSION['confirm_pw_not_matched'])) { ?>

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
         title: 'Confirm password not matched!'
      })
   </script>

<?php }

unset($_SESSION["confirm_pw_not_matched"]);
?>

<?php if (isset($_SESSION['updated'])) { ?>

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
         title: 'Profile updated successfully!'
      })
   </script>

<?php }

unset($_SESSION["updated"]);
?>

</html>