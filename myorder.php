<?php
require_once('./Inventory/includes/cnx.php');
?>
<?php
//user needs to login to checkout
if (!isset($_SESSION['isCustomerLoggedIn'])) {

    echo "<script>alert('Login first!');</script>";
    header('location: loginform.php');

?>
<?php
} else {
    //get session variable
    $user_email = $_SESSION['emailId'];
    $cust_id = $_SESSION['custId'];
    $fname = $_SESSION['isFname'];
    $lname = $_SESSION['isLname'];
    $tel = $_SESSION['isPhone'];
    $ql0 = "select * from orders where customer_id='$cust_id'";
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
                <h3 class="breadcrumb-header">Orders</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">My order</li>
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
                <div class="col-md-5">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam soluta consectetur ea quae
                    commodi, tenetur id ullam aut, debitis quaerat sint minus expedita? Qui fuga libero quidem
                    repudiandae quasi atque.
                </div>
                <?php
                        $ql = "select COUNT(order_id) as counts from orders where customer_id='$cust_id'";
                        $qlrun = mysqli_query($connection, $ql);
                        while ($r = mysqli_fetch_array($qlrun)) {
                            $counts = $r['counts'];
                        } ?>

                <div class="text-info" style="color:red;font-size:12px;top:2;font-weight:bold;">
                    <?php
                            echo $counts; ?>
                </div>
                <!-- Order Details -->
                <div class="col-md-7 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order summary</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>CUSTOMER INFORMATION</strong></div>
                            <div><strong></strong></div>

                        </div>
                        <div class="order-col">
                            <div>Firstname: </div>
                            &nbsp;............................................................
                            <div><strong><?php echo $fname; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div>Lastname: </div>
                            &nbsp;..............................................................
                            <div><strong><?php echo $lname; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div>Telephone: </div>
                            &nbsp;............................................................
                            <div><strong><?php echo "0" . $tel; ?></strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>

                        </div>

                        <div class="order-products">
                            <?php
                                    $total = 0;
                                    $sql = "select * from products INNER JOIN orders ON products.pr_id=orders.pr_id AND orders.customer_id='$cust_id'";
                                    $query = $connection->query($sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = $query->fetch_assoc()) {
                                            $qty1 = $row['qty']; ?>

                            <div class="order-col">
                                <div>
                                    <?= $row['qty'] ?>x &nbsp;
                                    <?= $row['unit_price'] ?>&nbsp;<?= $row['product_name'] ?>
                                </div>
                                <div>Rwf:<?php echo number_format($row['qty'] * $row['unit_price'], 2); ?>&nbsp;

                                    <span class="text-primary"><?= $row['status'] ?></span>&nbsp;
                                    <span class="text-info"><?= $row['order_date'] ?></span>

                                    <!-- <a href="#">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                        </a> -->
                                </div>
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
                            <div>order status</div>
                            <div><strong>Received</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total"
                                    style="text-decoration:underline;"><?php echo number_format($total, 2); ?></strong>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Order Details -->
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

</div>

<?php
        include('include/footer.php');
    }
}
?>