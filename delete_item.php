<?php
require_once('./Inventory/includes/cnx.php');
?>
<?php

if (!isset($_SESSION['isCustomerLoggedIn'])) {
    //remove the id from our cart array
    $key = array_search($_GET['id'], $_SESSION['cart']);
    unset($_SESSION['cart'][$key]);

    unset($_SESSION['qty_array'][$_GET['index']]);
    //rearrange array after unset
    $_SESSION['qty_array'] = array_values($_SESSION['qty_array']);

    $_SESSION['message'] = "Product deleted from cart";
    header('location: stock.php');
} else {
    $user_email = $_SESSION['emailId'];
    $cust_id = $_SESSION['custId'];
    if (isset($_GET['id'])) {

        $prid = $_GET['id'];
        $query = "delete from cart where pr_id='$prid' && customer_id='$cust_id' ";
        $runq = mysqli_query($connection, $query);
        if ($runq) {
            $_SESSION['message'] = "Product removed from cart";
            header('location: cartview.php');
        }
    }
}