<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {


?>

    <?php

    if (isset($_GET['edit_enquiry'])) {

        $edit_id = $_GET['edit_enquiry'];

        $get_message = "select * from message where id='$edit_id'";

        $run_edit = mysqli_query($con, $get_message);

        $row_edit = mysqli_fetch_array($run_edit);

        $res_id = $row_edit['id'];

        $res_name = $row_edit['name'];

        $res_email = $row_edit['email'];

        $res_phone_number = $row_edit['phone_number'];

        $res_number = $row_edit['number'];

        $res_date = $row_edit['date'];

        $res_time = $row_edit['time'];

        $reser_status = $row_edit['reser_status'];
    }

    ?>

    <div class="row">
        <!-- 1 row Starts -->

        <div class="col-lg-12">
            <!-- col-lg-12 Starts -->

            <ol class="breadcrumb">
                <!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / Edit Reservation

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

                        <i class="fa fa-money fa-fw"></i> Edit Reservation

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body">
                    <!-- panel-body Starts -->

                    <form class="form-horizontal" action="" method="post">
                        <!-- form-horizontal Starts -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Customer Name </label>

                            <div class="col-md-6">

                                <input type="text" name="name" class="form-control" value="<?php echo $res_name; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Customer Email </label>

                            <div class="col-md-6">

                                <input type="text" name="email" class="form-control" value="<?php echo $res_email; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Phone Number </label>

                            <div class="col-md-6">

                                <input type="text" name="phone_number" class="form-control" value="<?php echo $res_phone_number; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Number of Diners </label>

                            <div class="col-md-6">

                                <input type="text" name="number" class="form-control" value="<?php echo $res_number; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Date </label>

                            <div class="col-md-6">

                                <input type="text" name="date" class="form-control" value="<?php echo $res_date; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->


                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Time </label>

                            <div class="col-md-6">

                                <input type="text" name="time" class="form-control" value="<?php echo $res_time; ?>" disabled="disabled">

                            </div>

                        </div><!-- form-group Ends -->

                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> Reservation Status </label>

                            <div class="col-md-6">

                            <select name="reser_status" class="select form-control">
                                    <option value="On going" <?php if($reser_status == "On going") {echo 'selected';} ?>>On Going</option>
                                    <option value="Completed" <?php if($reser_status == "Completed") {echo 'selected';} ?>>Completed</option>
                                    <option value="Cancelled" <?php if($reser_status == "Completed") {echo 'Cancelled';} ?>>Cancelled</option>
                            </select>

                            </div>

                        </div><!-- form-group Ends -->


                        <div class="form-group">
                            <!-- form-group Starts -->

                            <label class="col-md-3 control-label"> </label>

                            <div class="col-md-6">

                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update Enquiry Type">

                            </div>

                        </div><!-- form-group Ends -->


                    </form><!-- form-horizontal Ends-->

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php

    if (isset($_POST['update'])) {

        $reser_status = $_POST['reser_status'];

        $update_enquiry = "update message set reser_status='$reser_status' where id='$res_id'";

        $run_enquiry = mysqli_query($con, $update_enquiry);

        if ($run_enquiry) {

            $_SESSION['reservation_updated'] = 'success';
            session_write_close();
            header('location: index.php?view_enquiry');
        }
    }


    ?>


<?php } ?>