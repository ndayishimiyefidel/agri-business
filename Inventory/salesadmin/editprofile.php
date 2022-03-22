<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>
alert('Plz , Login first !')
</script>";
    echo "<script>
window.location.href = '../index.php';
</script>";
} ?><?php
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<script>alert('Your session have been expired,login again')</script>";
        echo  "<script>window.location.href = '../index.php';</script>";
    }
    $user_email = $_SESSION['emailId'];
    $user_id = $_SESSION['userId'];
    include('../salesadmin/../includes/urlsheader.php');
    ?>
<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editaccmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Account Informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="editaccounts.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <input type="hidden" name="update_id" id="update_id">

                    <div class="form-group">
                        <label> Account Name</label>
                        <input type="text" name="acc_name" id="acc-name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label> Account Number </label>
                        <input type="text" name="acc_number" id="acc_number" class="form-control" />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateacc" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/img/loading-icon-animated-gif-19.jpg" alt="loading image"
                height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <?php
        include('../salesadmin/../includes/navbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../salesadmin/../includes/mainsidebar.php');
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 2646.44px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>My Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            $query = "select * from users where telphone='$user_email'";
            $run = mysqli_query($connection, $query);
            while ($user_data = mysqli_fetch_array($run)) { ?>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../project_images/<?= $user_data['profile_pic'] ?>" alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center"><?= $user_data['firstname'] ?>
                                            <?= $user_data['lastname'] ?></h3>

                                        <p class="text-muted text-center"><?= $user_data['role'] ?></p>

                                        <form method="post" action="#" enctype="multipart/form-data">
                                            <input type="file" class="form-control mb-4" value="Change" name="profile" required>
                                            <button type="submit" name="upload" class="btn btn-primary col start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start upload</span>
                                            </button>
                                        </form>
                                        <?php if (isset($_POST['upload'])) {
                                            if (isset($_FILES['profile'])) {
                                                $profile = time() . $_FILES['profile']['name'];
                                                $tmp_name = $_FILES['profile']['tmp_name'];
                                                if (move_uploaded_file($tmp_name, "../project_images/" . $profile)) {
                                                    $as = "UPDATE `users` SET `profile_pic`='$profile' where id='$user_id'";
                                                    $runas = mysqli_query($connection, $as);
                                                    echo "<script>alert('profile picture updated')</script>";
                                                    header('location:editprofile.php');
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                        <p class="text-muted">
                                            <?= $user_data['district'] ?>,<?= $user_data['sector'] ?>
                                        </p>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <?php
                            if (isset($_POST['saves'])) {
                                $acc_name = $_POST['acc_name'];
                                $acc_number = $_POST['acc_number'];
                                $sql = "SELECT * FROM `accounts` WHERE id='$user_id' and acc_name='$acc_name'";
                                $runsql = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($runsql) > 0) {
                                    $up = "UPDATE `accounts` SET `acc_name`='$acc_name',`acc_number`='$acc_number' WHERE id='$user_id' and acc_name='$acc_name'";
                                    $runup = mysqli_query($connection, $up);
                                    echo "<script>alert('Payment detail updated!')</script>";
                                    header('location:editprofile.php');
                                } else {
                                    $ins = "INSERT INTO `accounts`(`acc_id`, `id`, `acc_name`, `acc_number`) VALUES (null,'$user_id','$acc_name','$acc_number')";
                                    $run1 = mysqli_query($connection, $ins);
                                    echo "<script>alert('New Payment detail added!')</script>";
                                    header('location:editprofile.php');
                                }
                            }
                            ?>
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Activity</a></li>
                                            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Payment
                                                    details</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane " id="activity">

                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane active" id="timeline">
                                                <form class="form-horizontal" action="" method="post">

                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Account
                                                            Name</label>
                                                        <div class="col-sm-8">
                                                            <select class="custom-select rounded-0" name="acc_name">
                                                                <option>Select Account name--- </option>
                                                                <option value="Mobile Money">Mobile Money
                                                                </option>
                                                                <option value="Airtel Money">Airtel Money
                                                                </option>
                                                                <option value="Bank of Kigali">Bank of Kigali
                                                                </option>
                                                                <option value="Equity Bank">Equity Bank</option>
                                                                <option value="BPR">BPR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Account
                                                            Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" name="acc_number" class="form-control" id="inputName" value="" placeholder="account number...">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-4 col-sm-8">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" required>&nbsp;<span class="text-danger">Make
                                                                        sure to
                                                                        write payment number correctly.</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-4 col-sm-8">
                                                            <button type="submit" class="btn btn-primary" name="saves">Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class=" card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">List Payment Accounts</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0">
                                                        <table class="table table-striped table-responsive table-centered m-2 p-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style=" width: 10px">#</th>
                                                                    <th>Account Name</th>
                                                                    <th>Account Number</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $x = 0;
                                                                $sql0 = "SELECT * FROM `accounts` WHERE id='$user_id' ORDER BY acc_name ASC";
                                                                $runsql0 = mysqli_query($connection, $sql0);
                                                                if (mysqli_num_rows($runsql0) > 0) {
                                                                    while ($da = mysqli_fetch_array($runsql0)) {
                                                                        $x++; ?> <tr>
                                                                            <td>
                                                                                <?= $da['acc_id'] ?>.
                                                                            </td>
                                                                            <td><?= $da['acc_name'] ?></td>
                                                                            <td>
                                                                                <?= $da['acc_number'] ?>
                                                                            </td>
                                                                            <td>
                                                                                <button class=" btn btn-info btn-sm editbtnacc">
                                                                                    <i class="fas fa-pencil-alt">
                                                                                    </i>
                                                                                </button>

                                                                                <a class="btn btn-danger btn-sm" href="delaccounts.php?id=<?= $da['acc_id'] ?>" id=" <?= $da['acc_id'] ?>">
                                                                                    <i class="fas fa-trash">
                                                                                    </i>

                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='3' class='text-danger'>No payments detail Added</td></tr>";
                                                                } ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <?php
                                            if (isset($_POST['updateinfo'])) {
                                                // print_r($_POST);
                                                $lname = $_POST['lname'];
                                                $fname = $_POST['fname'];
                                                $email = $_POST['email'];
                                                $phone = $_POST['phone'];
                                                $tin = $_POST['tin'];
                                                $province = $_POST['province'];
                                                $district = $_POST['district'];
                                                $sector = $_POST['sector'];
                                                $cell = $_POST['cell'];
                                                $village = $_POST['village'];
                                                //make sure that the phone number is avalide
                                                if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone)) {
                                                    echo " <script> alert('Invalid Phone number!') </script>";
                                                } else {
                                                    $sqlup =
                                                        "UPDATE
                                                `users`
                                            SET
                                                `firstname` = '$fname',
                                                `lastname` = '$lname',
                                                `email` = '$email',                                             
                                                `telphone` = '$phone',
                                                `tin_number` = '$tin',
                                                `province` = '$province',
                                                `district` = '$district',
                                                `sector` = '$sector',
                                                `cell` = '$cell',
                                                `village` = '$village'
                                            WHERE
                                                id='$user_id'
                                                ";
                                                    $runsqlup = mysqli_query($connection, $sqlup);
                                                    echo "<script>alert('User Information Updated!')</script>";
                                                    echo "<script>window.location.href='./editprofile.php</script>";
                                                }
                                            }
                                            ?>
                                            <div class="tab-pane" id="settings">
                                                <form class="form-horizontal" method="post">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">First
                                                            Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" value="<?= $user_data['firstname'] ?>" name="fname" class="form-control" id="inputName" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Last
                                                            Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" value="<?= $user_data['lastname'] ?>" name="lname" class="form-control" id="inputName" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                                                        <div class="col-sm-8">
                                                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= $user_data['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">Telephpne
                                                            Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" id="inputName2" name="phone" placeholder="telphone..." value="<?= $user_data['telphone'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">TIN
                                                            Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" id="inputName2" name="tin" placeholder="tin number..." value="<?= $user_data['tin_number'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">Province</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName2" name="province" placeholder="province..." value="<?= $user_data['province'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">District</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName2" name="district" placeholder="district..." value="<?= $user_data['district'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">Sector</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName2" name="sector" placeholder="sector..." value="<?= $user_data['sector'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">Cell</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName2" name="cell" placeholder="cell..." value="<?= $user_data['cell'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-4 col-form-label">Village</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName2" name="village" placeholder="village..." value="<?= $user_data['village'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="offset-sm-4 col-sm-8">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" required> I agree to
                                                                    the <a href="#">terms
                                                                        and conditions</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-4 col-sm-8">
                                                            <button type="submit" class="btn btn-primary" name="updateinfo">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            <?php } ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- ############################################################ -->
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js">
        </script>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js">
        </script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js">
        </script>
        <?php

        include('../salesadmin/../includes/urlsfooter.php');
        ?>

        <script>
            $(document).ready(function() {

                $('.editbtnacc').on('click', function() {

                    $('#editaccmodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(
                        function() {
                            return $(this).text();
                        }).get();

                    console.log(data);


                    $('#update_id').val(data[0]);
                    $('#acc-name').val(data[1]);
                    $('#acc_number').val(data[2]);

                });
            });
        </script>