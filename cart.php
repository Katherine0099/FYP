<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $_SESSION['cart_quantity'] = 1;
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   $_SESSION['delete_product'] = 1;
   session_write_close();
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   $_SESSION['delete_all'] = 1;
   session_write_close();
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <?php require 'head.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading" style="background: url(images/cooking-banner-2.jpg) no-repeat;">
      <h3 style="color:white">Your Cart</h3>
      <p style="color:#D3D3D3"> <a style="color:yellow" href="home.php">home</a> / cart </p>
   </div>

   <section class="shopping-cart">

      <h1 class="title">products added</h1>

      <div class="box-container">
         <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
         ?>
               <div class="box">
                  <a class="fas fa-times" onclick="swalFire_product(<?php echo $fetch_cart['id']; ?>);"></a>
                  <img src="images/<?php echo $fetch_cart['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_cart['name']; ?></div>
                  <div class="price">RM<?php echo $fetch_cart['price']; ?>/-</div>
                  <form action="" method="post">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                     <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="submit" name="update_cart" value="update" class="option-btn">
                  </form>
                  <div class="sub-total"> sub total : <span>RM<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
               </div>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
      </div>

      <div style="margin-top: 2rem; text-align:center;">
         <a class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="swalFire_all()">delete all</a>
      </div>

      <div class="cart-total">
         <p>grand total : <span>RM<?php echo $grand_total; ?>/-</span></p>
         <div class="flex">
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="checkout.php" style="background-color:#3EB489" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
         </div>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <script>
      function swalFire_product(id) {
         Swal.fire({
            title: 'Remove product?',
            text: "Are you sure to remove this product from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
         }).then((result) => {
            if (result.isConfirmed) {
               document.location = 'cart.php?delete=' + id;
            }
         })
      }

      function swalFire_all() {
         Swal.fire({
            title: 'Remove all product?',
            text: "Are you sure to remove all product from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
         }).then((result) => {
            if (result.isConfirmed) {
               document.location = 'cart.php?delete_all';
            }
         })
      }
   </script>

</body>

<?php if (isset($_SESSION['cart_quantity'])) { ?>

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
         title: 'Cart quantity updated!'
      })
   </script>

<?php }

unset($_SESSION["cart_quantity"]);
?>

<?php if (isset($_SESSION['delete_product'])) { ?>

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
         title: 'Product removed from your cart!'
      })
   </script>

<?php }

unset($_SESSION["delete_product"]);
?>

<?php if (isset($_SESSION['delete_all'])) { ?>

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
         title: 'All product removed from your cart!'
      })
   </script>

<?php }

unset($_SESSION["delete_all"]);
?>

<?php if (isset($_SESSION['payment_failed'])) { ?>

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
         title: 'Payment failed!'
      })
   </script>

<?php }

unset($_SESSION["payment_failed"]);
?>

</html>