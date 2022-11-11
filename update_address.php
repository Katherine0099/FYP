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

   $address = $_POST['flat'] . ', ' . $_POST['building'] . ', ' . $_POST['area'] . ', ' . $_POST['town'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address);

   $update_address = "update users set address='$address' where id='$user_id'";
   $run_enquiry = mysqli_query($conn, $update_address);

   $_SESSION['addr_updated'] = 1;

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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Update Address</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / update address </p>
   </div>

   <section class="form-container">

      <form action="" method="post">
         <h3>Your Address</h3>
         <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat">
         <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
         <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
         <input type="text" class="box" placeholder="town name" required maxlength="50" name="town">
         <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
         <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
         <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
         <input type="text" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6" name="pin_code">
         <input type="submit" value="save address" name="submit" class="btn" style="background-color:#3EB489">
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>