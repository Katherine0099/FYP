<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   // $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $_SESSION['exist'] = 1;
   }else{
      if($pass != $cpass){
         $_SESSION['pw_not_matched'] = 1;
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, phone_number) VALUES('$name', '$email', '$cpass', '$phone_number')") or die('query failed');
         $_SESSION['registered'] = 1;
         header('location:login.php');
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
   <title>register</title>

   <?php require 'head.php'; ?>

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="phone_number" name="phone_number" placeholder="enter your phone number" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <!-- <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select> -->
      <input type="submit" name="submit" value="register now" class="btn" style="background-color:#3EB489">
      <p>already have an account? <a href="login.php" style="color:#3EB489">login now</a></p>
   </form>

</div>

</body>

<?php if (isset($_SESSION['exist'])) { ?>

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
      title: 'User already exist!'
   })
</script>

<?php }

unset($_SESSION["exist"]);
?>

<?php if (isset($_SESSION['pw_not_matched'])) { ?>

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

unset($_SESSION["pw_not_matched"]);
?>

</html>