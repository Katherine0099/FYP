<?php



if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
}

?>

<div class="row">
    <!-- 1 row Starts -->

    <div class="col-lg-12">
        <!-- col-lg-12 Starts -->

        <!-- <h1 class="page-header">Dashboard</h1> -->

        <ol class="breadcrumb">
            <!-- breadcrumb Starts -->

            <li class="active">

                <i class="fa fa-dashboard"></i> Dashboard

            </li>

        </ol><!-- breadcrumb Ends -->

    </div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row">
    <!-- 2 row Starts -->

    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-primary">
            <!-- panel panel-primary Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-tasks fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_products; ?> </div>

                        <div>Products</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_products">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-primary Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->


    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-green">
            <!-- panel panel-green Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-comments fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_customers; ?> </div>

                        <div>Customers</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_customers">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-green Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->


    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-yellow">
            <!-- panel panel-yellow Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-shopping-cart fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_total_orders; ?> </div>

                        <div>Orders</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_orders">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-yellow Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->


    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-red">
            <!-- panel panel-red Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-user fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_total_admins; ?> </div>

                        <div>Admin</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_users">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-red Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->


</div><!-- 2 row Ends -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-success">
            <!-- panel panel-red Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-dollar fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo number_format($count_total_earnings, 2); ?> </div>

                        <div>Earnings</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_orders">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-red Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->


    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-warning">
            <!-- panel panel-red Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-spinner fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_pending_orders ?> </div>

                        <div>Pending Orders</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_orders&orders=pending">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-red Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->



    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-info">
            <!-- panel panel-red Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-check fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_completed_orders ?> </div>

                        <div>Completed Orders</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_orders&orders=completed">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-red Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->



    <div class="col-lg-3 col-md-6">
        <!-- col-lg-3 col-md-6 Starts -->

        <div class="panel panel-danger">
            <!-- panel panel-red Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <div class="row">
                    <!-- panel-heading row Starts -->

                    <div class="col-xs-3">
                        <!-- col-xs-3 Starts -->

                        <i class="fa fa-percent fa-5x"> </i>

                    </div><!-- col-xs-3 Ends -->

                    <div class="col-xs-9 text-right">
                        <!-- col-xs-9 text-right Starts -->

                        <div class="huge"> <?php echo $count_total_reservation; ?> </div>

                        <div>Total Reservation</div>

                    </div><!-- col-xs-9 text-right Ends -->

                </div><!-- panel-heading row Ends -->

            </div><!-- panel-heading Ends -->

            <a href="index.php?view_enquiry">

                <div class="panel-footer">
                    <!-- panel-footer Starts -->

                    <span class="pull-left"> View Details </span>

                    <span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

                    <div class="clearfix"></div>

                </div><!-- panel-footer Ends -->

            </a>

        </div><!-- panel panel-red Ends -->

    </div><!-- col-lg-3 col-md-6 Ends -->
</div>

<div class="row">
    <!-- 3 row Starts -->

    <div class="col-lg-12">
        <!-- col-lg-8 Starts -->

        <div class="panel panel-primary">
            <!-- panel panel-primary Starts -->

            <div class="panel-heading">
                <!-- panel-heading Starts -->

                <h3 class="panel-title">
                    <!-- panel-title Starts -->

                    <i class="fa fa-money fa-fw"></i> New Orders

                </h3><!-- panel-title Ends -->

            </div><!-- panel-heading Ends -->

            <div class="panel-body">
                <!-- panel-body Starts -->

                <div class="table-responsive">
                    <!-- table-responsive Starts -->

                    <table id="dashboard" class="table table-striped table-bordered">
                        <!-- table table-bordered table-hover table-striped Starts -->

                        <thead>
                            <!-- thead Starts -->

                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Products</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>


                            </tr>

                        </thead><!-- thead Ends -->

                        <tbody>
                            <!-- tbody Starts -->

                            <?php

                            $i = 0;

                            $get_order = "select * from orders";
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
                                    <td><?php echo $payment_method; ?></td>
                                    <td><?php echo $payment_status; ?></td>
                                    <td>
                                        <?php
                                        if ($order_status == 'pending') {

                                            echo $order_status = 'pending';
                                        } else {

                                            echo $order_status = 'completed';
                                        }

                                        ?>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody><!-- tbody Ends -->


                    </table><!-- table table-bordered table-hover table-striped Ends -->

                </div><!-- table-responsive Ends -->

                <div class="text-right">
                    <!-- text-right Starts -->

                    <a href="index.php?view_orders">

                        View All Orders <i class="fa fa-arrow-circle-right"></i>

                    </a>

                </div><!-- text-right Ends -->


            </div><!-- panel-body Ends -->

        </div><!-- panel panel-primary Ends -->

    </div><!-- col-lg-8 Ends -->

    <div class="col-md-4">
        <!-- col-md-4 Starts -->

        <div class="panel">
            <!-- panel Starts -->



        </div><!-- panel Ends -->

    </div><!-- col-md-4 Ends -->

</div><!-- 3 row Ends -->