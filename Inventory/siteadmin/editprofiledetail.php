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

//echo "your user id is" . "" . $user_phone;
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
            $query = "select * from users where telphone='$user_phone'";
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
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="../project_images/<?= $user_data['profile_pic'] ?>"
                                            alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?= $user_data['firstname'] ?>
                                        <?= $user_data['lastname'] ?></h3>

                                    <p class="text-muted text-center"><?= $user_data['role'] ?></p>

                                    <form method="post" action="#" enctype="multipart/form-data">
                                        <input type="file" class="form-control mb-4" value="Change" name="profile"
                                            required>
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
                                                    $as = "UPDATE `users` SET `profile_pic`='$profile' where id='$user_number'";
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

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link  active" href="#activity"
                                                data-toggle="tab">Activity</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">Security</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings"
                                                data-toggle="tab">Settings</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane " id="activity">

                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane active" id="timeline">

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
                                                id='$user_number'
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
                                                        <input type="text" value="<?= $user_data['firstname'] ?>"
                                                            name="fname" class="form-control" id="inputName"
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-4 col-form-label">Last
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="<?= $user_data['lastname'] ?>"
                                                            name="lname" class="form-control" id="inputName"
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                        class="col-sm-4 col-form-label">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="inputEmail"
                                                            name="email" placeholder="Email"
                                                            value="<?= $user_data['email'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-4 col-form-label">Telephpne
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="inputName2"
                                                            name="phone" placeholder="telphone..."
                                                            value="<?= $user_data['telphone'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-4 col-form-label">TIN
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="inputName2"
                                                            name="tin" placeholder="tin number..."
                                                            value="<?= $user_data['tin_number'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputName2"
                                                        class="col-sm-4 col-form-label">Province</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            name="province" placeholder="province..."
                                                            value="<?= $user_data['province'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2"
                                                        class="col-sm-4 col-form-label">District</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            name="district" placeholder="district..."
                                                            value="<?= $user_data['district'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2"
                                                        class="col-sm-4 col-form-label">Sector</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            name="sector" placeholder="sector..."
                                                            value="<?= $user_data['sector'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-4 col-form-label">Cell</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            name="cell" placeholder="cell..."
                                                            value="<?= $user_data['cell'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2"
                                                        class="col-sm-4 col-form-label">Village</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            name="village" placeholder="village..."
                                                            value="<?= $user_data['village'] ?>">
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
                                                        <button type="submit" class="btn btn-primary"
                                                            name="updateinfo">Update</button>
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
        <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js">
        </script>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js">
        </script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js">
        </script> -->
        <?php

        include('../salesadmin/../includes/urlsfooter.php');
        ?>