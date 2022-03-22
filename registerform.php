<?php
include("include/header2.php");
?><?php
    if (isset($_POST['signin'])) {
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $pass1 = $_POST['newpassword'];
        $pass2 = $_POST['repeatpassword'];
        $pass = MD5($pass1);
        $phone = $_POST['telephone'];
        $date = $_POST['date'];
        $sex = $_POST['gender'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $sector = $_POST['sector'];
        $cell = $_POST['cell'];
        $village = $_POST['village'];
        $status = 1;
        if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone)) {
            echo " <script> alert('Invalid Phone  or TIN number') </script>";
        } else {

            $sql = mysqli_query($connection, "INSERT INTO `customers`(`customer_id`,`firstname`,`lastname`,`email`,`password`,`telphone`,`gender`,`dob`,`province`,`district`,`sector`,`cell`,`village`,`status`) VALUES(null,'$fname','$lname','$email','$pass','$phone','$sex','$date','$province','$district','$sector','$cell','$village','$status')");
            if ($sql) {
                echo "<script>alert('Account created successfully, just sign in ')</script>";
                echo "<script>window.location.href='./loginform.php'</script>";
            }
        }
    }
    ?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">User sign up</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="loginform.php">Sign in</a>
                    </li>
                    <li class="active">Registration form</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<div class="row">
    <div class="col-md-8" style="  float: none;
     margin-left: auto;
     margin-right: auto;">
        <div class="modal-header">
            <h4 class="modal-title text-center text-info" id="exampleModalToggleLabel">Fill Personal Information</h4>
        </div>
        <form method="post" action="#">
            <div class="modal-body">
                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="fname" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Enter first name..." required>
                </div>
                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">Last Name </label>
                    <input type="text" name="lname" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Enter last name...">
                </div>
                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Enter valide email..." required>

                </div>
                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" name="telephone" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Enter Telephone...">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Select Gender</label><br>
                    <input type="radio" name="gender" class="">
                    &nbsp;&nbsp;<b>Male</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" class="float-end">&nbsp;&nbsp;<b>Female</b>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Choose DOB</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Select Province</label>
                    <select name="province" class="form-control custom-select" id="province">
                        <option selected="" disabled="">Choose province...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Select District</label>
                    <select name="district" class="form-control custom-select" id="district">
                        <option selected="" disabled="">Choose district...</option>

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Select Sector </label>
                    <select name="sector" class="form-control custom-select" id="sector">
                        <option selected="" disabled="">Choose sector...</option>

                    </select>
                </div>
                <div class=" form-group col-md-4">
                    <label for="exampleInputEmail1">Select Cell </label>
                    <select name="cell" class="form-control custom-select" id="cell">
                        <option selected="" disabled="">Choose cell...</option>

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Select Village </label>
                    <select name="village" class="form-control custom-select" id="village">
                        <option selected="" disabled="">Choose village...</option>

                    </select>
                </div>


                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">New password</label>
                    <input type="password" name="newpassword" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Enter new password...">
                </div>

                <div class=" form-group col-md-6">
                    <label for="exampleInputEmail1">Repeat Password</label>
                    <input type="password" name="repeatpassword" value="" class=" form-control" id="exampleInputEmail1"
                        placeholder="Repeat password...">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <br>Are you registerd ?<a href="loginform.php" class="text-primary ">Login
                    </a>&nbsp;&nbsp;<button type="submit" name="signin" class="btn btn-primary"
                        style="float:right">Register
                        now
                    </button>&nbsp;&nbsp;&nbsp;<a href="#" class="text-danger">Are you
                        forget
                        password
                        ?
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">

    </div>
</div>
<?php
// include("include/footerlinks.php");
?><?php
    include("include/footer.php");
    ?>