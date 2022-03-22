<?php
require_once('./Inventory/includes/cnx.php');
?><?php
    //check if there is any user logged in
    if (!isset($_SESSION['isCustomerLoggedIn'])) {

        //check if product is already in the cart
        if (!in_array($_GET['id'], $_SESSION['cart'])) {
            array_push($_SESSION['cart'], $_GET['id']);
            $_SESSION['message'] = 'Product added to cart';
            $_SESSION['cart-expire'] = time();
            $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
        } else {
            $_SESSION['message'] = 'Product already in cart';
        }

        header('location: stock.php');
    } else {
        //get session variable
        $user_email = $_SESSION['emailId'];
        $cust_id = $_SESSION['custId'];
        if (isset($_GET['id'])) {
            $pids = $_GET['id'];
            //check whether product already in cart by same user/customer
            $q1 = "select * from cart where customer_id='$cust_id' && pr_id='$pids'";
            $run1 = mysqli_query($connection, $q1);
            if (mysqli_num_rows($run1) > 0) {
                $_SESSION['message'] = 'Product already in cart';
                header('location: stock.php');
            } else {
                // $query = "select * from products where pr_id='$pids'";
                $query = "select * from products where pr_id='$pids'";
                $data = mysqli_query($connection, $query);
                while ($data1 = mysqli_fetch_array($data)) {
                    $pro_name = $data1['product_name'];
                    $pro_category = $data1['pro_category'];
                    $qty = $data1['qty'];
                    $unit_price = $data1['unit_price'];
                    $discount = $data1['discount'];
                    $pro_owner_id = $data1['id'];
                    if ($discount != 0) {
                        $sql1 = "INSERT INTO cart (cart_id,id,customer_id,pr_id,pro_category,qty,unit_price) VALUES (null,'$pro_owner_id','$cust_id', '$pids','$pro_category','$qty', '$discount')";
                        $run = mysqli_query($connection, $sql1);
                        $_SESSION['message'] = 'Product added to cart successfully';
                        $_SESSION['cart-expire'] = time();
                        $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
                        header('location: stock.php');
                    } else {
                        $sql1 = "INSERT INTO cart (cart_id,id,customer_id,pr_id,pro_category,qty,unit_price) VALUES (null,'$pro_owner_id','$cust_id', '$pids','$pro_category','$qty', '$unit_price')";
                        $run = mysqli_query($connection, $sql1);
                        $_SESSION['message'] = 'Product added to cart successfully';
                        $_SESSION['cart-expire'] = time();
                        $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
                        header('location: stock.php');
                    }
                }
            }
        }
    }