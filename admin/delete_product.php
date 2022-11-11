<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
}

?>

<?php

if (isset($_GET['delete_product'])) {

    $delete_id = $_GET['delete_product'];

    $delete_pro = "delete from products where id='$delete_id'";

    $run_delete = mysqli_query($con, $delete_pro);

    if ($run_delete) {

        // session_start();

        $_SESSION['product_deleted'] = "success";

        session_write_close();

        header('location: index.php?view_products');
    }
}

?>