<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
}
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$user_id = $_SESSION['userId'];
if (isset($_GET['id']) != null) {
    $order_id = $_GET['id'];
    $sel1 = "SELECT * FROM `orders` WHERE id='$user_id' and order_id='$order_id'";
    $runsel1 = mysqli_query($connection, $sel1);
    while ($result = mysqli_fetch_array($runsel1)) {
        $pr_id = $result['pr_id'];
        $status = $result['status'];
    }
    if ($status == 'Received') {
        echo "<script>alert('The customer order has been already $status or Confirmed')</script>";
        echo "<script>window.location.href = 'pendingorders.php';</script>";
    } elseif ($status == 'Expired') {
        echo "<script>alert('The customer order has been already $status or you cannot confirmed it again')</script>";
        echo "<script>window.location.href = 'pendingorders.php';</script>";
    } elseif ($status == 'Cancelled') {
        $sel = "SELECT * FROM `orders` WHERE id='$user_id' and order_id='$order_id'";
        $runsel = mysqli_query($connection, $sel);
        while ($result = mysqli_fetch_array($runsel)) {
            $pr_id = $result['pr_id'];
            $qty = $result['qty'];
            $pro_cat = $result['pro_category'];
            $unit_price = $result['unit_price'];
        }
        $sel0 = "SELECT * FROM `products` WHERE pr_id='$pr_id' and id='$user_id'";
        $runsel0 = mysqli_query($connection, $sel0);
        while ($result0 = mysqli_fetch_array($runsel0)) {
            $pr_id = $result0['pr_id'];
            $qty0 = $result0['qty'];
            $pr_name = $result0['product_name'];
        }
        $totqty = $qty0 - $qty;
        $qrt = "UPDATE `products` SET `qty` = '$totqty' WHERE pr_id='$pr_id' and id='$user_id'";
        $runqrt = mysqli_query($connection, $qrt);
        $date = date('y-m-d');
        if ($runqrt) {
            $ins = "INSERT INTO `tbl_history`
                        (
                        `hist_id`,
                        `id`,
                        `pr_id`,
                        `product_name`,
                        `pro_category`,
                        `season`,
                        `unit_price`,
                        `qty`,
                        `discount`,
                        `action_date`,
                        `action_happened`
                    )
                    VALUES(
                        null,
                        '$user_id',
                        '$pr_id',
                        '$pr_name',
                        '$pro_cat',
                        '$ss',
                        '$unit_price',
                        '$qty',
                        0,
                        '$date',
                        'Uncancelled'
                    ) ";
            $rr = mysqli_query($connection, $ins);
            //update orders
            $qr = "UPDATE `orders` SET `status` = 'Received' WHERE id='$user_id' and order_id='$order_id'";
            $runqr = mysqli_query($connection, $qr);
            echo "<script>alert('You have received orders that  you have been cancelled later, Thank you')</script>";
            echo "<script>window.location.href = 'pendingorders.php';</script>";
        }
    } else {
        $qr = "UPDATE `orders` SET `status` = 'Received' WHERE id='$user_id' and order_id='$order_id'";
        $runqr = mysqli_query($connection, $qr);
        if ($runqr) {
            echo "<script>alert('You have confirmed the customer')</script>";
            echo "<script>window.location.href = 'pendingorders.php';</script>";
        }
    }
}