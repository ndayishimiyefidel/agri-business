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
    //check whether the status of order is pending
    $sel1 = "SELECT * FROM `orders` WHERE id='$user_id' and order_id='$order_id'";
    $runsel1 = mysqli_query($connection, $sel1);
    while ($result = mysqli_fetch_array($runsel1)) {
        $pr_id = $result['pr_id'];
        $status = $result['status'];
    }
    if ($status != 'Pending') {
        echo "<script>alert('The customer order has been already $status ,you cannot cancel it!')</script>";
        echo "<script>window.location.href = 'pendingorders.php';</script>";
    } elseif ($status = 'Expired') {
        echo "<script>alert('The customer order has been  $status ,you cannot cancel it again!')</script>";
        echo "<script>window.location.href = 'pendingorders.php';</script>";
    } else {
        $qr = "UPDATE `orders` SET `status` = 'Cancelled' WHERE id='$user_id' and order_id='$order_id'";
        $runqr = mysqli_query($connection, $qr);
        $totqty = 0;
        if ($runqr) {
            $sel = "SELECT * FROM `orders` WHERE id='$user_id' and order_id='$order_id'";
            $runsel = mysqli_query($connection, $sel);
            while ($result = mysqli_fetch_array($runsel)) {
                $pr_id = $result['pr_id'];
                $qty = $result['qty'];
            }
            $sel0 = "SELECT * FROM `products` WHERE pr_id='$pr_id' and id='$user_id'";
            $runsel0 = mysqli_query($connection, $sel0);
            while ($result0 = mysqli_fetch_array($runsel0)) {
                $pr_id = $result0['pr_id'];
                $qty0 = $result0['qty'];
            }
            $totqty = $qty + $qty0;
            $qrt = "UPDATE `products` SET `qty` = '$totqty' WHERE pr_id='$pr_id' and id='$user_id'";
            $runqrt = mysqli_query($connection, $qrt);
        }
        echo "<script>alert('You have cancelled the customer')</script>";
        echo "<script>window.location.href = 'pendingorders.php';</script>";
    }
}