<?php

session_start();

include("includes/db.php");

?>

<!DOCTYPE HTML>
<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/sweetalert.css">

</head>

<body>

    <div class="container">
        <!-- container Starts -->

        <form class="form-login" action="" method="post">
            <!-- form-login Starts -->

            <h2 class="form-login-heading">Admin Login</h2>

            <input type="text" class="form-control" name="admin_email" placeholder="Email Address" required>

            <input type="password" class="form-control" name="admin_pass" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">

                Log in

            </button>


        </form><!-- form-login Ends -->

    </div><!-- container Ends -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($_SESSION['logged_out'])) { ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'You are Logged Out!',
                timer: 2000
            })
        </script>

    <?php }

    unset($_SESSION["logged_out"]);
    ?>

    <?php if (isset($_SESSION['admin_updated'])) { ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Admin has been Updated!',
                timer: 2000
            })
        </script>

    <?php }

    unset($_SESSION["admin_updated"]);
    ?>

    <script>
        function errorMessage() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Email or Password is Wrong!',
                timer: 2000
            })
        }
    </script>

</body>

</html>

<?php

if (isset($_POST['admin_login'])) {

    $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);

    $admin_pass = mysqli_real_escape_string($con, $_POST['admin_pass']);

    $get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";

    $run_admin = mysqli_query($con, $get_admin);

    $count = mysqli_num_rows($run_admin);

    if ($count == 1) {

        $_SESSION['admin_email'] = $admin_email;

        $_SESSION['logged_in'] = 'success';

        header('location: index.php?dashboard');
    } else {

        echo "<script>errorMessage()</script>";
    }
}

?>