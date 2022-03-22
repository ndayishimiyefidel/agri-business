<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>
alert('Plz , Login first !')
</script>";
    echo "<script>
window.location.href = '../index.php';
</script>";
} ?>
<?php
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$user_id = $_SESSION['userId'];
if (isset($_POST['updateacc']) != null) {
    $acc_id = $_POST['update_id'];
    $acc_name = $_POST['acc_name'];
    $acc_number = $_POST['acc_number'];
    $up = "UPDATE `accounts` SET `acc_name`='$acc_name',`acc_number`='$acc_number' WHERE id='$user_id' and acc_id='$acc_id'";
    $runup = mysqli_query($connection, $up);
    if (!$runup) {
        echo "no" . mysqli_error($connection);
    } else {

        echo "<script>alert('Account Information updated!')</script>";
        echo "<script>window.location.href='editprofile.php'</script>";
    }
}
?>