<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {


?>

    <div class="row">
        <!-- 1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts  --->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / View Orders

                </li>

            </ol><!-- breadcrumb Ends  --->

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
                        <!-- panel-title Starts -->

                        <i class="fa fa-money fa-fw"></i> View Orders

                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table id="view_orders" class="table table-bordered table-hover table-striped">
                            <!-- table table-bordered table-hover table-striped Starts -->

                            <thead>
                                <!-- thead Starts -->

                                <tr>

                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>

                            </thead><!-- thead Ends -->


                            <tbody>
                                <!-- tbody Starts -->

                                <?php

                                $i = 0;

                                if(isset($_GET['orders'])) {
                                    if($_GET['orders'] == 'pending') {
                                        $get_order = 'SELECT * FROM orders WHERE order_status = "pending"';
                                    }
                                    elseif($_GET['orders'] == 'completed') {
                                        $get_order = 'SELECT * FROM orders WHERE order_status = "completed"';
                                    }
                                }
                                else {
                                    $get_order = "select * from orders";
                                }
                                $run_order = mysqli_query($con, $get_order);

                                while ($row_order = mysqli_fetch_array($run_order)) {


                                    $order_id = $row_order['id'];

                                    $c_id = $row_order['user_id'];

                                    $c_name = $row_order['name'];

                                    $product = $row_order['total_products'];

                                    $total_price = $row_order['total_price'];

                                    $payment_method = $row_order['method'];

                                    $payment_status = $row_order['payment_status'];

                                    $order_status = $row_order['order_status'];


                                    $i++;

                                ?>

                                    <tr>

                                        <td><?php echo $i; ?></td>

                                        <td>
                                            <?php

                                            $get_customer = "select * from users where id='$c_id'";
                                            $run_customer = mysqli_query($con, $get_customer);
                                            $row_customer = mysqli_fetch_array($run_customer);
                                            $customer_email = $row_customer['name'];
                                            echo $customer_email;
                                            ?>
                                        </td>

                                        <td><?php echo $product; ?></td>
                                        <td><?php echo $total_price; ?></td>

                                        <td>
                                            <?php

                                            $get_customer_order = "select * from orders where id='$order_id'";

                                            $run_customer_order = mysqli_query($con, $get_customer_order);

                                            $row_customer_order = mysqli_fetch_array($run_customer_order);

                                            $order_date = $row_customer_order['placed_on'];

                                            echo $order_date;

                                            ?>
                                        </td>


                                        <td><?php echo $payment_method; ?></td>
                                        <td><?php echo $payment_status; ?></td>
                                        <td><?php echo $order_status ?></td>

                                        <td>

                                            <a href="index.php?edit_about_us=<?php echo $order_id; ?>">

                                                <i class="fa fa-pencil"> </i> Edit

                                            </a>

                                        </td>

                                        <td>

                                            <a href="index.php?order_delete=<?php echo $order_id; ?>">

                                                <i class="fa fa-trash-o"></i> Delete

                                            </a>

                                        </td>


                                    </tr>

                                <?php } ?>

                            </tbody><!-- tbody Ends -->

                        </table><!-- table table-bordered table-hover table-striped Ends -->

                    </div><!-- table-responsive Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->


<?php } ?>