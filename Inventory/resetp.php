<?php
require_once('./includes/cnx.php');


?>
<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['request']) && $_POST['email']) {
    $email0 = $_POST['email'];
    $select = mysqli_query($connection, "select email,password from users where email='$email0'");
    if (mysqli_num_rows($select) == 1) {
        while ($row = mysqli_fetch_array($select)) {
            $email = md5($row['email']);
            $pass = $row['password'];
        }

        $link = "<a href='localhost/e-homepage/Inventory/recover-password.php?key=" . $email . "&reset=" . $pass . "'>Click To Reset password</a>";
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";


        $mail = new PHPMailer(true);
        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;
        // GMAIL username
        $mail->Username = "fullstackdeveloppers@gmail.com";
        // GMAIL password
        $mail->Password = "muganza@2021";
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From = $email0;
        $mail->FromName = 'Agri-business';
        $mail->AddAddress($email0);
        $mail->Subject  =  'Reset Password';
        $mail->IsHTML(true);
        $mail->Body    = 'Click On This Link to Reset Password ' . $link . '';
        if ($mail->Send()) {
            echo "Check Your Email and Click on the link sent to your email";
        } else {
            echo "Mail Error - >" . $mail->ErrorInfo;
        }
    }
}
?>