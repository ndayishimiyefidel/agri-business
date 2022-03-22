<?php
require_once('../salesadmin/../includes/cnx.php');
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
$user_id = $_SESSION['userId'];
$date = date('y-m-d');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM accounts WHERE acc_id =$id and id='$user_id'";
    $runq = mysqli_query($connection, $query);
    if ($runq) {
        echo "<script>alert('Account deleted successfully !')</script>";
        echo "<script>window.location.href='editprofile.php';</script>";
    }
}