<?php
require_once('../sitedmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script> alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
}
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$user_id = $_SESSION['Id'];
$date = date('y-m-d');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // $sql2 = "select * from products where pr_id='$id' && id='$user_id'";
    // $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
    // while ($data1 = mysqli_fetch_array($run2)) {
    //     $exist = 1;
    //     $row_id = $data1['pr_id'];
    //     $qty = $data1['qty'];
    //     $disc = $data1['discount'];
    //     $price = $data1['unit_price'];
    //     $pr_name = $data1['product_name'];
    //     $categor = $data1['pro_category'];
    //     $season = $data1['season'];
    // }
    // $act_happened = 'Deleted';
    // $myhist = "INSERT INTO `tbl_history`(`hist_id`, `id`, `product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES (null,'$user_id','$pr_name','$categor','$season','$price','$qty','$disc','$date','$act_happened')";
    // $runhist = mysqli_query($connection, $myhist);

    $query = "DELETE FROM users WHERE id =$id";
    $runq = mysqli_query($connection, $query);
    if ($runq) {
        echo "<script>alert('user deleted successfully !')</script>";
        echo "<script>window.location.href='allusers.php';</script>";
    }
}