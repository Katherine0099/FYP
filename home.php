<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {

   $user_id = $_SESSION['user_id'];

   if (isset($_POST['add_to_cart']) && isset($user_id)) {

      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if (mysqli_num_rows($check_cart_numbers) > 0) {
         $_SESSION['cart_error'] = 1;
      } else {
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $_SESSION['add_to_cart'] = 1;
      }
   }
} elseif (!isset($_SESSION['user_id'])) {
   if (isset($_POST['add_to_cart'])) {
      header('location:login.php');
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home" style="background: url(images/banner.jpg) no-repeat;">

      <div class="content">
         <h3 style="color:black">Fresh coffee in the morning.</h3>
         <p style="color:#454545">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
         <a href="shop.php" class="white-btn" style="background-color:#3EB489">Order Now</a>
      </div>

   </section>


   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/about-img.png" alt="">
         </div>

         <div class="content">
            <h3>About Us</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
            <a href="about.php" class="btn" style="background-color:#3EB489">read more</a>
         </div>

      </div>

   </section>




   <section class="products">

      <h1 class="title">Our Menu</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="images/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price" style="background-color:#F88017">RM<?php echo $fetch_products['price']; ?>/-</div>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn" style="background-color:#DC381F">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn" style="background-color:#FFD801; color:black">load more</a>
      </div>

   </section>


   <!-- 
   <section class="home-contact" style="background: url(images/home-slide-2.jpg) no-repeat;">

      <div class="content">
         <h3>Make a Reservation</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
         <a href="reservation.php" class="white-btn">Book Now</a>
      </div>

   </section> -->


   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/food22.jpg" alt="">
         </div>

         <div class="content">
            <h3>Make a Reservation</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
            <a href="reservation.php" class="btn" style="background-color:#3EB489">Book Now</a>
         </div>

      </div>

   </section>



   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

<?php if (isset($_SESSION['logged_in'])) { ?>

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
         title: 'Log in successfully!'
      })
   </script>

<?php }

unset($_SESSION["logged_in"]);
?>

<?php if (isset($_SESSION['cart_error'])) { ?>

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
         title: 'Product already in cart!'
      })
   </script>

<?php }

unset($_SESSION["cart_error"]);
?>

<?php if (isset($_SESSION['add_to_cart'])) { ?>

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
         title: 'Product added to cart!'
      })
   </script>

<?php }

unset($_SESSION["add_to_cart"]);
?>

</html>