<?php



if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {




?>

<?php

    if (isset($_GET['customer_delete'])) {

        $delete_id = $_GET['customer_delete'];

        $delete_customer = "delete from users where id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_customer);


        if ($run_delete) {

            $_SESSION['customer_deleted'] = 'success';
            session_write_close();
            header('location: index.php?view_customers');
        }
    }


?>




<?php } ?>