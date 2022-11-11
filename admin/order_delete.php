<?php



if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<?php

    if (isset($_GET['order_delete'])) {

        $delete_id = $_GET['order_delete'];

        $delete_order = "delete from orders where id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_order);

        if ($run_delete) {

            $_SESSION['order_deleted'] = 'success';
            session_write_close();
            header('location: index.php?view_orders');
        }
    }



?>



<?php }  ?>