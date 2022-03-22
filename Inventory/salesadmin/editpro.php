<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
} ?>
<?php
$user_id = $_SESSION['userId'];
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}

$date = date('y-m-d');
if (isset($_POST['updatedata']) != null) {
    $id = $_POST['update_id'];
    // print_r($_FILES);
    $proname = $_POST['pro_name'];
    $category = $_POST['category'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $discount = $_POST['dis'];
    if (isset($_FILES['img'])) {
        $img = time() . $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $errors = $_FILES['img']['error'];
        if ($errors != 4) { //check if error not equal to 4
            if (move_uploaded_file($tmp_name, "../project_images/" . $img)) {

                $sql2 = "select * from products where pr_id='$id' && id='$user_id'";
                $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                while ($data1 = mysqli_fetch_array($run2)) {
                    $exist = 1;
                    $row_id = $data1['pr_id'];
                    $qty0 = $data1['qty'];
                    $season = $data1['season'];
                }
                $total = $qty0 + $qty;
                $query = "UPDATE products SET product_name='$proname', pro_category='$category', qty='$total', unit_price='$price', discount='$discount',imag1='$img' WHERE pr_id='$id' ";
                $query_run = mysqli_query($connection, $query);
                if (!$query_run) {
                    echo "no" . mysqli_error($connection);
                } else {
                    $act_happened = 'Updated';
                    $myhist = "INSERT INTO `tbl_history`(`hist_id`, `id`,`pr_id`, `product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$row_id','$proname','$category','$season','$price','$qty','$discount','$date','$act_happened')";
                    $runhist = mysqli_query($connection, $myhist);
                    echo "<script>alert('product product Information!')</script>" . " " . $id;
                    echo "<script>window.location.href='viewproducts.php'</script>";
                }
            } else {
                // echo "<script>alert('errors')</script>" . mysqli_error($connection);
                echo "eroor" . mysqli_error($connection);
            }
        } else {
            //make sure error 
            $sql2 = "select * from products where pr_id='$id' && id='$user_id'";
            $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            while ($data1 = mysqli_fetch_array($run2)) {
                $exist = 1;
                $row_id = $data1['pr_id'];
                $qty0 = $data1['qty'];
                $season = $data1['season'];
            }
            $total = $qty0 + $qty;
            $query = "UPDATE products SET product_name='$proname', pro_category='$category', qty='$total', unit_price='$price', discount='$discount' WHERE pr_id='$id' ";
            $query_run = mysqli_query($connection, $query);
            if (!$query_run) {
                echo "no" . mysqli_error($connection);
            } else {
                $act_happened = 'Updated';
                $myhist = "INSERT INTO `tbl_history`(`hist_id`, `id`,`pr_id`, `product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$row_id','$proname','$category','$season','$price','$qty','$discount','$date','$act_happened')";
                $runhist = mysqli_query($connection, $myhist);
                echo "<script>alert('product product Information!')</script>" . " " . $id;
                echo "<script>window.location.href='viewproducts.php'</script>";
            }
        }
    }
}
?>