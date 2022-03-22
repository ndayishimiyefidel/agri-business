<?php
require_once('../siteadmin/../includes/cnx.php');
//check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}



$user_phone = $_SESSION['phone_number'];
$user_number = $_SESSION['Id']; ?>
<?php

//echo "your user id is" . "" . $user_email;
include('../siteadmin/../includes/urlsheader.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        ../
        <!-- Preloader 
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/img/loading-icon-animated-gif-19.jpg" alt="loading image"
                height="60" width="60">
        </div>-->

        <!-- Navbar -->
        <?php
        include('../siteadmin/../includes/adminnavbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../siteadmin/../includes/adminsidebar.php');

        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Database Setting</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Database Setting</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Database Backup</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                        <div class="row">
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="mb-30">
                                                    <h3 class="text-center txt-dark mb-10">Connect your settings</h3>
                                                    <h6 class="text-center nonecase-font txt-grey">Enter your database
                                                        details below</h6>
                                                </div>
                                                <div class="form-wrap">
                                                    <form action="database_backup.php" method="post" id=""
                                                        class="m-4 p-2">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Host Name</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Server Name EX: Localhost"
                                                                name="server" id="server" required="" autocomplete="on">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Database Username</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Database Username EX: root"
                                                                name="username" id="username" required=""
                                                                autocomplete="on">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left control-label mb-10">Database
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                placeholder="Enter Database Password" name="password"
                                                                id="password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left control-label mb-10">Database
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Database Name" name="dbname"
                                                                id="dbname" required="" autocomplete="on">
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="submit" name="backupnow"
                                                                class="btn btn-primary btn-rounded">Generate
                                                                Backup</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php

        include('../siteadmin/../includes/urlsfooter.php');
        ?>