<?php
require_once('./includes/cnx.php');
?>
<?php
if (isset($_POST['submit_password'])) {
    $email = $_POST['email'];
    $pass = $_POST['newpwd'];
    $cpass = $_POST['cpwd'];
    $newpass = md5($pass);
    if ($pass != $cpass) {
        echo "<script>alert('Two password do not match,try again')</script>";
        echo "<script>window.location.href='./forgot-password.php';</script>";
    } else {
        $select = mysqli_query($connection, "update users set password='$newpass' where md5(email)='$email'");
        if ($select) {
            echo "<script>alert('Thank you, your password changed successfully!')</script>";
            echo "<script>window.location.href='./index.php';</script>";
        } else {
            echo "failed to change password" . mysqli_error($connection);
        }
    }
}