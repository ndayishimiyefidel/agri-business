<?php
require_once('./Inventory/includes/cnx.php');
if (!isset($_SESSION['isCustomerLoggedIn'])) {
    if (isset($_POST['save'])) {
        foreach ($_POST['indexes'] as $key) {
            $_SESSION['qty_array'][$key] = $_POST['qty_' . $key];
        }
        $_SESSION['cart-expire'] = time();
        $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
        $_SESSION['message'] = 'Cart updated successfullys';
        header('location: cartview.php');
    }
} else {
    $cust_id = $_SESSION['custId'];
    if (isset($_POST['update'])) {
        $qty = $_POST['qtys'];
        //echo "qty" . $qty;
        $product_id = $_POST['pro_id'];
        // echo "proid" . $product_id;
        $query0 = "select * from products where pr_id='$product_id'";
        $run0 = mysqli_query($connection, $query0);
        while ($fetch0 = mysqli_fetch_array($run0)) {

            $dbqty = $fetch0['qty'];
        }
        if ($qty <= $dbqty) {

            $up = "update cart set qty='$qty' where pr_id='$product_id' and customer_id='$cust_id'";
            $runup = mysqli_query($connection, $up);
            if (!$runup) {
                echo "not" . mysqli_error($connection);
            }
            $_SESSION['message'] = 'Cart Quantity updated successfully';
            $_SESSION['cart-expire'] = time();
            $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
            header('location: cartview.php');
        } else {
            header('location: cartview.php');
            $_SESSION['message'] = 'Quantity is higher than available';
        }
    }
}