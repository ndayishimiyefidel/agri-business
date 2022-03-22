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
    $qw = "select * from users where id='$id'";
    $r = mysqli_query($connection, $qw);
    while ($rr = mysqli_fetch_array($r)) {
        $status = $rr['status'];
    }
    if ($status == 1) {
        $query = "UPDATE users SET status=0 WHERE id ='$id'";
        $runq = mysqli_query($connection, $query);
        if ($runq) {
            echo "<script>alert('user disactivated successfully !')</script>";
            echo "<script>window.location.href='allusers.php';</script>";
        }
    } else {
        $query = "UPDATE users SET status=1 WHERE id ='$id'";
        $runq = mysqli_query($connection, $query);
        if ($runq) {
            echo "<script>alert('user activated successfully !')</script>";
            echo "<script>window.location.href='allusers.php';</script>";
        }
    }
}