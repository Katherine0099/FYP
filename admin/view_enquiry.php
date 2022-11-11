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

                    <i class="fa fa-dashboard"></i> Dashboard / View Reservation

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

                        <i class="fa fa-money fa-fw"></i> View Reservation

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <div class="table-responsive">
                        <!-- table-responsive Starts -->

                        <table id="view_reservations" class="table table-bordered table-hover table-striped">
                            <!-- table table-bordered table-hover table-striped Starts -->

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Customer Name</th>

                                    <th>Email</th>

                                    <th>Phone Number</th>

                                    <th>Number of Diners</th>

                                    <th>Date</th>

                                    <th>Time</th>

                                    <th>Reservation Status</th>

                                    <th>Delete</th>

                                    <th>Edit</th>

                                </tr>

                            </thead>

                            <tbody>
                                <!-- tbody Starts -->

                                <?php

                                $i = 0;

                                $get_reser = "select * from message";

                                $run_reser = mysqli_query($con, $get_reser);

                                while ($row_res = mysqli_fetch_array($run_reser)) {

                                    $res_id = $row_res['id'];

                                    $res_name = $row_res['name'];

                                    $res_email = $row_res['email'];

                                    $res_phone_number = $row_res['phone_number'];

                                    $res_number = $row_res['number'];

                                    $res_date = $row_res['date'];

                                    $res_time = $row_res['time'];

                                    $reser_status = $row_res['reser_status'];

                                    $i++;

                                ?>

                                    <tr>

                                        <td> <?php echo $i; ?> </td>

                                        <td> <?php echo $res_name; ?> </td>

                                        <td> <?php echo $res_email; ?> </td>

                                        <td> <?php echo $res_phone_number; ?> </td>

                                        <td> <?php echo $res_number; ?> </td>

                                        <td> <?php echo $res_date; ?> </td>

                                        <td> <?php echo $res_time; ?> </td>

                                        <td>
                                            <?php
                                            if ($reser_status == 'On going') {

                                                echo $reser_status = 'On going';
                                            } else {

                                                echo $reser_status = 'Completed';
                                            }

                                            ?>
                                        </td>

                                        <td>

                                            <a href="index.php?delete_enquiry=<?php echo $res_id; ?>">

                                                <i class="fa fa-trash-o"> </i> Delete

                                            </a>

                                        </td>


                                        <td>

                                            <a href="index.php?edit_enquiry=<?php echo $res_id; ?>">

                                                <i class="fa fa-pencil"> </i> Edit

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