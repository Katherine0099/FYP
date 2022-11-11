<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
}

?>
<!DOCTYPE html>

<html>

<head>

  <title> Insert Products </title>


  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

</head>

<body>

  <div class="row">
    <!-- row Starts -->

    <div class="col-lg-12">
      <!-- col-lg-12 Starts -->

      <ol class="breadcrumb">
        <!-- breadcrumb Starts -->

        <li class="active">

          <i class="fa fa-dashboard"> </i> Dashboard / Insert Products

        </li>

      </ol><!-- breadcrumb Ends -->

    </div><!-- col-lg-12 Ends -->

  </div><!-- row Ends -->


  <div class="row">
    <!-- 2 row Starts -->

    <div class="col-lg-12">
      <!-- col-lg-12 Starts -->

      <div class="panel panel-default">
        <!-- panel panel-default Starts -->

        <div class="panel-heading">
          <!-- panel-heading Starts -->

          <h3 class="panel-title">

            <i class="fa fa-money fa-fw"></i> Insert Products

          </h3>

        </div><!-- panel-heading Ends -->

        <div class="panel-body">
          <!-- panel-body Starts -->

          <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <!-- form-horizontal Starts -->

            <div class="form-group">
              <!-- form-group Starts -->

              <label class="col-md-3 control-label"> Product Name </label>

              <div class="col-md-6">

                <input type="text" name="name" class="form-control" required>

              </div>

            </div><!-- form-group Ends -->


            <div class="form-group">
              <!-- form-group Starts -->

              <label class="col-md-3 control-label"> Product Image </label>

              <div class="col-md-6">

                <input type="file" name="image" class="form-control" required>

              </div>

            </div>
            <!-- form-group Ends -->


            <div class="form-group">
              <!-- form-group Starts -->

              <label class="col-md-3 control-label"> Product Price </label>

              <div class="col-md-6">

                <input type="text" name="price" class="form-control" required>

              </div>

            </div><!-- form-group Ends -->

            <div class="form-group">
              <!-- form-group Starts -->

              <label class="col-md-3 control-label"></label>

              <div class="col-md-6">

                <input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control">

              </div>

            </div><!-- form-group Ends -->

          </form><!-- form-horizontal Ends -->

        </div><!-- panel-body Ends -->

      </div><!-- panel panel-default Ends -->

    </div><!-- col-lg-12 Ends -->

  </div><!-- 2 row Ends -->


</body>

</html>

<?php

if (isset($_POST['submit'])) {

  $product_title = $_POST['name'];
  $product_price = $_POST['price'];

  $status = "product";

  $product_img = $_FILES['image']['name'];

  $temp_name = $_FILES['image']['tmp_name'];


  move_uploaded_file($temp_name, "food_images/$product_img");


  $insert_product = "insert into products (name,image,price) values ('$product_title','$product_img','$product_price')";

  $run_product = mysqli_query($con, $insert_product);

  if ($run_product) {
    $_SESSION['product_added'] = 'success';
    session_write_close();
    header('location: index.php?view_products');
  }
}

?>