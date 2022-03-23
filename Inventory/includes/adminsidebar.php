<?php
// php code for dispay home information
$query = "select * from users where telphone='$user_phone' and role='administrator'";
$run = mysqli_query($connection, $query);
while ($user_data = mysqli_fetch_array($run)) {
    $oldpass = $user_data['password'];
    //print_r($user_data);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar primary elevation-6" style="background:#FFFFFF;">
    <!-- Brand Logo -->
    <a href="../siteadmin/index.php" class="brand-link">

        <span class="text-dark font-weight-dark">
            <?= $user_data['role'] ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../project_images/<?= $user_data['profile_pic'] ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="text-dark">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $user_data['firstname'] ?>&nbsp;&nbsp;<?= $user_data['lastname'] ?></a>
            </div>

        </div>

        <!-- SidebarSearch Form -->
        <div class=" form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php $uri = $_SERVER['REQUEST_URI'];
                    $uriAr = explode("/", $uri);
                    $page = end($uriAr);

                    ?>
                <li class="nav-item menu-open">
                    <a href="index.php"
                        class="nav-link <?php echo ($page == '' || $page == 'index.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="viewcustomers.php" class="nav-link">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Customers
                        </p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="allsales.php" class="nav-link <?php echo ($page == 'allsales.php') ? 'active' : ''; ?>">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Sales Products
                        </p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="allsales.php"
                                class="nav-link <?php echo ($page == 'allsales.php') ? 'active' : ''; ?>">

                                <p>Sales</p>
                                <i class="fa fa-list right" aria-hidden="true"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="logs.php" class="nav-link <?php echo ($page == 'logs.php') ? 'active' : ''; ?>">

                                <p>Logs</p>

                                <i class="fa fa-history right" aria-hidden="true"></i>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="productlist.php"
                        class="nav-link <?php echo ($page == 'productlist.php') ? 'active' : ''; ?>">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Purchase products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-users"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Users
                        </p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="addnewuser.php"
                                class="nav-link  <?php echo ($page == 'addnewuser.php') ? 'active' : ''; ?>">

                                <p>Add User</p>
                                <i class="fa fa-users right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="allusers.php"
                                class="nav-link <?php echo ($page == 'allusers.php') ? 'active' : ''; ?>">

                                <p>User List</p>

                                <i class="nav-icon fas fa-list right"></i>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="reports.php" class="nav-link <?php echo ($page == 'reports.php') ? 'active' : ''; ?>">
                        <i class="fa fa-flag" aria-hidden="true"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Reports
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="editprofiledetail.php"
                        class="nav-link <?php echo ($page == 'editprofiledetail.php') ? 'active' : ''; ?>">
                        <i class="fas fa-user-cog"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            Setting

                        </p> <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="editprofiledetail.php"
                                class="nav-link <?php echo ($page == 'editprofiledetail.php') ? 'active' : ''; ?>">

                                <p>Edit Profile</p>
                                <i class="fas fa-user-edit right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#modal-default" class="nav-link" data-toggle="modal" data-target="#modal-default">

                                <p>Change password</p>
                                <i class="nav-icon ion-edit right"></i>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="logout.php"
                                class="nav-link <?php echo ($page == 'logout.php') ? 'active' : ''; ?>">

                                <p>Log out</p>
                                <i class="nav-icon ion-log-out right"></i>

                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="dbackup.php" class="nav-link <?php echo ($page == 'dbackup.php') ? 'active' : ''; ?>">
                        <i class="fa fa-database" aria-hidden="true"></i>
                        &nbsp;&nbsp;&nbsp;<p>
                            DB Backup
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
<div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit/Change password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="quickForm" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Old Password</label>
                        <input type="password" name="oldpassword" class="form-control" placeholder="old Password">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" name="newpassword" class="form-control" placeholder="New Password">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="changep" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php }
if (isset($_POST['changep'])) {
    $old = $_POST['oldpassword'];
    $new = $_POST['newpassword'];
    $newpass = MD5($new);
    if (MD5($old) == $oldpass) {
        $chpwd = "UPDATE `users`
    SET `password` = '$newpass'
    WHERE telphone='$user_phone' and role='administrator'";
        $run = mysqli_query($connection, $chpwd);
        echo " <script>alert('Your Password Changed successfully')</script>";
    } else {
        echo " <script>alert('Old Password is invalid, please try again!')</script>";
    ?>
<script>
$('#modal-default').modal('show');
</script>";
<?php
    }
}


?>