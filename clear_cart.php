<?php
require_once('./Inventory/includes/cnx.php');
?>
<?php

if (!isset($_SESSION['isCustomerLoggedIn'])) {
    unset($_SESSION['cart']);
    $_SESSION['message'] = 'Cart cleared successfully';
    header('location: index.php');
}
$user_email = $_SESSION['emailId'];
$cust_id = $_SESSION['custId'];
$query = "delete from cart where customer_id='$cust_id'";
$runqu = mysqli_query($connection, $query);
if ($runqu) {
    $_SESSION['message'] = 'Cart cleared successfully';
    header('location: stock.php');
} ?>