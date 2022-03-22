<!--Include Header.php -->
<?php
include("include/header.php");
//single product view
$category = "";
$prid = 0;
if (isset($_GET['id']) != null) {
    $pro_id = $_GET['id'];
    $sql = "select * from users INNER JOIN products ON users.id=products.id AND products.pr_id='$pro_id'";
    $run_query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($run_query) > 0) {
        while ($arr = mysqli_fetch_array($run_query)) {

            //echo "hello" . $arr['pr_id'];
            $category = $arr['pro_category'];
            $prid = $arr['pr_id'];

?>
<script src="jsc/jquery.min.js"></script>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="stock.php">All Categories</a></li>
                    <li><a
                            href="single_category.php?category=<?= $arr['pro_category'] ?>"><?= $arr['pro_category'] ?></a>
                    </li>
                    <li class="active">
                        <?= $arr['product_name'] ?>
                    </li>
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
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:10cm;">
                    </div>

                    <div class="product-preview">
                        <img src="./img/<?= $arr['imag1'] ?>" alt="">
                    </div>

                    <div class="product-preview">
                        <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:10cm;">
                    </div>

                    <div class="product-preview">
                        <img src="./img/<?= $arr['imag1'] ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:3cm;">
                    </div>
                    <div class="product-preview">
                        <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:3cm;">
                    </div>

                    <div class="product-preview">
                        <img src="./Inventory/project_images/<?= $arr['imag1'] ?>" alt="" style="height:3cm;">
                    </div>

                    <div class="product-preview">
                        <img src="./img/<?= $arr['imag1'] ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">

                    <h6 class="product-name text-info">Location:<?= $arr['district'] ?>&nbsp;District</h6>
                    <h5 class="product-name">name:&nbsp;<?= $arr['pro_category'] ?>
                    </h5>
                    <div>
                        <div class="product-rating">
                            <?php
                                        $as = "select AVG(rating) AS avg ,SUM(rating) as sum from reviews where pr_id='$prid' ";
                                        $runas = mysqli_query($connection, $as);
                                        $result = mysqli_fetch_array($runas);
                                        $avg = $result['avg'];
                                        $sum = $result['sum'];
                                        //echo $avg;
                                        $newt = 5 - $avg;
                                        for ($i = 0; $i < $avg; $i++) {
                                            echo "<i class='fa fa-star'></i>";
                                        }
                                        for (
                                            $j = 1;
                                            $j < $newt;
                                            $j++
                                        ) {
                                            echo "<i class='fa fa-star-o empty'></i>";
                                        }
                                        ?>
                        </div>
                        <a class="review-link" data-toggle="tab" href="#tab3">
                            <?= $sum ?> Review(s) | Add your review
                        </a>
                    </div>
                    <div>
                        <h3 class="product-price">
                            <?php if ($arr['discount'] > 0) {

                                            echo "Rwf" . " " . $arr['discount'];
                                            echo ".00";
                                        } else {
                                            echo "Rwf" . " " . $arr['unit_price'];
                                            echo ".00";
                                        }

                                        ?> <del class="product-old-price">
                                <?php if ($arr['discount'] > 0) {
                                                echo  $arr['unit_price'];
                                                echo ".00";
                                            } ?></del></h3>
                        <span class="product-available">In Stock:&nbsp;&nbsp;<strong
                                class=""><?= $arr['qty'] ?>&nbsp;&nbsp;Kg(s)
                            </strong>
                        </span>
                    </div>
                    <p>
                        <?= $arr['description'] ?>
                    </p>

                    <!-- <div class="product-options">

                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div> -->

                    <div class="add-to-cart">
                        <!-- <div class="qty-label">
                            Qty
                            <div class="input-number">
                                <input type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div> -->
                        <button class="add-to-cart-btn"
                            onclick="window.location.href='add_cart.php?id=<?php echo $arr['pr_id']; ?>'"><i
                                class="fa fa-shopping-cart"></i> add to basket</button>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>

                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a
                                href="single_category.php?category=<?= $arr['pro_category'] ?>"><?= $arr['pro_category'] ?></a>
                        </li>
                        <li class="active">
                            <?= $arr['product_name'] ?>
                        </li>
                    </ul>
                    <ul class="product-links">
                        <i class="fa fa-map-marker text-info" aria-hidden="true"></i>
                        &nbsp;<li class="text-info">Owner's Address and Contact Info:</li>
                        <div class="row">
                            <div class="col-sm-6">
                                TELEPHONE:&nbsp;<i
                                    class="fa fa-phone text-info"></i>&nbsp;<b><?= $arr['telphone'] ?></b>
                                Province:&nbsp;<b><?= $arr['province'] ?></b>
                                District:&nbsp;<b><?= $arr['district'] ?></b>
                            </div>
                            <div class="col-sm-6">
                                Sector:&nbsp;<b><?= $arr['sector'] ?></b>
                                Cell:&nbsp;<b><?= $arr['cell'] ?></b>
                                Village:&nbsp;<b><?= $arr['village'] ?></b>

                            </div>

                        </div>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook text-info"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter text-info"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus text-info"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope text-info"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <?php



                                $count = "SELECT * FROM reviews WHERE pr_id='$prid'";
                                $t = mysqli_query($connection, $count);
                                $rowq = mysqli_num_rows($t);
                                ?>
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>

                        <li><a data-toggle="tab" href="#tab3">Reviews (<?= $rowq ?>)
                            </a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <?= $arr['description'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span><?php $result = mysqli_query($connection, "SELECT AVG(rating) AS avg FROM reviews  WHERE pr_id='$prid'");
                                                                $row = mysqli_fetch_array($result);
                                                                $val = $row['avg'];
                                                                echo $val; ?>
                                            </span>
                                            <div class="rating-stars">
                                                <?php
                                                            $totrating = 5;
                                                            $numrating = $val;

                                                            for (
                                                                $i = 1;
                                                                $i <= $numrating;
                                                                $i++
                                                            ) {
                                                            ?>
                                                <i class="fa fa-star"></i>
                                                <?php
                                                            }
                                                            if ($numrating != $totrating) {
                                                                $new = $totrating - $numrating;
                                                                for ($j = 1; $j <= $new; $j++) {
                                                                    echo "<i class='fa fa-star-o empty'></i>";
                                                                }
                                                            }

                                                            ?>

                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <?php
                                                        $qe = "select * from reviews where pr_id='$prid' ORDER BY rating DESC LIMIT 5";
                                                        $runqe = mysqli_query($connection, $qe);
                                                        while ($res = mysqli_fetch_array($runqe)) {

                                                            $rt = $res['rating'];

                                                        ?>
                                            <li>
                                                <div class="rating-stars">

                                                    <?php
                                                                    $totrating = 5;
                                                                    $numrating =  $rt;

                                                                    for (
                                                                        $i = 1;
                                                                        $i <= $numrating;
                                                                        $i++
                                                                    ) {
                                                                    ?>
                                                    <i class="fa fa-star"></i>
                                                    <?php
                                                                    }
                                                                    if ($numrating != $totrating) {
                                                                        $new = $totrating - $numrating;
                                                                        for ($j = 1; $j <= $new; $j++) {
                                                                            echo "<i class='fa fa-star-o empty'></i>";
                                                                        }
                                                                    }

                                                                    ?>

                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: <?php echo $rt * 100 / 5; ?>%;"></div>
                                                </div>
                                                <span class="sum">
                                                    <?= $res['rating'] ?>
                                                </span>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <?php
                                                        $rev = "  SELECT
                                                        *
                                                    FROM
                                                        `reviews`
                                                    WHERE
                                                        pr_id='$prid' ORDER BY submitted_date DESC LIMIT 5";
                                                        $runrev = mysqli_query($connection, $rev);
                                                        while ($re = mysqli_fetch_array($runrev)) {



                                                        ?>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name"><?= $re['name'] ?></h5>
                                                    <p class="date">
                                                        <?php
                                                                        $original_date = $re['submitted_date'];
                                                                        // Creating timestamp from given date
                                                                        $timestamp = strtotime($original_date);
                                                                        // Creating new date format from that timestamp
                                                                        $new_date = date("d-M-Y h:i:s", $timestamp);
                                                                        echo $new_date;
                                                                        ?>
                                                    </p>
                                                    <div class="review-rating">
                                                        <?php
                                                                        $totrating = 5;
                                                                        $numrating = $re['rating'];

                                                                        for (
                                                                            $i = 1;
                                                                            $i <= $numrating;
                                                                            $i++
                                                                        ) {
                                                                        ?>
                                                        <i class="fa fa-star"></i>
                                                        <?php
                                                                        }
                                                                        if ($numrating != $totrating) {
                                                                            $new = $totrating - $numrating;
                                                                            for ($j = 1; $j <= $new; $j++) {
                                                                                echo "<i class='fa fa-star-o empty'></i>";
                                                                            }
                                                                        }

                                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p><?= $re['sms'] ?>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <!-- <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul> -->

                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form class="review-form" action="" method="POST">
                                            <input class=" input" type="text" name="name" placeholder="Your Name">
                                            <input class="input" type="email" name="email" placeholder="Your Email">
                                            <textarea class="input" placeholder="Your Review" name="sms"></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label
                                                        for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label
                                                        for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label
                                                        for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label
                                                        for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label
                                                        for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn" type="submit" name="save_rating">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Review Form -->
                                <?php if (isset($_POST['save_rating'])) {
                                                $name = $_POST['name'];
                                                $email = $_POST['email'];
                                                $sms = $_POST['sms'];
                                                $rating = $_POST['rating'];
                                                $date = date('y-m-d h:i:s');
                                                $in = "INSERT INTO `reviews`(
                                                    `review_id`,
                                                    `pr_id`,
                                                    `name`,
                                                    `email`,
                                                    `sms`,
                                                    `rating`,
                                                    `submitted_date`
                                                )
                                                VALUES(
                                                    null,
                                                    '$prid',
                                                    '$name',
                                                    '$email',
                                                    '$sms',
                                                    '$rating',
                                                    '$date'
                                                )";
                                                $runit = mysqli_query($connection, $in);
                                                if ($runit) {
                                                    echo "<script>alert('Your Rating have been submitted')</script>";
                                                } else {
                                                    echo "nooo" . mysqli_error($connection);
                                                }
                                            }
                                            ?>
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<?php
        }
    }
}
?>
<!-- Section -->
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
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            <!-- product -->
            <?php $query1 = "SELECT * FROM products WHERE qty >0 && pro_category='$category' && pr_id!='$prid' LIMIT 4";
            $sql = mysqli_query($connection, $query1);
            while ($data1 = mysqli_fetch_array($sql)) {
                $id = $data1['pr_id'];
            ?>
            <div class="col-md-3 col-xs-6">

                <div class="product">
                    <div class="product-img">

                        <a href="single_product.php?id=<?= $data1['pr_id'] ?>">
                            <img src="./Inventory/project_images/<?= $data1['imag1'] ?>" alt=""
                                style="height:10cm;width:100%;">
                        </a>
                        <div class=" product-label">
                            <!-- <span class="sale">-30%</span>
                            <span class=" new">NEW</span> -->
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">
                            Category:<strong class="text-info"><?= $data1['pro_category'] ?></strong>
                        </p>
                        <h3 class="product-name">Name:<a
                                href="single_product.php?id=<?= $data1['pr_id'] ?>"><?= $data1['product_name'] ?></a>
                        </h3>

                        <h4 class=" product-price">
                            <strong class=" ">quantity:</strong>
                            <?php if ($data1['qty'] > 0) {
                                    echo  $data1['qty'];
                                    echo " " . "Kg";
                                }
                                ?>
                        </h4>


                        <!-- ################################### -->
                        <h4 class=" product-price">
                            <strong class=" ">Price:</strong>
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
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                    to
                                    wishlist</span></button>

                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"
                                    data-toggle="modal" data-target="#quick-view-modal"
                                    id="<?= $data1['pr_id'] ?>">quick
                                    view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"
                            onclick="window.location.href='add_cart.php?id=<?php echo $data1['pr_id']; ?>'"><i
                                class="fa fa-shopping-cart"></i> add
                            to
                            basket</button>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- /product -->

            <div class="clearfix visible-sm visible-xs"></div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
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
<?php
include('include/footer.php');
?>