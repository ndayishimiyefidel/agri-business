<?php
// php code for dispay home information
$query = "select * from users where telphone='$user_phone' and role='administrator'";
$run = mysqli_query($connection, $query);
while ($user_data = mysqli_fetch_array($run)) {

    //print_r($user_data);
?>
<!--navbar-->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="../project_images/<?= $user_data['profile_pic'] ?>" class="user-image img-circle elevation-2"
                    alt="User Image">
                <span class="d-none d-md-inline">
                    <?= $user_data['firstname'] ?> <?= $user_data['lastname'] ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="../project_images/<?= $user_data['profile_pic'] ?>" class="img-circle elevation-2"
                        alt="User Image">

                    <p>
                        <?= $user_data['firstname'] ?> <?= $user_data['lastname'] ?> - <?= $user_data['role'] ?>
                        <small>Member Joined Since &nbsp; <?php $original_date = $user_data['joined_date'];
                                                                // Creating timestamp from given date
                                                                $timestamp = strtotime($original_date);
                                                                // Creating new date format from that timestamp
                                                                $new_date = date("d-M-Y", $timestamp);
                                                                echo $new_date; ?></small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <!-- <div class="row">

                        <div class="col-4 text-center">
                            <a href="#">Orders</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Customers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Pending Orders</a>
                        </div>
                    </div> -->
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="editprofile.php" class="btn btn-default btn-flat">Profile</a>
                    <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
            </li>-->
    </ul>
</nav><?php
        } ?>