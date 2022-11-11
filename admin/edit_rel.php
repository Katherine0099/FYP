<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {


?>


    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


    <?php

    if (isset($_GET['edit_about_us'])) {

        $edit_id = $_GET['edit_about_us'];

        $get_message = "select * from orders where id='$edit_id'";

        $run_edit = mysqli_query($con, $get_message);

        $row_edit = mysqli_fetch_array($run_edit);

        $order_id = $row_edit['id'];

        $c_id = $row_edit['user_id'];

        $c_name = $row_edit['name'];

        $product = $row_edit['total_products'];

        $total_price = $row_edit['total_price'];

        $order_date = $row_edit['placed_on'];

        $payment_method = $row_edit['method'];

        $payment_status = $row_edit['payment_status'];

        $order_status = $row_edit['order_status'];
    }

    ?>

    <div class="row">
        <!-- 1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / Edit Orders

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row">
        <!-- 2 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <div class="panel panel-default">
                <!-- panel panel-default Starts -->

                <div class="panel-heading">
                    <!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Edit Orders

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <form method="post" class="form-horizontal">
                        <!-- form-horizontal Starts -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Customer Name </label>

                            <div class="col-md-8">

                                <input type="text" name="name" class="form-control" value="<?php echo $c_name; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Product </label>

                            <div class="col-md-8">

                                <input type="text" name="product" class="form-control" value="<?php echo $product; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Total Price </label>

                            <div class="col-md-8">

                                <input type="text" name="total_price" class="form-control" value="<?php echo $total_price; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Order Date </label>

                            <div class="col-md-8">

                                <input type="text" name="placed_on" class="form-control" value="<?php echo $order_date; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->


                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Payment Method </label>

                            <div class="col-md-8">

                                <input type="text" name="payment_method" class="form-control" value="<?php echo $payment_method; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->


                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Payment Status </label>

                            <div class="col-md-8">

                                <input type="text" name="payment_status" class="form-control" value="<?php echo $payment_status; ?>">

                            </div>

                        </div><!-- form-group Ends -->


                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Order Status </label>

                            <div class="col-md-8">

                                <input type="text" name="$order_status" class="form-control" value="<?php echo $order_status; ?>">

                            </div>

                        </div><!-- form-group Ends -->



                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> </label>

                            <div class="col-md-8">

                                <input type="submit" name="submit" value="Update Order" class="btn btn-primary form-control">

                            </div>

                        </div><!-- form-group Ends -->


                    </form><!-- form-horizontal Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php


    if (isset($_POST['submit'])) {

        $payment_status = $_POST['payment_status'];

        $order_status = $_POST['order_status'];

        $update_orders = "update orders set payment_status='$payment_status', order_status='$order_status' where id='$order_id'";

        $run_enquiry = mysqli_query($con, $update_orders);

        if ($run_enquiry) {

            echo "<script>alert('One Order Has Been Updated')</script>";

            echo "<script>window.open('index.php?view_orders','_self')</script>";
        }
    }

    ?>


<?php } ?>