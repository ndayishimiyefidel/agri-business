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
                            <h1 class="m-0">Add New User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Add New User</li>
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
                                    <h3 class="card-title">Add New User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <form action="" method="post">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="first name"
                                                            name="fname" id="fname" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Last name"
                                                            name="lname" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            placeholder="Email is optional" name="email">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-envelope"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="input-group mb-3">
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" name="password" required>
                                                        <div class=" input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            placeholder="Telephone Format 07[2,3,8,9]XXXXXXX"
                                                            name="phone" required>
                                                        <div class=" input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-alt"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="Tin number" name="tin" required>
                                                        <div class=" input-group-append">
                                                            <div class="input-group-text">
                                                                <span class=""></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <input type="radio" name="sex" value="male"
                                                            style="font-size:18px;margin-left:2cm;">
                                                        &nbsp;&nbsp;&nbsp;<p style="font-size:18px;margin-top:-0.2cm;">
                                                            Male</p>
                                                        <input type="radio" name="sex" value="Female"
                                                            style="font-size:18px;margin-left:2cm;">
                                                        &nbsp;&nbsp;&nbsp;
                                                        <p style="font-size:18px;margin-top:-0.2cm;"> Female</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="province"
                                                                    id="province-dropdown">
                                                                    <option selected disabled>Province </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="district"
                                                                    id="district-dropdown">
                                                                    <option selected disabled>District</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="sector"
                                                                    id="sector-dropdown" value="">
                                                                    <option selected disabled>Sector </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="cell"
                                                                    id="cell-dropdown">
                                                                    <option selected disabled>Cell</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="village"
                                                                    id="village-dropdown" value="">
                                                                    <option selected disabled>Village </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select class="custom-select rounded-0" name="user_type"
                                                                    id="cell-dropdown">
                                                                    <option selected disabled>user type----</option>
                                                                    <option value="administrator">Administrator</option>
                                                                    <option value="depositer">depositer</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <!-- .col -->
                                                        <div class="col-12 mt-2">
                                                            <button type="submit" name="register"
                                                                class="btn btn-primary btn-md"
                                                                style="text-align: center;">Register
                                                                now</button>


                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                </form>

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
        if (isset($_POST['register'])) {
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $email = $_POST['email'];
            // $pass1 = $_POST['password'];
            // $pass = MD5($pass1);
            // Generate Random Password
            // $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            // $pass1 = substr(str_shuffle($chars), 0, 8);
            $pass1="12345";
            $pass = MD5($pass1);
            $phone = $_POST['phone'];
            $tin = $_POST['tin'];
            $sex = $_POST['sex'];
            $province = $_POST['province'];
            $district = $_POST['district'];
            $sector = $_POST['sector'];
            $cell = $_POST['cell'];
            $village = $_POST['village'];
            $status = 1;
            $role = $_POST['user_type'];
            $y = 0;
            $default_img = 'avatar4.png';
            $joined_date = date('y-m-d');
            if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone)) {
                echo " <script> alert('Invalid Phone number!') </script>";
            } else {

                $app = mysqli_query($connection, " SELECT * FROM users where telphone='$phone'");
                while ($h = mysqli_fetch_array($app)) {
                    $y++;
                }

                if ($y == 0) {
                    $sql = mysqli_query($connection, "INSERT INTO `users`(`id`,`firstname`,`lastname`,`email`,`password`,`telphone`,`gender`,`tin_number`,`province`,`district`,`sector`,`cell`,`village`,`role`,`joined_date`,`profile_pic`,`status`) VALUES(null,'$fname','$lname','$email','$pass','$phone','$sex','$tin','$province','$district','$sector','$cell','$village','$role','$joined_date','$default_img','$status')");
                    if ($sql) {
                        echo "<script>alert('New user registered')</script>";
                        echo "<script>window.location.href='./allusers.php';</script>";
                    }
                } else {
                    echo "<script>alert('Phone Number Already exists! ')</script>";
                    echo "<script>window.location.href='./addnewuser.php';</script>";
                }
            }
        }
        ?>
        <script language="javascript" type="text/javascript">
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4; // for 25% - devide by 4  |  for 33% - devide by 3
            var targetWin = window.open(pageURL, title,
                'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
                w + ', height=' + h + ', top=' + top + ', left=' + left);
        }


        let provinceSelector = document.querySelector('#province-dropdown');
        let districtSelector = document.querySelector('#district-dropdown');
        let sectorSelector = document.querySelector('#sector-dropdown');
        let cellSelector = document.querySelector('#cell-dropdown');
        let villageSelector = document.querySelector('#village-dropdown');

        // fetch data
        const url = '../dist/js/data.json';
        fetch(url)
            .then((response) => {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' + response.status);
                    return;
                }
                response.json().then((data) => {
                    let option;
                    let provinceKeys = Object.keys(data);
                    for (let i = 0; i < provinceKeys.length; i++) {
                        option = document.createElement('option');
                        option.text = provinceKeys[i];
                        option.value = provinceKeys[i];
                        provinceSelector.add(option);
                    }
                    provinceSelector.addEventListener('change', (e) => allDistricts(data[e.target.value]));
                });
            })
            .catch((err) => {
                console.error('Fetch Error -', err);
            });

        const allDistricts = (data) => {
            let districtKeys = Object.keys(data);
            districtSelector.innerHTML = '';
            for (let i = 0; i < districtKeys.length; i++) {
                option = document.createElement('option');
                option.text = districtKeys[i];
                option.value = districtKeys[i];
                districtSelector.add(option);
            }
            districtSelector.addEventListener('change', (e) => allSectors(data[e.target.value]));
        };

        const allSectors = (data) => {
            let sectorKeys = Object.keys(data);
            sectorSelector.innerHTML = '';
            for (let i = 0; i < sectorKeys.length; i++) {
                option = document.createElement('option');
                option.text = sectorKeys[i];
                option.value = sectorKeys[i];
                sectorSelector.add(option);
            }
            sectorSelector.addEventListener('change', (e) => allCells(data[e.target.value]));
        };

        const allCells = (data) => {
            let cellKeys = Object.keys(data);
            cellSelector.innerHTML = '';
            for (let i = 0; i < cellKeys.length; i++) {
                option = document.createElement('option');
                option.text = cellKeys[i];
                option.value = cellKeys[i];
                cellSelector.add(option);
            }
            cellSelector.addEventListener('change', (e) => allVillages(data[e.target.value]));
        };

        const allVillages = (data) => {
            villageSelector.innerHTML = '';
            for (let i = 0; i < data.length; i++) {
                option = document.createElement('option');
                option.text = data[i];
                option.value = data[i];
                villageSelector.add(option);
            }
        };
        </script>
        <?php

        include('../siteadmin/../includes/urlsfooter.php');
        ?>