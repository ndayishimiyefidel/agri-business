<!--Include Header.php -->

<?php
include("include/header.php");
?>
<?php
include("include/topnav.php");

?>

<script src="jsc/jquery.min.js"></script>
<!--product information modal-->

<div class="modal fade" id="quick-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Product Informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="show-info">
                <!--all modal data will be here --->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add to cart</button>
            </div>
        </div>
    </div>
</div>
<!--/product information modal-->
<!-- SECTION -->
<div data-spy="scroll" data-target="#navigation" data-offset="0">
    <div class="section" id="home">
        <!-- container -->
        <div class="container">
            <!-- row -->

            <div class="row">

                <?php
                $category = "";
                $countrecord  = 0;
                // $category = $_GET['category'];
                $sql = "select DISTINCT(pro_category),imag1,pr_id from products limit 3";
                $run_query = mysqli_query($connection, $sql);
                if (mysqli_num_rows($run_query) > 0) {
                    while ($arr = mysqli_fetch_array($run_query)) {

                        //echo "hello" . $arr['pr_id'];
                        $category = $arr['pro_category'];
                        $prid = $arr['pr_id'];

                ?>
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:10cm;">
                        </div>
                        <div class="shop-body">
                            <h3>
                                <?= $category ?><br>Collection
                            </h3>
                            <a href="single_category.php?category=<?= $category ?>" class="cta-btn">Shop
                                now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
                <?php $countrecord++;
                        if ($countrecord % 3 == 0) { //start new row
                        ?>
            </div>
            <!-- /row -->
            <div class="row">
                <?php
                        }
                    }
                    if ($countrecord % 3 != 0) { // don't start new row
            ?>
            </div>
            <?php }
                }
    ?>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <?php
                                // display category
                                $k = 0;
                                $kk = 0;

                                $query = "SELECT  DISTINCT (pro_category) FROM products ORDER BY pro_category ASC ";
                                $sql = mysqli_query($connection, $query);
                                while ($data2 = mysqli_fetch_array($sql)) {
                                    $k++;
                                    $kk = $data2['pro_category'];

                                ?>
                                <li class=""><a href="single_category.php?category=<?= $data2['pro_category'] ?>">
                                        <?= $kk ?>
                                    </a></li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class=" col-md-12">
                    <?php $countrecord = 0; ?>
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->

                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php $query = "SELECT * FROM products WHERE qty >0 ORDER BY pr_id ASC LIMIT 6";
                                    $sql = mysqli_query($connection, $query);
                                    while ($data1 = mysqli_fetch_array($sql)) {
                                        $id = $data1['pr_id'];
                                        $uuid = $data1['id'];
                                    ?>
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <a href="single_product.php?id=<?= $data1['pr_id'] ?>">
                                                <img src="./Inventory/project_images/<?= $data1['imag1'] ?>" alt=""
                                                    style="height:10cm;width:100%;">
                                            </a>
                                            <div class="imageContent">
                                                <?php
                                                    $qw = "select * from users where id='$uuid'";
                                                    $rty = mysqli_query($connection, $qw);
                                                    while ($value = mysqli_fetch_array($rty)) {
                                                    ?>
                                                <h5>
                                                    <?= $value['district'] ?>&nbsp;
                                                    District
                                                </h5>
                                                <?php
                                                    } ?>
                                            </div>
                                            <div class=" product-label">
                                                <span class="sale">-30%</span>
                                                <span class=" new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">
                                                Category:<strong
                                                    class="text-info"><?= $data1['product_name'] ?></strong>
                                            </p>
                                            <h3 class="product-name">Name:<a
                                                    href="single_product.php?id=<?= $data1['pr_id'] ?>"><?= $data1['pro_category'] ?></a>
                                            </h3>

                                            <h4 class="product-name">
                                                <strong class="">quantity:</strong>
                                                <?php if ($data1['qty'] > 0) {
                                                        echo  $data1['qty'];
                                                        echo " " . "Kg";
                                                    }
                                                    ?>
                                            </h4>
                                            <!-- ################################### -->
                                            <h4 class="product-price">
                                                <strong class="">Price:</strong>
                                                <?php if ($data1['discount'] > 0) {

                                                        echo "Rwf" . " " . $data1['discount'];
                                                        echo ".00";
                                                    } else {
                                                        echo "Rwf" . " " . $data1['unit_price'];
                                                        echo ".00";
                                                    }

                                                    ?> <del class="product-old-price">
                                                    <?php if ($data1['discount'] > 0) {
                                                            echo  $data1['unit_price'];
                                                            echo ".00";
                                                        } ?>
                                                </del>
                                            </h4>
                                            <div class="product-rating">
                                                <?php
                                                    $as = "select AVG(rating) AS avg from reviews where pr_id='$id' ";
                                                    $runas = mysqli_query($connection, $as);
                                                    $result = mysqli_fetch_array($runas);
                                                    $avg = $result['avg'];
                                                    //echo $avg;
                                                    $newt = 5 - $avg;
                                                    for ($i = 0; $i < $avg; $i++) {
                                                        echo "<i class='fa fa-star'></i>";
                                                    }
                                                    for ($j = 0; $j < $newt; $j++) {
                                                        echo "<i class='fa fa-star-o empty'></i>";
                                                    }
                                                    ?>

                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                        class="tooltipp">add
                                                        to
                                                        wishlist</span></button>

                                                <button class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp" data-toggle="modal"
                                                        data-target="#quick-view-modal"
                                                        id="<?= $data1['pr_id'] ?>">quick view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"
                                                onclick="window.location.href='add_cart.php?id=<?php echo $data1['pr_id']; ?>'"><i
                                                    class="fa fa-shopping-cart"></i>
                                                add to basket</button>
                                        </div>
                                    </div><?php } ?>
                                    <!-- /product -->


                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <?php
                                // display category
                                $k = 0;
                                $kk = 0;

                                $query = "SELECT  DISTINCT (pro_category) FROM orders ORDER BY pro_category ASC ";
                                $sql = mysqli_query($connection, $query);
                                while ($data2 = mysqli_fetch_array($sql)) {
                                    $k++;
                                    $kk = $data2['pro_category'];

                                ?>
                                <li class=""><a href="single_category.php?category=<?= $data2['pro_category'] ?>">
                                        <?= $kk ?>
                                    </a></li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <?php
                                    $query = "SELECT
                                           products.product_name,
                                           products.pro_category,
                                           products.discount,
                                           products.imag1,
                                           products.id,
                                           products.pr_id,
                                           orders.order_id,
                                           products.unit_price,
                                           orders.qty,
                                           orders.order_date,
                                           orders.status
                                       FROM
                                           products,
                                           orders
                                       WHERE
                                             orders.pr_id = products.pr_id AND orders.status = 'Received' LIMIT 6";
                                    $sql = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($sql) > 0) {
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                            $id = $row['pr_id'];
                                            $uuid = $row['id'];

                                    ?>
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <a href="single_product.php?id=<?= $row['pr_id'] ?>">
                                                <img src="./Inventory/project_images/<?= $row['imag1'] ?>" alt=""
                                                    style="height:10cm;width:100%;">
                                            </a>
                                            <div class="imageContent">
                                                <?php
                                                        $qw = "select * from users where id='$uuid'";
                                                        $rty = mysqli_query($connection, $qw);
                                                        while ($value = mysqli_fetch_array($rty)) {
                                                        ?>
                                                <h5>
                                                    <?= $value['district'] ?>&nbsp;
                                                    District
                                                </h5>
                                                <?php
                                                        } ?>
                                            </div>
                                            <div class=" product-label">
                                                <!-- <span class="sale">-30%</span>
                                                <span class=" new">NEW</span> -->
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">
                                                Category:<strong class="text-info"><?= $row['product_name'] ?></strong>
                                            </p>
                                            <h3 class="product-name">Name:<a
                                                    href="single_product.php?id=<?= $row['pr_id'] ?>"><?= $row['pro_category'] ?></a>
                                            </h3>

                                            <h4 class=" product-price">
                                                <strong class=" ">sold quantity:</strong>
                                                <?php if ($row['qty'] > 0) {
                                                            echo  $row['qty'];
                                                            echo " " . "Kg";
                                                        }
                                                        ?>
                                            </h4>
                                            <!-- ################################### -->
                                            <h4 class=" product-price">
                                                <strong class=" ">Price:</strong>
                                                <?php if ($row['discount'] > 0) {

                                                            echo "Rwf" . " " . $row['discount'];
                                                            echo ".00";
                                                        } else {
                                                            echo "Rwf" . " " . $row['unit_price'];
                                                            echo ".00";
                                                        }

                                                        ?> <del class="product-old-price">
                                                    <?php if ($row['discount'] > 0) {
                                                                echo  $row['unit_price'];
                                                                echo ".00";
                                                            } ?>
                                                </del>
                                            </h4>
                                            <div class="product-rating">
                                                <?php

                                                        $as = "select AVG(rating) AS avg from reviews where pr_id='$id' ";
                                                        $runas = mysqli_query($connection, $as);
                                                        $result = mysqli_fetch_array($runas);
                                                        $avg = $result['avg'];
                                                        //echo $avg;
                                                        $newt = 5 - $avg;
                                                        for ($i = 0; $i < $avg; $i++) {
                                                            echo "<i class='fa fa-star'></i>";
                                                        }
                                                        for ($j = 0; $j < $newt; $j++) {
                                                            echo "<i class='fa fa-star-o empty'></i>";
                                                        }
                                                        ?>

                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                        class="tooltipp">add
                                                        to
                                                        wishlist</span></button>

                                                <button class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp" data-toggle="modal"
                                                        data-target="#quick-view-modal" id="<?= $row['pr_id'] ?>">quick
                                                        view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"
                                                onclick="window.location.href='add_cart.php?id=<?php echo $row['pr_id']; ?>'"><i
                                                    class="fa fa-shopping-cart"></i>
                                                add to basket</button>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <?php
                                        }
                                    } else {
                                        echo "No Recent sold products....";
                                    }
                                    ?>
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->



</div>
<!-- /SECTION -->
<script type="text/javascript">
$(document).ready(function() {
    $('.tooltipp').click(function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "getproductinfo.php",
            type: "GET",
            data: "uid=" + id,
            success: function(data) {
                $("#show-info").html(data);

            }
        });
    });
});
</script>
<!--Include footer.php-->
<?php
include('include/footer.php');
?>