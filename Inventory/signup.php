<?php
include('includes/cnx.php');
if (isset($_POST['register'])) {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $pass1 = $_POST['password'];
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
    $role = "administrator";
    $x = 0;
    $y = 0;
    $default_img = 'avatar4.png';
    $joined_date = date('y-m-d');
    if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone)) {
        echo " <script> alert('Invalid Phone number!') </script>";
    } else {
        $pp = mysqli_query($connection, " SELECT * FROM users where role='$role'");
        while ($h = mysqli_fetch_array($pp)) {
            $x = 1;
        }
        if ($x == 1) {
            $app = mysqli_query($connection, " SELECT * FROM users where telphone='$phone'");
            while ($h = mysqli_fetch_array($app)) {
                $y++;
            }

            if ($y == 0) {
                $role = "depositer";
                $status_code = "desactivated";
                $sql = mysqli_query($connection, "INSERT INTO `users`(`id`,`firstname`,`lastname`,`email`,`password`,`telphone`,`gender`,`tin_number`,`province`,`district`,`sector`,`cell`,`village`,`role`,`joined_date`,`profile_pic`,`status`,`status_code`) VALUES(null,'$fname','$lname','$email','$pass','$phone','$sex','$tin','$province','$district','$sector','$cell','$village','$role','$joined_date','$default_img','$status','$status_code')");
                if ($sql) {
                    echo "<script>alert('New user registered')</script>";
                    echo "<script>window.location.href='./index.php</script>";
                }
            } else {
                echo "<script>alert('Phone Number Already exists! ')</script>";
                echo "<script>window.location.href='./signup.php</script>";
            }
        } else {
            $app = mysqli_query($connection, " SELECT * FROM users where telphone='$phone'");
            while ($h = mysqli_fetch_array($app)) {
                $y++;
            }

            if ($y == 0) {
                $sql = mysqli_query($connection, "INSERT INTO `users`(`id`,`firstname`,`lastname`,`email`,`password`,`telphone`,`gender`,`tin_number`,`province`,`district`,`sector`,`cell`,`village`,`role`,`joined_date`,`profile_pic`,`status`) VALUES(null,'$fname','$lname','$email','$pass','$phone','$sex','$tin','$province','$district','$sector','$cell','$village','$role','$joined_date','$default_img','$status')");
                if ($sql) {
                    echo "<script>alert('System Admin registered')</script>";
                    echo "<script>window.location.href='./index.php</script>";
                }
            } else {
                echo "<script>alert('Phone number Already  exists! ')</script>";
                echo "<script>window.location.href='./signup.php</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory MIS | Sign up System</title>

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

<body class="">
    <!-- <div class="hold-transition login-page"> -->
    <div class="signup-box">
        <!-- /.login-logo -->
        <center>
            <div class="card card-outline mt-2 card-primary w-50 ">
                <div class="card-header text-center">
                    <a href="" class="h3"><b>IKUSANYIRIZO</b> MIS</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">
                    <h5>Register to start your session</h5>
                    </p>
                    <hr>
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="first name" name="fname" id="fname"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last name" name="lname" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email is optional" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
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
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Telephone Format 07[2,3,8,9]XXXXXXX"
                                name="phone" required>
                            <div class=" input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone-alt"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Tin number" name="tin">
                            <div class=" input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="radio" name="sex" value="male" style="font-size:18px;margin-left:2cm;">
                            &nbsp;&nbsp;&nbsp;<p style="font-size:18px;margin-top:-0.2cm;"> Male</p>
                            <input type="radio" name="sex" value="Female" style="font-size:18px;margin-left:2cm;">
                            &nbsp;&nbsp;&nbsp;
                            <p style="font-size:18px;margin-top:-0.2cm;"> Female</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select rounded-0" name="province" id="province-dropdown">
                                        <option selected disabled>Province </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select rounded-0" name="district" id="district-dropdown">
                                        <option selected disabled>District</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select rounded-0" name="sector" id="sector-dropdown" value="">
                                        <option selected disabled>Sector </option>
                                    </select>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select rounded-0" name="cell" id="cell-dropdown">
                                        <option selected disabled>Cell</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <select class="custom-select rounded-0" name="village" id="village-dropdown"
                                        value="">
                                        <option selected disabled>Village </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <!-- .col -->
                            <div class="col-12 mt-2">
                                <button type="submit" name="register" class="btn btn-primary btn-md"
                                    style="float:right;">Register now</button>


                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="col-12">
                        <p> Are you already Registered ?
                            <a href="index.php">Login Now</a>
                        </p>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.card-body -->
    </div>

    <!-- /.card -->
    </div>
    </div>
    <!-- /.login-box -->
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
    const url = './dist/js/data.json';
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
    <!-- jQuery -->

    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>