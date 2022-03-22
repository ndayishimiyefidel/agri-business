<?php
require_once('./Inventory/includes/cnx.php');
if (isset($_SESSION['isCustomerLoggedIn'])) {
    $user_email = $_SESSION['emailId'];
    $cust_id = $_SESSION['custId'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>LIFACOM WEBSITE (linking farmers to common market)</title>

    <?php
    include("headlinks.php");
    ?>

</head>

<body>
    <?php
    // include login and regster modal
    //include('loginregisterModal.php');
    ?>
    <?php
    //initialize cart if not set or is unset
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    //unset quantity
    unset($_SESSION['qty_array']);
    ?>
    <!-- HEADER -->
    <header class="headers" id="yHeaders">
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +250-788-888-888</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> example@gmail.com</a></li>
                    <li><a href="https://goo.gl/maps/YLavb8bzF8Wm6TRLA"><i class="fa fa-map-marker"></i> Eglise
                            Gikondo, KK 31 Avenue,Kicukiro District, Rwanda</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-money"></i> RWF </a></li>
                    <?php
                    if (isset($_SESSION['isCustomerLoggedIn'])) {
                        // echo "<script>alert('Plz , Login first !')</script>";
                        // echo  "<script>window.location.href = '../index.php';</script>";
                    ?>
                    <li><a href="./logout.php"><i class=" fa fa-sign-out"></i>
                            logout</a></li>
                    <?php
                    } else {

                    ?>
                    <li><a href="#" data-toggle="modal" data-target="#bookticket"><i class=" fa fa-user-o"></i> My
                            Account</a></li><?php } ?>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <!-- <a href="#" class="logo">
                                <img src="./img/logo.png" alt="">
                            </a> -->
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="2">Beans</option>
                                    <option value="3">Rice</option>
                                    <option value="4">Cassava</option>
                                    <option value="5">Potatoes</option>

                                </select>
                                <input class="input" placeholder="Search here...">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <!-- Wish lists are collections of desired products saved
                             by customers to their user account, signifying 
                            interest without immediate intent to purchase. -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Favarites</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty"><?php
                                                        if (!isset($_SESSION['isCustomerLoggedIn'])) {
                                                            echo count($_SESSION['cart']);
                                                        } else {

                                                            $n = 0;
                                                            $q2 = "select *  from cart where customer_id='$cust_id'";
                                                            $run2 = mysqli_query($connection, $q2);
                                                            while ($run3 = mysqli_fetch_array($run2)) {
                                                                $n++;
                                                            }
                                                            echo $n++;
                                                        }

                                                        ?>
                                    </div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <?php
                                        if (isset($_SESSION['isCustomerLoggedIn'])) {
                                            $timenow = time();
                                            if ($timenow > $_SESSION['expire_time']) //set cart expiration in one time
                                            {
                                                $query = "delete from cart where customer_id='$cust_id' ";
                                                $runq = mysqli_query($connection, $query);
                                                if ($runq) {
                                                    $_SESSION['message'] = "Your cart session is expired add it again";
                                                    header('location: stock.php');
                                                }
                                            } else {


                                                //initialize total
                                                $total = 0;
                                                // if (!empty($_SESSION['cart'])) {

                                                //create array of initail qty which is 1
                                                $index = 0;


                                                //$sql = "SELECT * FROM cart WHERE customer_id='$cust_id'";
                                                $sql = "select * from products INNER JOIN cart ON products.pr_id=cart.pr_id AND cart.customer_id='$cust_id'";
                                                $query = $connection->query($sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = $query->fetch_assoc()) {
                                                        $qty1 = $row['qty']; ?>
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./Inventory/project_images/<?= $row['imag1'] ?>" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#"><?= $row['product_name'] ?></a>
                                                </h3>
                                                <h4 class="product-price"><span
                                                        class="qty"><?php echo $row['qty']; ?>x</span>Rwf
                                                    <?php echo number_format($row['unit_price'], 2) ?></h4>
                                            </div>
                                            <button class="delete"
                                                onclick="window.location.href='delete_item.php?id=<?php echo $row['pr_id']; ?>'"><i
                                                    class="fa fa-close"></i></button>
                                        </div>
                                        <?php $total += $row['qty'] * $row['unit_price']; ?>
                                        <?php $index++;
                                                    } ?>
                                    </div>
                                    <div class="cart-summary">
                                        <small>
                                            <?= $index ?> Item(s) selected
                                        </small>
                                        <h5>SUBTOTAL: Rwf <?php echo number_format($total, 2); ?></h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="cartview.php" style="float:left;">View Cart</a>
                                        <a href=" checkout.php" style="float:right;">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    <?php
                                                } else {
                                                    echo "your shopping cart is empty";
                                                }
                                            }
                                        } else {
                                            /*updte cart*/
                                            if (isset($_POST['save'])) {
                                                foreach ($_POST['indexes'] as $key) {
                                                    $_SESSION['qty_array'][$key] = $_POST['qty_' . $key];
                                                }
                                                $_SESSION['cart-expire'] = time();
                                                $_SESSION['expire_time'] = $_SESSION['cart-expire'] + (2 * 60 * 60);
                                                $_SESSION['message'] = 'Cart updated successfully';
                                                header('location: cartview.php');
                                            }

                                            //initialize total
                                            $total = 0;
                                            if (!empty($_SESSION['cart'])) {
                                                $timenow = time();
                                                if ($timenow > $_SESSION['expire_time']) //set cart expiration in one time
                                                {
                                                    //remove the id from our cart array
                                                    $key = array_search($_GET['id'], $_SESSION['cart']);
                                                    unset($_SESSION['cart'][$key]);
                                                    $_SESSION['message'] = "Product removed from cart because you session have been expired";
                                                    header('location: stock.php');
                                                } else {
                                                    //create array of initail qty which is 1
                                                    $index = 0;
                                                    if (!isset($_SESSION['qty_array'])) {
                                                        $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                                    }

                                                    $sql = "SELECT * FROM products WHERE pr_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                                    $query = $connection->query($sql);
                                                    while ($row = $query->fetch_assoc()) {
                                                        $qty1 = $row['qty']; ?>
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./Inventory/project_images/<?= $row['imag1'] ?>" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#"><?= $row['product_name'] ?></a>
                                            </h3>
                                            <h4 class="product-price"><span
                                                    class="qty"><?php echo $_SESSION['qty_array'][$index] ?>x</span>Rwf
                                                <?php echo number_format($row['unit_price'], 2) ?></h4>
                                        </div>
                                        <button class="delete"
                                            onclick="window.location.href='delete_item.php?id=<?php echo $row['pr_id']; ?>&index=<?php echo $index; ?>'"><i
                                                class="fa fa-close"></i></button>
                                    </div>
                                    <?php $total += $_SESSION['qty_array'][$index] * $row['unit_price']; ?>
                                    <?php $index++;
                                                    } ?>
                                </div>
                                <div class="cart-summary">
                                    <small>
                                        <?= $index ?> Item(s) selected
                                    </small>
                                    <h5>SUBTOTAL: Rwf <?php echo number_format($total, 2); ?></h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="cartview.php">View Cart</a>
                                    <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                                <?php }
                                            } else {
                                                echo "your shopping cart is empty";
                                            }
                                        } ?>
                            </div>

                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
    <?php
    //info message
    if (isset($_SESSION['message'])) {
    ?>

    <div class="alert alert-info" role="alert">
        <?php echo $_SESSION['message']; ?>
    </div>

    <?php
        unset($_SESSION['message']);
    }
        //end info message