<?php
require_once('./Inventory/includes/cnx.php');
if (!isset($_SESSION['isCustomerLoggedIn'])) {
    echo " <script>alert('You can not view cart when you are not authorised')</script>";
    //$_SESSION['message'] = 'You can not view cart when you are not authorised';
    // header('location: loginform.php');
    echo "<script> window.location.href = './loginform.php';</script>";
}
include("include/header.php");
?>
<?php
// include("include/topnav.php");
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Cart</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li class="">
                        <a href="stock.php">
                            products</a>
                    </li>
                    <li class="active">Cart view </li>
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

            <div class="col-md-9">


                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Your Cart View</h3>
                    </div>




                    <table class="table table-striped table-bordered table-reponsive">

                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Category</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php if (!isset($_SESSION['isCustomerLoggedIn'])) { ?>
                        <tbody>
                            <form method="POST" action="cartview.php">
                                <?php

                                    //initialize total
                                    $total = 0;
                                    if (!empty($_SESSION['cart'])) {

                                        //create array of initail qty which is 1
                                        $index = 0;
                                        // if (!isset($_SESSION['qty_array'])) {
                                        //     $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                        // }
                                        // foreach($_SESSION['cart'] as $key =>$value)
                                        $sql = "SELECT * FROM products WHERE pr_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                        $query = $connection->query($sql);
                                        while ($row = $query->fetch_assoc()) {
                                            $qty1 = $row['qty']; ?>
                                <tr>
                                    <td><?= $row['product_name'] ?></td>
                                    <td><?= $row['pro_category'] ?></td>
                                    <td>
                                        <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                        <input type="number" class="form-control"
                                            value="<?php echo $_SESSION['qty_array'][$index] ?>"
                                            name="qty_<?php echo $index ?>">
                                        (kg)


                                    </td>
                                    <td><?php echo number_format($row['unit_price'], 2) ?></td>
                                    <td><?php echo number_format($_SESSION['qty_array'][$index] * $row['unit_price'], 2); ?>
                                    </td>

                                    <td>
                                        <a href="
                                            delete_item.php?id=<?php echo $row['pr_id']; ?>&index=<?php echo $index; ?>"
                                            class="">
                                            <i class="fa fa-trash text-danger" style="font-size:20px;"></i>
                                        </a>
                                    </td>
                                    <?php $total += $_SESSION['qty_array'][$index] * $row['unit_price']; ?>
                                </tr>
                                <?php
                                            $index++;
                                            //echo $_SESSION['qty_array'][1];
                                        }
                                    } else {
                                        ?>
                                <tr>
                                    <td colspan="4" class="text-center">No Item in Cart</td>
                                </tr>
                                <?php
                                    }

                                    ?>
                                <tr>
                                    <td colspan="4" align="right"><b>Total</b></td>
                                    <td><b>
                                            <?php echo number_format($total, 2); ?></b></td>
                                    <td>
                                        <button class="btn btn-primary" type="submit" name="save">
                                            save cart</button>
                                </tr>
                            </form>
                        </tbody>

                        <?php } else { ?>
                        <tbody>
                            <?php

                                //initialize total
                                $total = 0;
                                $index = 0;
                                $sql = "select * from products INNER JOIN cart ON products.pr_id=cart.pr_id AND cart.customer_id='$cust_id'";
                                $query = $connection->query($sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = $query->fetch_assoc()) {
                                        $qty1 = $row['qty'];
                                ?>
                            <tr>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['pro_category'] ?></td>
                                <td>
                                    <form action="save.php" method="Post">
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control" name="pro_id"
                                                value="<?= $row['pr_id'] ?>">
                                            <input type="number" class="form-control" name="qtys"
                                                value="<?= $row['qty'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="submit" class="btn btn-primary" name="update" value="update">
                                        </div> (kg)
                                    </form>
                                </td>
                                <td><?php echo number_format($row['unit_price'], 2) ?></td>
                                <td><?php echo number_format($row['qty'] * $row['unit_price'], 2); ?>
                                </td>

                                <td>
                                    <a href=" delete_item.php?id=<?php echo $row['pr_id']; ?>" class="">
                                        <i class="fa fa-trash text-danger" style="font-size:20px;"></i>
                                    </a>
                                </td>
                                <?php $total += $row['qty'] * $row['unit_price']; ?>
                            </tr>
                            <?php
                                        $index++;
                                        //echo $_SESSION['qty_array'][1];
                                    }
                                } else {
                                    ?>
                            <tr>
                                <td colspan="4" class="text-center">No Item in Cart</td>
                            </tr>
                            <?php
                                }

                                ?>
                            <tr>
                                <td colspan="4" align="right"><b>Total</b></td>
                                <td><b>
                                        <?php echo number_format($total, 2); ?></b></td>
                            </tr>
                        </tbody>
                        <?php
                        }

                        ?>
                    </table>

                    <div class="col-md-4">
                        <a class="btn btn-secondary" onclick="window.location.href=' stock.php'"><i
                                class="fa fa-left-arrow"></i>Back to shopping</a>
                    </div>
                    <?php
                    if (isset($_SESSION['isCustomerLoggedIn'])) {
                        $sql = "select * from products INNER JOIN cart ON products.pr_id=cart.pr_id AND cart.customer_id='$cust_id'";
                        $query = $connection->query($sql);
                        if (mysqli_num_rows($query) > 0) {
                    ?>
                    <div class="col-md-4">
                        <a class="btn btn-danger" onclick="window.location.href='clear_cart.php'">Clear cart</a>
                    </div>


                    <div class="col-md-4">
                        <a class="btn btn-success" onclick="window.location.href='checkout.php'"
                            style="float:right;">Check
                            out</a>
                    </div>
                    <?php
                        }
                    } else { ?>
                    <div class="col-md-4">
                        <a class="btn btn-danger" onclick="window.location.href='clear_cart.php'">Clear cart</a>
                    </div>


                    <div class="col-md-4">
                        <a class="btn btn-success" onclick="window.location.href='checkout.php'"
                            style="float:right;">Check
                            out</a>
                    </div><?php
                            }
                                ?>
                </div>

                <!-- Order Details -->
                <div class="col-md-3">

                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!--Include footer.php-->
    <?php
    include('include/footer.php');
    ?>