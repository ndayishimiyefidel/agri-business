<?php
require_once('includes/cnx.php');
if (isset($_POST['login'])) {
    //print_r($_POST);
    $phone_number = mysqli_real_escape_string($connection, $_POST["phone_number"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $password = md5($password);
    if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone_number)) {

        echo " <script> alert('Invalid Phone  or TIN number') </script>";
    } else {
        $x = 0;
        $user_id = 0;
        $user_role = "";
        $sql = "select * from users where telphone = '$phone_number' && password = '$password'";
        $run = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        while ($data = mysqli_fetch_array($run)) {
            $user_id = $data['id'];
            $user_role = $data['role'];
            $status = $data['status'];

            $x++;
        }
        // echo "" . $user_id;
        if ($x == 1 && $user_role == 'depositer' && $status == 1) {
            //if user login successfully , then set session
            $_SESSION['isUserLoggedIn'] = true;
            $_SESSION['emailId'] = $phone_number;
            $_SESSION['userId'] = $user_id;
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 2 hour from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (2 * 60 * 60);
            echo "<script>window.location.href='./salesadmin/index.php';</script>";
        } elseif ($x == 1 && $user_role == 'administrator' && $status == 1) {
            //if user admin login successfully , then set session
            $_SESSION['isUserLoggedIn'] = true;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['Id'] = $user_id;
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 2 hour from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (2 * 60 * 60);
            echo "<script>window.location.href='./siteadmin/index.php';</script>";
        } else if ($status == 0) {
            echo "<script> alert('You are not activated, Contact admininstrator for help.Thank You ') </script>";
        } else {
            echo "<script> alert('Try again Incorrect login credintial Or You are not activated') </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory MIS | Login System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h3"><b>IKUSANYIRIZO</b> MIS</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="07[2,3,8,9]XXXXXXX or TIN Number"
                            name="phone_number" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class=" input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-2">
                    <a href="forgot-password.php">I forgot my password</a>
                </p>
                <p class="mb-2">
                    Don't you have account? <a href="signup.php">Register Now</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>