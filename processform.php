<?php
require_once('./Inventory/includes/cnx.php');
?><?php if (isset($_POST['signin1'])) {
        //print_r($_POST);
        $email = $_POST["email"];
        $password =  $_POST["password"];
        $password = md5($password);
        $x = 0;
        $cust_id = 0;
        $sql = "select * from customers where email = '$email' && password = '$password' && status=1";
        $run = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        while ($data = mysqli_fetch_array($run)) {
            $cust_id = $data['customer_id'];
            $fname = $data['firstname'];
            $lname = $data['lastname'];
            $tel = $data['telphone'];

            $x++;
        }
        if ($x == 1) {
            //if user login successfully , then set session
            $_SESSION['isCustomerLoggedIn'] = true;
            $_SESSION['emailId'] = $email;
            $_SESSION['custId'] = $cust_id;
            $_SESSION['isFname'] = $fname;
            $_SESSION['isLname'] = $lname;
            $_SESSION['isPhone'] = $tel;
            if (!empty($_SESSION['cart'])) {
                $index = 0;
                if (!isset($_SESSION['qty_array'])) {
                    $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                }

                $sql = "SELECT * FROM products WHERE pr_id IN (" . implode(',', $_SESSION['cart']) . ")";
                $query = $connection->query($sql);
                while ($row = $query->fetch_assoc()) {
                    //$qty = $row['qty'];
                    $qty = $_SESSION['qty_array'][$index];
                    $pids = $row['pr_id'];
                    $unit_price = $row['unit_price'];
                    $pro_owner = $row['id'];
                    $pro_category = $row['pro_category'];
                    $sql1 = "INSERT INTO cart (cart_id, id,customer_id,pr_id,pro_category,qty,unit_price) VALUES (null,'$pro_owner','$cust_id', '$pids','$pro_category','$qty', '$unit_price')";
                    $run = mysqli_query($connection, $sql1);
                    $_SESSION['cart-expire'] = time();
                    $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (30 * 60);
                }
            }

            echo "<script> window.location.href = './cartview.php';</script>";
        } else {
            echo " <script>alert('Try again Incorrect login credintial')</script>";
            echo "<script> window.location.href = './loginform.php';</script>";
        }
    }
    ?>