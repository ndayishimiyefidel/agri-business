<?php
require_once('./Inventory/includes/cnx.php');
?>
<?php
//user needs to login to checkout
if (!isset($_SESSION['isCustomerLoggedIn'])) {
    // $_SESSION['emailId'] = 'You need to login to checkout';
    echo "<script>alert('You need to login to checkouts');</script>";
    //header('location: index.php');
    //redirect to login page where customer or user can login
    include('loginform.php')
?>
<?php
} else {
    //get session variable
    $user_email = $_SESSION['emailId'];
    $cust_id = $_SESSION['custId'];
    $fname = $_SESSION['isFname'];
    $lname = $_SESSION['isLname'];
    $tel = $_SESSION['isPhone'];
    $ql0 = "select * from cart where customer_id='$cust_id'";
    $qlrun = mysqli_query($connection, $ql0);
    $row = mysqli_num_rows($qlrun);
    if ($row <= 0) {
        header('location:stock.php');
    } else {
        include("include/header.php");
    ?>


<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cartview.php">My cart</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form method="post" action="">
                <div class="col-md-7">
                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Shipping address</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address" name="checked">
                            <label for="shiping-address">
                                <span></span>
                                Ship to a diffrent address?
                            </label>
                            <div class="caption">
                                <div class="form-group">
                                    <input class="input" type="text" name="first-name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="last-name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="input" type="text" name="province1" placeholder="province">
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="input" type="text" name="district1" placeholder="district">
                                </div>
                                <div class="form-group col-md-4">
                                    <input class="input" type="text" name="sector1" placeholder="sector">
                                </div>
                                <div class="form-group col-md-4">
                                    <input class="input" type="text" name="cell1" placeholder="cell">
                                </div>
                                <div class="form-group col-md-4">
                                    <input class="input" type="text" name="village1" placeholder="village">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="tel" name="tel" placeholder="Telephone">
                                </div>
                                <!-- Order notes -->
                                <div class="order-notes">
                                    <textarea class="input" placeholder="Order Notes"></textarea>
                                </div>
                                <!-- /Order notes -->
                            </div>
                        </div>
                    </div>
                    <!-- /Shiping Details -->


                </div>
                <?php
                        $ql = "select COUNT(cart_id) as counts from cart where customer_id='$cust_id'";
                        $qlrun = mysqli_query($connection, $ql);
                        while ($r = mysqli_fetch_array($qlrun)) {
                            $counts = $r['counts'];
                        } ?>

                <div class="text-info" style="color:red;font-size:12px;top:2;font-weight:bold;">
                    <?php
                            echo $counts; ?>
                </div>
                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>CUSTOMER INFORMATION</strong></div>
                            <div><strong></strong></div>

                        </div>
                        <div class="order-col">
                            <div>Firstname: </div>
                            &nbsp;...................................................
                            <div><strong><?php echo $fname; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div>Lastname: </div>
                            &nbsp;...................................................
                            <div><strong><?php echo $lname; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div>Telephone: </div>
                            &nbsp;....................................................
                            <div><strong><?php echo "0" . $tel; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>

                        </div>

                        <div class="order-products">
                            <?php
                                    $total = 0;
                                    $sql = "select * from products INNER JOIN cart ON products.pr_id=cart.pr_id AND cart.customer_id='$cust_id'";
                                    $query = $connection->query($sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = $query->fetch_assoc()) {
                                            $qty1 = $row['qty']; ?>

                            <div class="order-col">
                                <div>
                                    <?= $row['qty'] ?>x <?= $row['product_name'] ?>
                                </div>
                                <div>Rwf:<?php echo number_format($row['qty'] * $row['unit_price'], 2); ?></div>
                            </div>
                            <?php $total += $row['qty'] * $row['unit_price']; ?>
                            <?php
                                        }
                                        $tva = $total * 0.18;
                                    } ?>

                        </div>
                        <div class="order-col">
                            <div>Tax:(VAT)</div>
                            <div>Rwf:<strong>
                                    <?php echo $tva; ?>
                                </strong></div>
                        </div>
                        <div class="order-col">
                            <div>Shiping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total"
                                    style="text-decoration:underline;"><?php echo number_format($total, 2); ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2" value="Mobile Money">
                            <label for="payment-2">
                                <span></span>
                                Mobile SMS
                            </label>
                            <div class="caption">

                                <p class="text-info">
                                    When ever you use sms by sending request
                                    your order will be received very soon</p><br>
                                <label class="text-dark" style="margin-left:-0.5cm;"><b>Telephone To
                                        send sms</b></label>
                                <div class="form-group">
                                    <input class="input" type="number" name="phone_number"
                                        placeholder="phone format: 07[2,3,8,9]xxxxxxxx" required>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" value="Bank Transfer">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p class="text-info">Direct Bank Transfer, or Bank Account Clearing System
                                    (BACS), is a gateway that require
                                    no payment be made online
                                </p>
                                <label class="text-dark" style="margin-left:-0.5cm;"><b>Bank Name</b></label>
                                <div class="form-group">
                                    <select name="bkname" class="form-control">
                                        <option value="">choose bank name...</option>
                                        <option value="bk">Bank of Kigali (bk) </option>
                                        <option value="Equity Bank">Equity Bank</option>
                                        <option value="cogebank">Cogebank</option>
                                        <option value="bpr">BPR</option>
                                    </select>
                                </div>
                                <label class="text-dark" style="margin-left:-0.5cm;">
                                    <b>Account
                                        Number</b></label>
                                <div class="form-group">
                                    <input class="input" type="number" name="acc_number"
                                        placeholder="Type account number...">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" name="terms">
                        <label for="terms" class="text-info">
                            <span></span>
                            I've read and accept the <a href="#" class="text-info">terms & conditions</a>
                        </label>
                    </div>
                    <button class="primary-btn order-submit" type="submit" name="pay_order">Send order</button>
                </div>
                <!-- /Order Details -->
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    <?php
            if (isset($_POST['pay_order'])) {
                // check whether the customer hit order button

                if (isset($_POST['terms'])) {
                    //check if check is checked
                    if (isset($_POST['checked'])) {

                        // echo "checked";
                        // insert into db shipping addresss o the register customer
                    } else {
                        //billing address same as shipping  address
                    }
                    if (isset($_POST['payment'])) {
                        $payment_choice = $_POST['payment'];
                    }
                    //if mobile money selected
                    if ($payment_choice == 'Mobile Money') {
                        // echo "<script>alert('mobile selected ok');</script>";
                        $phone_number = $_POST['phone_number'];

                        if (!preg_match("/^07[2,3,8,9]{1}\d{7}$/", $phone_number)) {
                            echo " <script> alert('Invalid TelPhone number') </script>";
                        } else {
                            //selecting receiver number
                            $sql0 =
                                "SELECT DISTINCT
                        (cart.unit_price),
                        cart.qty,
                        cart.pro_category,
                        cart.customer_id,
                        cart.pr_id,
                        users.telphone,
                        cart.id
                    FROM
                        users
                    INNER JOIN cart ON users.id = cart.id  
                    AND cart.customer_id ='$cust_id'";
                            $query = $connection->query($sql0);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    $pr_id = $row['pr_id'];
                                    $qty = $row['qty'];

                                    $user_id = $row['id'];
                                    $unit_price = $row['unit_price'];
                                    $customerid = $row['customer_id'];
                                    $seller_phone = $row['telphone'];
                                    $pro_cat = $row['pro_category'];
                                    require 'messegebird/autoload.php';
                                    //sending sms via phone
                                    $recipient =  "+25" .  $phone_number;

                                    $x = [];
                                    $smsArray = array($fname, $lname, $unit_price, $qty, $pro_cat);
                                    foreach ($smsArray as $value) {
                                        $x = $value;
                                    }
                                    $select = "SELECT * FROM `orders` where pr_id='$pr_id' && customer_id='$customerid'";
                                    $runselect = mysqli_query($connection, $select);
                                    $k = 0;
                                    while ($result = mysqli_fetch_array($runselect)) {
                                        $k++;
                                    }
                                    $status = 'Pending';
                                    $order_date = date('y-m-d');
                                    if ($k == 0) {
                                        $cart = "INSERT INTO `orders`(`order_id`, `id`, `customer_id`, `pr_id`,`pro_category`, `qty`, `unit_price`,`order_date`,`status`) VALUES (null,'$user_id','$cust_id','$pr_id','$pro_cat','$qty','$unit_price','$order_date','$status')";
                                        $runorder = mysqli_query($connection, $cart);
                                        if ($runorder) {
                                            //set time when order remain active
                                            $_SESSION['order-expire'] = time();
                                            $_SESSION['order_expire_time'] = $_SESSION['order-expire'] + (2 * 24 * 60 * 60); //expire in 24 or simply 1 day
                                        }
                                        //finding the existing qty
                                        $sql01 = "SELECT * FROM `products` WHERE pr_id='$pr_id'";
                                        $run01 = mysqli_query($connection, $sql01);
                                        $preqty = 0;
                                        $totqty = 0;
                                        while ($res = mysqli_fetch_array($run01)) {
                                            $preqty = $res['qty'];
                                        }

                                        //updating products when order saved
                                        $totqty = $preqty - $qty;
                                        $rt = "UPDATE  `products` SET `qty` = '$totqty' WHERE pr_id='$pr_id'";

                                        $rtrun = mysqli_query($connection, $rt);
                                        $date = date('y-m-d');
                                        if ($rtrun) {
                                            $yh = "";
                                            $ss = "";
                                            $ins = "INSERT INTO `tbl_history`
                                                (
                                                `hist_id`,
                                                `id`,
                                                `pr_id`,
                                                `product_name`,
                                                `pro_category`,
                                                `season`,
                                                `unit_price`,
                                                `qty`,
                                                `discount`,
                                                `action_date`,
                                                `action_happened`
                                            )
                                            VALUES(
                                                null,
                                                '$user_id',
                                                '$pr_id',
                                                '$yh',
                                                '$pro_cat',
                                                '$ss',
                                                '$unit_price',
                                                '$qty',
                                                0,
                                                '$date',
                                                'Ordered'
                                            )
                                        ";
                                            $rr = mysqli_query($connection, $ins);
                                        }

                                        $messageBird = new \MessageBird\Client('PcFgRh8sQgoHFrnS9yRO32grB');
                                        $message =  new \MessageBird\Objects\Message();
                                        $response = "";
                                        try {
                                            $message->originator = '+250780494000'; //buyer or customer phone
                                            $message->recipients = [$recipient]; //receiver phone number or seller phone


                                            $message->body = $smsArray[0] . " " . $smsArray[1] . " " . "request" . " " . $smsArray[3] . " " . "kg" . " " . "of " . " " . $smsArray[4] . " " . " from your store";

                                            $response = $messageBird->messages->create($message);
                                            //check if message send
                                        } catch (Exception $e) {
                                            echo $e;
                                        }
                                        if ($rr) {
                                            $query0 = "delete from cart where customer_id='$cust_id'";
                                            $runqu = mysqli_query($connection, $query0);
                                            // echo "<script>alert('You need to login to checkout');</script>";
                                        }
                                    }
                                }

                                if ($k == 1) {
                                    echo "<div class='text-info text-center'>";
                                    echo "Your order already exist or received, Thank you!";
                                    echo "</div>";
                                } else {
                                    if ($response) {
                                        $res = $response->recipients->items[0]->recipient;
                                        $status = $response->recipients->items[0]->status;
                                        echo "<div class='text-info text-center'>";
                                        echo "<b> From: <b/> $response->originator <br>";
                                        echo "<b> To: <b/> $res <br>";
                                        echo "<b> Status: <b/> $status <br>";
                                        echo "Thank you for submitting your order have been received";
                                        echo "</div>";
                                    }
                                }
                            }
                        }
                    } elseif ($payment_choice == 'Bank Transfer') {
                        echo "<script>alert('Bank transfer selected ok');</script>";
                    } else {
                        echo "<script>alert('Please choose any payment method to continue');</script>";
                    }

                    //saving order in database
                } else {
                    echo "<script>alert('You must accept terms and condition');</script>";
                }
            } ?>
</div>

<?php
        include('include/footer.php');
    }
}
?>