<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {


?>

<?php

    if (isset($_GET['user_delete'])) {

        $delete_id = $_GET['user_delete'];

        $delete_user = "delete from admins where admin_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_user);

        if ($run_delete) {

            $_SESSION['admin_deleted'] = 'success';
            session_write_close();
            header('location: index.php?view_users');
        }
    }


?>

<?php } ?>