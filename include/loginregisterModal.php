<?php if (isset($_POST['signin1'])) {
    //print_r($_POST);
    $email = $_POST["email"];
    $password =  $_POST["password"];
    $password = md5($password);
    $x = 0;
    $cust_id = 0;
    $sql = "select * from customers where email = '$email' && password = '$password' && status=1";
    $run = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    while ($data = mysqli_fetch_array($run)) {
        $cust_id = $data['customer_id'];
        $fname = $data['firstname'];
        $lname = $data['lastname'];
        $tel = $data['telphone'];
        $x++;
    }
    if ($x == 1) {
        //if user login successfully , then set session
        $_SESSION['isCustomerLoggedIn'] = true;
        $_SESSION['emailId'] = $email;
        $_SESSION['custId'] = $cust_id;
        $_SESSION['isFname'] = $fname;
        $_SESSION['isLname'] = $lname;
        $_SESSION['isPhone'] = $tel;
        echo "<script> window.location.href = './index.php';</script>";
    } else {
        echo " <script>alert('Try again Incorrect login credintial')</script>";
    }
}
?>

<!-- Modal login and register-->
<div class="modal fade" id="bookticket" data-backdrop="static" data-keyboard="false" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalToggleLabel">Customer Sign In Information</h4>

            </div>
            <form method="post" action="#">
                <div class="modal-body">
                    <div class="card-body">

                        <div class=" form-group col-12">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="email" name="email" value="" class=" form-control" id="exampleInputEmail1"
                                placeholder="Enter username or email..." required>

                        </div>
                        <div class=" form-group col-12">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" value="" class=" form-control"
                                id="exampleInputEmail1" placeholder="Enter password...">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            style="float:right">Close</button>
                        &nbsp;&nbsp;<button type="submit" name="signin1" class="btn btn-primary">Sign
                            In
                        </button>&nbsp;&nbsp;&nbsp;<a href="#" style="margin-left:1cm;">Are you forget password ?
                        </a>
                    </div>
                </div>

            </form>
            <div class="modal-footer">

                <button class="btn btn-primary" data-target="#exampleModalToggle2" data-toggle="modal"
                    data-dismiss="modal" style="float:right">Register Now</button>
            </div>
        </div>
    </div>
</div>
<?php
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
    $joined = date('y-m-d');
    $status = 1;
    $sql = mysqli_query($connection, "INSERT INTO `customers`(`customer_id`,`firstname`,`lastname`,`email`,`password`,`telphone`,`gender`,`dob`,`province`,`district`,`sector`,`cell`,`village`,`joined_date`,`status`) VALUES(null,'$fname','$lname','$email','$pass','$phone','$sex','$date','$province','$district','$sector','$cell','$village','$joined','$status')");
    if ($sql) {
        //echo "err" . mysqli_error($connection);
        echo "<script>alert('Thank you for registering to our system')</script>";
        echo "<script>window.location.href='./index.php';</script>";
    } else {
        echo "failed" . mysqli_error($connection);
    }
}
?>
<div class="modal fade" id="exampleModalToggle2" data-backdrop="static" data-keyboard="false" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalToggleLabel">Customer Personal Information</h4>
            </div>
            <form method="post" action="#">
                <div class="modal-body" style="max-height: calc(100vh - 250px);
    overflow-y: auto;">
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
                        <input type="password" name="repeatpassword" value="" class=" form-control"
                            id="exampleInputEmail1" placeholder="Repeat password...">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            style="float:right">Close</button>
                        &nbsp;&nbsp;<button type="submit" name="signin" class="btn btn-primary">Register now
                        </button>&nbsp;&nbsp;&nbsp;<a href="#" style="margin-left:1cm;color:aqua;">Are you
                            forget
                            password
                            ?
                        </a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-target="#bookticket" data-toggle="modal"
                        data-dismiss="modal">Back
                        to sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--/end modal-->