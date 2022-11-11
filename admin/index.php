<?php

ob_start();

session_start();

include("includes/db.php");

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
}
?>

<?php

$admin_session = $_SESSION['admin_email'];

$get_admin = "SELECT * FROM admins WHERE admin_email='$admin_session'";

$run_admin = mysqli_query($con, $get_admin);

$row_admin = mysqli_fetch_array($run_admin);

$admin_id = $row_admin['admin_id'];

$admin_name = $row_admin['admin_name'];

$admin_email = $row_admin['admin_email'];

// $admin_image = $row_admin['admin_image'];

// $admin_country = $row_admin['admin_country'];

// $admin_job = $row_admin['admin_job'];

$admin_contact = $row_admin['admin_contact'];

// $admin_about = $row_admin['admin_about'];


$get_products = "SELECT * FROM products";
$run_products = mysqli_query($con, $get_products);
$count_products = mysqli_num_rows($run_products);

$get_customers = "SELECT * FROM users";
$run_customers = mysqli_query($con, $get_customers);
$count_customers = mysqli_num_rows($run_customers);

$get_admins = "SELECT * FROM admins";
$run_admins = mysqli_query($con, $get_admins);
$count_total_admins = mysqli_num_rows($run_admins);


$get_total_orders = "SELECT * FROM orders";
$run_total_orders = mysqli_query($con, $get_total_orders);
$count_total_orders = mysqli_num_rows($run_total_orders);


$get_pending_orders = "SELECT * FROM orders WHERE order_status='pending'";
$run_pending_orders = mysqli_query($con, $get_pending_orders);
$count_pending_orders = mysqli_num_rows($run_pending_orders);

$get_completed_orders = "SELECT * FROM orders WHERE order_status='completed'";
$run_completed_orders = mysqli_query($con, $get_completed_orders);
$count_completed_orders = mysqli_num_rows($run_completed_orders);


$get_total_earnings = "SELECT SUM(total_price) as total FROM orders WHERE order_status = 'completed' AND payment_status = 'paid'";
$run_total_earnings = mysqli_query($con, $get_total_earnings);
$row = mysqli_fetch_assoc($run_total_earnings);
$count_total_earnings = $row['total'];

$get_total_reservation = "SELECT * FROM message";
$run_total_reservation = mysqli_query($con, $get_total_reservation);
$count_total_reservation = mysqli_num_rows($run_total_reservation);

?>


<!DOCTYPE html>
<html>

<head>

    <title>Admin Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="//cdn.shopify.com/s/files/1/2484/9148/files/SDQSDSQ_32x32.png?v=1511436147" type="image/png">

</head>


<body>

    <div id="wrapper">
        <!-- wrapper Starts -->

        <?php include_once("includes/sidebar.php"); ?>

        <div id="page-wrapper">
            <!-- page-wrapper Starts -->

            <div class="container-fluid">
                <!-- container-fluid Starts -->

                <?php

                if (isset($_GET['dashboard'])) {

                    include("dashboard.php");
                }

                if (isset($_GET['insert_product'])) {

                    include("insert_product.php");
                }

                if (isset($_GET['view_products'])) {

                    include("view_products.php");
                }

                if (isset($_GET['delete_product'])) {

                    include("delete_product.php");
                }

                if (isset($_GET['edit_product'])) {

                    include("edit_product.php");
                }


                if (isset($_GET['view_customers'])) {

                    include("view_customers.php");
                }

                if (isset($_GET['customer_delete'])) {

                    include("customer_delete.php");
                }


                if (isset($_GET['view_orders'])) {

                    include("view_orders.php");
                }

                if (isset($_GET['order_delete'])) {

                    include("order_delete.php");
                }


                if (isset($_GET['view_payments'])) {

                    include("view_payments.php");
                }

                if (isset($_GET['payment_delete'])) {

                    include("payment_delete.php");
                }

                if (isset($_GET['insert_user'])) {

                    include("insert_user.php");
                }

                if (isset($_GET['view_users'])) {

                    include("view_users.php");
                }


                if (isset($_GET['user_delete'])) {

                    include("user_delete.php");
                }



                if (isset($_GET['user_profile'])) {

                    include("user_profile.php");
                }

                if (isset($_GET['view_enquiry'])) {

                    include("view_enquiry.php");
                }

                if (isset($_GET['delete_enquiry'])) {

                    include("delete_enquiry.php");
                }

                if (isset($_GET['edit_enquiry'])) {

                    include("edit_enquiry.php");
                }


                if (isset($_GET['edit_about_us'])) {

                    include("edit_about_us.php");
                }

                ?>

            </div><!-- container-fluid Ends -->

        </div><!-- page-wrapper Ends -->

    </div><!-- wrapper Ends -->

    <!-- <script src="js/jquery.min.js"></script> -->

    <script src="js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#dashboard').DataTable();
            $('#view_products').DataTable();
            $('#view_reservations').DataTable();
            $('#view_customers').DataTable();
            $('#view_orders').DataTable();
            $('#view_payments').DataTable();
            $('#view_admins').DataTable();
        });
    </script>

</body>

<?php if (isset($_SESSION['logged_in'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'You are Logged in into Admin Panel!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["logged_in"]);
?>

<?php if (isset($_SESSION['product_added'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Product has been inserted successfully!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["product_added"]);
?>

<?php if (isset($_SESSION['product_deleted'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Product has been Deleted!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["product_deleted"]);
?>

<?php if (isset($_SESSION['product_updated'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Product has been Updated!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["product_updated"]);
?>

<?php if (isset($_SESSION['reservation_updated'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Reservation Has Been Updated!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["reservation_updated"]);
?>

<?php if (isset($_SESSION['reservation_deleted'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Reservation Has Been Deleted!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["reservation_deleted"]);
?>

<?php if (isset($_SESSION['customer_deleted'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Customer Has Been Deleted!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["customer_deleted"]);
?>

<?php if (isset($_SESSION['order_updated'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'order Has Been Updated!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["order_updated"]);
?>

<?php if (isset($_SESSION['order_deleted'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Order Has Been Deleted!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["order_deleted"]);
?>

<?php if (isset($_SESSION['admin_created'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Admin Has Been Created!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["admin_created"]);
?>

<?php if (isset($_SESSION['admin_deleted'])) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Admin Has Been Deleted!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["admin_deleted"]);
?>

<?php if (isset($_SESSION['email_taken'])) { ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Email has been using by another admin!',
            timer: 2000
        })
    </script>

<?php }

unset($_SESSION["email_taken"]);
?>

<?php ob_end_flush(); ?>

</html>