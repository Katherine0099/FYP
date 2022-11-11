

<header class="header">

   <!-- <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div> -->

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">🍸</a>

         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Menu</a>
            <a href="reservation.php">Reservation</a>
            <a href="orders.php">Orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <?php if(isset($_SESSION['user_id'])) {?>
               <div id="user-btn" class="fas fa-user"></div>
            <?php }?>
            <?php if(!isset($_SESSION['user_id'])) {?>
               <a id="user-btn" class="fas fa-user" href="login.php"></a>
            <?php }?>
            <?php
               if(isset($_SESSION['user_id'])) {
                  $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                  $cart_rows_number = mysqli_num_rows($select_cart_number); 
               }
               elseif(!isset($_SESSION['user_id'])) {
                  $cart_rows_number = 0;
               }
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <?php if(isset($_SESSION['user_id'])) {?>
         <div class="user-box">
            <p>Username : <span style="color:#3EB489"><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span style="color:#3EB489"><?php echo $_SESSION['user_email']; ?></span></p>
            <p><a href="profile.php" style="color:#3EB489">Update Profile</a></p>
            <a href="logout.php" class="delete-btn">logout</a>  
         </div>
         <?php }?>
      </div>
   </div>

</header>