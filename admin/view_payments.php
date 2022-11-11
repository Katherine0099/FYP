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
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / View Payments

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
                        <!-- panel-title Starts -->

                        <i class="fa fa-money fa-fw"> </i> View Payments

                    </h3><!-- panel-title Ends -->

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table id="view_payments" class="table table-hover table-bordered table-striped">
                            <!-- table table-hover table-bordered table-striped Starts -->

                            <thead>
                                <!-- thead Starts -->

                                <tr>

                                    <th>#</th>
                                    <th>Order Code</th>
                                    <th>Invoice No</th>
                                    <th>Amount Paid</th>
                                    <th>Payment Status</th>
                                    <th>Payment Date</th>
                                    <!-- <th>Action</th> -->

                                </tr>

                            </thead><!-- thead Ends -->

                            <tbody>
                                <!-- tbody Starts -->

                                <?php

                                $i = 0;

                                $get_payments = "select * from payments";

                                $run_payments = mysqli_query($con, $get_payments);

                                while ($row_payments = mysqli_fetch_array($run_payments)) {

                                    $payment_id = $row_payments['id'];

                                    $order_code = $row_payments['order_code'];

                                    $txn = $row_payments['txn_id'];

                                    $amount = $row_payments['total_payment'];

                                    $payment_status = $row_payments['payment_status'];

                                    $created_at = $row_payments['created_at'];

                                    $i++;

                                ?>


                                    <tr>

                                        <td><?php echo $i; ?></td>

                                        <td><?php echo $order_code; ?></td>

                                        <td><?php echo $txn; ?></td>

                                        <td>RM<?php echo $amount; ?></td>

                                        <td><?php echo $payment_status; ?></td>

                                        <td><?php echo $created_at; ?></td>

                                        <!-- <td>

<a href="index.php?payment_delete=<?php echo $payment_id; ?>" >

<i class="fa fa-trash-o" ></i> Delete

</a>

</td> -->


                                    </tr>


                                <?php } ?>

                            </tbody><!-- tbody Ends -->

                        </table><!-- table table-hover table-bordered table-striped Ends -->

                    </div><!-- table-responsive Ends -->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->


<?php } ?>