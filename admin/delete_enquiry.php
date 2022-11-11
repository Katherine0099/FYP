<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<?php

    if (isset($_GET['delete_enquiry'])) {

        $delete_id = $_GET['delete_enquiry'];

        $delete_enquiry = "delete from message where id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_enquiry);

        if ($run_delete) {

            $_SESSION['reservation_deleted'] = 'success';
            session_write_close();
            header('location: index.php?view_enquiry');
        }
    }


?>



<?php } ?>