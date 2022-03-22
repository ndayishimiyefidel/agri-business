<?php
require_once('../salesadmin/../includes/cnx.php');

// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
} else { ?>

<?php
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<script>alert('Your session have been expired,login again')</script>";
        echo  "<script>window.location.href = '../index.php';</script>";
    }
    $user_email = $_SESSION['emailId'];
    $user_id = $_SESSION['userId'];
?>
<?php
    //add product
    if (isset($_POST['add'])) {
        // print_r($_POST);
        // print_r($_FILES);
        $proname = $_POST['prodname'];
        $description = $_POST['description'];
        $qty = $_POST['product_qty'];
        $price = $_POST['price'];
        $ctgry = $_POST['ctgry'];
        $season = $_POST['season'];
        $other_name = $_POST['other-products'];
        $added_date = date('y-m-d', strtotime($_POST['date']));



        //check whether the user activaated or not
        // $id = $_SESSION['id'];
        if (isset($_FILES['imag1'])) {
            $img1 = time() . $_FILES['imag1']['name'];
            $tmp_name = $_FILES['imag1']['tmp_name'];

            $exist = 0;
            // $row_id = 0;

            $sql2 = "select * from products where product_name = '$proname' && pro_category='$ctgry' && id='$user_id'";
            $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            while ($data1 = mysqli_fetch_array($run2)) {
                $exist = 1;
                $row_id = $data1['pr_id'];
                $qty0 = $data1['qty'];
                $disc = $data1['discount'];
                $prices = $data1['unit_price'];
                $pr_name = $data1['product_name'];
                $categor = $data1['pro_category'];
                $season = $data1['season'];
            }
            $status_code = "";

            $qli0 = "select * from users where id='$user_id'";
            $run0 = mysqli_query($connection, $qli0);
            while ($da = mysqli_fetch_array($run0)) {
                $status_code = $da['status_code'];
            }
            if ($exist == 0) {
                if (move_uploaded_file($tmp_name, "../project_images/" . $img1)) {
                    //check whether user type product name not listed

                    if ($proname != "others" and $status_code == 'Activated') {
                        $sql = mysqli_query($connection, "INSERT INTO `products`(`pr_id`,`product_name`,`description`,`pro_category`,`season`,`add_date`,`unit_price`,`qty`,`id`,`imag1`) VALUES(null,'$proname','$description','$ctgry','$season','$added_date','$price','$qty','$user_id','$img1')");
                        if ($sql) {
                            $pr_id = mysqli_insert_id($connection);

                            //save the data in tbl_histroy
                            $dis = 0;
                            $act_happened = 'Added';
                            $date = date('y-m-d');
                            $myhist = "INSERT INTO `tbl_history`(`hist_id`,`id`,`pr_id`,`product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$pr_id','$proname','$ctgry','$season','$price','$qty','$dis','$date','$act_happened')";
                            $runhist = mysqli_query($connection, $myhist);
                            if ($runhist) {
                                echo "<script>alert('New product Added!')</script>";
                                echo "<script>window.location.href='viewproducts.php'</script>";
                            }
                        }
                    } else if ($proname == "others" and $other_name != "" and $status_code == 'Activated') {
                        $sql = mysqli_query($connection, "INSERT INTO `products`(`pr_id`,`product_name`,`description`,`pro_category`,`season`,`add_date`,`unit_price`,`qty`,`id`,`imag1`) VALUES(null,'$other_name','$description','$ctgry','$season','$added_date','$price','$qty','$user_id','$img1')");
                        if ($sql) {
                            $pr_id = mysqli_insert_id($connection);
                            //save the data in tbl_histroy
                            $dis = 0;
                            $act_happened = 'Added';
                            $date = date('y-m-d');
                            $myhist = "INSERT INTO `tbl_history`(`hist_id`,`id`,`pr_id`,`product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$pr_id','$proname','$ctgry','$season','$price','$qty','$dis','$date','$act_happened')";
                            $runhist = mysqli_query($connection, $myhist);
                            if ($runhist) {
                                echo "<script>alert('New product Added!')</script>";
                                echo "<script>window.location.href='viewproducts.php'</script>";
                            }
                        }
                    } else if ($status_code != 'Activated') {
                        echo "<script>alert('You are not activated,please activate your account')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    } else {
                        echo "<script>alert('Please write the name of the product that is not listed')</script>";
                        echo "<script>window.location.href='viewproducts.php'</script>";
                        // echo "Please write other name of the product that you want not listed";
                    }
                } else {
                    echo "<script>alert('error moving file to heroku')</script>" . mysqli_error($connection);
                }
            } else {
                $total = $qty0 + $qty;
                if ($status_code == 'Activated') {
                    $sql3 = "UPDATE products SET qty=$total where pr_id='$row_id' ";
                    $result = mysqli_query($connection, $sql3);
                    $act_happened = 'Updated';
                    $date = date('y-m-d');
                    $myhist = "INSERT INTO `tbl_history`(`hist_id`, `id`,`pr_id`, `product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$row_id','$pr_name','$categor','$season','$prices','$qty','$disc','$date','$act_happened')";
                    $runhist = mysqli_query($connection, $myhist);
                    echo "<script>alert('Product Already exist but Quantity Updated !')</script>";
                    echo "<script>window.location.href='viewproducts.php';</script>";
                } else {
                    echo "<script>alert('You are not activated,please activate your account')</script>";
                    echo "<script>window.location.href='index.php'</script>";
                }
            }
        }
    }
}