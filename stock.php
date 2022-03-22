 <!--Include Header.php -->
 <?php
    include("include/header.php");
    ?>
 <?php
    // include("include/topnav.php");
    ?>
 <script src="jsc/jquery.min.js"></script>
 <!--Products Page-->

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
                     <li class="active">Products</li>
                 </ul>
             </div>
         </div>
         <!-- /row -->
     </div>
     <!-- /container -->
 </div>
 <!-- /BREADCRUMB -->

 <!-- SECTION -->
 <div class="section" id="products">
     <!-- container -->
     <div class=" container">
         <!-- row -->
         <div class="row">
             <!-- ASIDE -->
             <div id="aside" class="col-md-3">
                 <!-- aside Widget -->
                 <div class="aside">
                     <h3 class="aside-title">Categories</h3>
                     <form method="GET" action="">
                         <button type="submit" class="btn btn-primary btn-sm float-end"
                             style="float:right;margin-top:-0.5cm;">Search</button>

                         <div class="checkbox-filter">
                             <?php
                                $k = 0;
                                $kk = 0;

                                $query = "SELECT  DISTINCT (pro_category) FROM products ORDER BY pro_category ASC";
                                $sql = mysqli_query($connection, $query);
                                // while ($data2 = mysqli_fetch_array($sql)) {
                                foreach ($sql as $catlist) {
                                    $k++;
                                    $kk = $catlist['pro_category'];
                                    $checked = [];
                                    if (isset($_GET['category'])) {

                                        $checked = $_GET['category'];
                                    }

                                ?>
                             <div class="input-checkbox">
                                 <input type="checkbox" id="category-<?= $k ?>" name="category[]"
                                     value="<?= $catlist['pro_category'] ?>"
                                     <?php if (in_array($catlist['pro_category'], $checked)) {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?> />
                                 <label for="category-<?= $k ?>">
                                     <span></span>
                                     <?= $catlist['pro_category'] ?>

                                     <?php
                                            $res = "SELECT SUM(qty)as tot_qty from products WHERE  pro_category='$kk'";
                                            $run = mysqli_query($connection, $res);
                                            while ($row = mysqli_fetch_array($run)) {



                                            ?>
                                     <small>(
                                         <?= $row['tot_qty'] ?>)&nbsp;&nbsp;Kg(s)
                                     </small>
                                     <?php } ?>
                                 </label>
                             </div>
                             <?php } ?>

                     </form>

                 </div>

             </div>
             <!-- /aside Widget -->

             <!-- aside Widget -->
             <div class="aside">
                 <h3 class="aside-title">Price</h3>
                 <div class="price-filter">
                     <div id="price-slider"></div>
                     <div class="input-number price-min">
                         <input id="price-min" type="number">
                         <span class="qty-up">+</span>
                         <span class="qty-down">-</span>
                     </div>
                     <span>-</span>
                     <div class="input-number price-max">
                         <input id="price-max" type="number">
                         <span class="qty-up">+</span>
                         <span class="qty-down">-</span>
                     </div>
                 </div>
             </div>
             <!-- /aside Widget -->

             <!-- aside Widget -->
             <!-- <div class="aside">
                     <h3 class="aside-title">Brand</h3>
                     <div class="checkbox-filter">
                         <div class="input-checkbox">
                             <input type="checkbox" id="brand-1">
                             <label for="brand-1">
                                 <span></span>
                                 RSB
                                 <small>(578)</small>
                             </label>
                         </div>
                     </div>
                 </div> -->
             <!-- /aside Widget -->

             <!-- aside Widget -->
             <div class="aside">
                 <h3 class="aside-title">Top selling</h3>
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
                                             orders.pr_id = products.pr_id AND orders.status = 'Received' LIMIT 4";
                    $sql = mysqli_query($connection, $query);
                    if (mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $uuid = $row['id'];


                    ?>
                 <div class="product-widget">
                     <div class="product-img">
                         <a href="single_product.php?id=<?= $row['pr_id'] ?>">
                             <img src="./Inventory/project_images/<?= $row['imag1'] ?>" alt=""
                                 style="height:1.5cm;width:100%;">

                         </a>

                     </div>
                     <div class="product-body">
                         <p class="product-category">Category:<strong
                                 class="text-info"><?= $row['product_name'] ?></strong></p>
                         <h3 class="product-name">Name:<a
                                 href="single_product.php?id=<?= $row['pr_id'] ?>"><?= $row['pro_category'] ?></a>
                         </h3>
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
                     </div>
                 </div>
                 <?php }
                    } ?>

             </div>
             <!-- /aside Widget -->
         </div>
         <!-- /ASIDE -->
         <!--product information modal-->

         <div class="modal fade" id="quick-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
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
         <!-- STORE -->
         <div id="store" class="col-md-9">
             <!-- store top filter -->
             <div class="store-filter clearfix">
                 <div class="store-sort">
                     <label>
                         Sort By:
                         <select class="input-select">
                             <option value="0">Popular</option>
                             <option value="1">Position</option>
                         </select>
                     </label>


                     <label>
                         <?php
                            if (isset($_POST['no_of_records_per_page'])) {
                                $no_of_records_per_page = $_POST['no_of_records_per_page'];
                            } else {
                                $no_of_records_per_page = 9;
                            } ?>
                         <form action="stock.php" id="form">
                             Show:
                             <select class="input-select" name="no_of_records_per_page" onchange="form.submit();">
                                 <option value="9" <?= $no_of_records_per_page == 9 ? "selected" : "" ?>>9
                                 </option>
                                 <option value="18" <?= $no_of_records_per_page == 18 ? "selected" : "" ?>>18
                                 </option>
                                 <option value="27" <?= $no_of_records_per_page == 27 ? "selected" : "" ?>>27
                                 </option>

                             </select>
                         </form>
                     </label>
                 </div>
                 <ul class="store-grid">
                     <li class="active"><i class="fa fa-th"></i></li>
                     <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                 </ul>
             </div>
             <!-- /store top filter -->

             <!-- store products -->

             <?php $recordcount = 0;
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                // $no_of_records_per_page = 9;

                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM products";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                if (isset($_GET['category'])) {
                    //echo "hello";
                    $ctgry = [];
                    $ctgry = $_GET['category'];
                    //var_dump($ctgry);
                    //echo $ctgry;
                    foreach ($ctgry as $cat) {
                        //echo $cat['category'];
                ?>
             <div class="row">
                 <?php
                            $query = "SELECT  * FROM products where pro_category='$cat'  ORDER BY add_date DESC LIMIT $offset, $no_of_records_per_page";
                            $sql = mysqli_query($connection, $query);
                            while ($data3 = mysqli_fetch_array($sql)) {
                                $id = $data3['pr_id'];
                                $uuid = $data3['id'];
                            ?>
                 <!-- product -->
                 <div class="col-md-4 col-xs-6">
                     <div class="product">
                         <div class="product-img">
                             <a href="single_product.php?id=<?= $data3['pr_id'] ?>">
                                 <img src="./Inventory/project_images/<?= $data3['imag1'] ?>" alt=""
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
                             <div class="product-label">

                                 <?php

                                                if (mysqli_num_rows($sql) < 3) {


                                                ?>
                                 <span class="sale">-30%</span>
                                 <span class="new">NEW</span>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="product-body">
                             <p class="product-category">
                                 Category:<strong class="text-info"><?= $data3['product_name'] ?></strong>
                             </p>
                             <h3 class="product-name">Name:<a
                                     href="single_product.php?id=<?= $data3['pr_id'] ?>"><?= $data3['pro_category'] ?></a>
                             </h3>

                             <h4 class=" product-price">
                                 <strong class=" ">quantity:</strong>
                                 <?php if ($data3['qty'] > 0) {
                                                    echo  $data3['qty'];
                                                    echo " " . "Kg";
                                                }
                                                ?>
                             </h4>


                             <!-- ################################### -->
                             <h4 class=" product-price">
                                 <strong class=" ">Price:</strong>
                                 <?php if ($data3['discount'] > 0) {

                                                    echo "Rwf" . " " . $data3['discount'];
                                                    echo ".00";
                                                } else {
                                                    echo "Rwf" . " " . $data3['unit_price'];
                                                    echo ".00";
                                                }

                                                ?> <del class="product-old-price">
                                     <?php if ($data3['discount'] > 0) {
                                                        echo  $data3['unit_price'];
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
                                 <!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
                                         to
                                         compare</span></button> -->
                                 <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"
                                         data-toggle="modal" data-target="#quick-view-modal"
                                         id="<?= $data3['pr_id'] ?>">quick
                                         view</span></button>
                             </div>
                         </div>
                         <div class="add-to-cart">
                             <button class="add-to-cart-btn"
                                 onclick="window.location.href='add_cart.php?id=<?php echo $data3['pr_id']; ?>'"><i
                                     class="fa fa-shopping-cart"></i>
                                 add to basket</button>
                         </div>
                     </div>
                 </div>
                 <!-- /product -->

                 <div class="clearfix visible-sm visible-xs"></div>
                 <!-- <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div> -->
                 <?php $recordcount++;
                                if ($recordcount % 3 == 0) { //start new row
                                ?>
             </div>
             <div class="row">
                 <?php
                                }
                            }
                            if ($recordcount % 3 != 0) // don't start new row 
                            { ?>
             </div>
             <?php }
                        }
                    } else { ?>

             <div class="row">
                 <?php
                        $query = "SELECT  * FROM products ORDER BY add_date ASC LIMIT $offset, $no_of_records_per_page";
                        $sql = mysqli_query($connection, $query);
                        while ($data3 = mysqli_fetch_array($sql)) {
                            $id = $data3['pr_id'];
                            $uuid = $data3['id']; ?>
                 <!-- product -->
                 <div class="col-md-4 col-xs-6">
                     <div class="product">
                         <div class="product-img">
                             <a href="single_product.php?id=<?= $data3['pr_id'] ?>">
                                 <img src="./Inventory/project_images/<?= $data3['imag1'] ?>" alt=""
                                     style="height:10cm;width:100%;" class="img-fluid img-responsive">
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
                             <div class="product-label">

                                 <?php

                                        if (mysqli_num_rows($sql) < 3) {


                                        ?>
                                 <span class="sale">-30%</span>
                                 <span class="new">NEW</span>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="product-body">
                             <p class="product-category">
                                 Category:<strong class="text-info"><?= $data3['product_name'] ?></strong>
                             </p>
                             <h3 class="product-name">Name:<a
                                     href="single_product.php?id=<?= $data3['pr_id'] ?>"><?= $data3['pro_category'] ?></a>
                             </h3>

                             <h4 class=" product-price">
                                 <strong class=" ">quantity:</strong>
                                 <?php if ($data3['qty'] > 0) {
                                            echo  $data3['qty'];
                                            echo " " . "Kg";
                                        }
                                        ?>
                             </h4>


                             <!-- ################################### -->
                             <h4 class=" product-price">
                                 <strong class=" ">Price:</strong>
                                 <?php if ($data3['discount'] > 0) {

                                            echo "Rwf" . " " . $data3['discount'];
                                            echo ".00";
                                        } else {
                                            echo "Rwf" . " " . $data3['unit_price'];
                                            echo ".00";
                                        }

                                        ?> <del class="product-old-price">
                                     <?php if ($data3['discount'] > 0) {
                                                echo  $data3['unit_price'];
                                                echo ".00";
                                            } ?>
                                 </del>
                             </h4>
                             <div class="product-rating">
                                 <?php

                                        $as = "select AVG(rating) AS avg from reviews where pr_id='$id' ";
                                        $runas = mysqli_query($connection, $as);
                                        $result = mysqli_fetch_array($runas);
                                        //$avg = $result['avg'];
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
                                         id="<?= $data3['pr_id'] ?>">quick
                                         view</span></button>
                             </div>
                         </div>
                         <div class="add-to-cart">
                             <button class="add-to-cart-btn"
                                 onclick="window.location.href='add_cart.php?id=<?php echo $data3['pr_id']; ?>'"><i
                                     class="fa fa-shopping-cart"></i>
                                 add to basket</button>
                         </div>
                     </div>
                 </div>
                 <!-- /product -->

                 <div class="clearfix visible-sm visible-xs"></div>
                 <!-- <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div> -->
                 <?php $recordcount++;
                            if ($recordcount % 3 == 0) { //start new row
                        ?>
             </div>
             <div class="row">
                 <?php
                            }
                        }
                        if ($recordcount % 3 != 0) // don't start new row 
                        { ?>
             </div>
             <?php }
                    } ?>
             <!-- /store products -->

             <!-- store bottom filter -->
             <div class="store-filter clearfix">
                 <span class="store-qty">Showing 20-100 products</span>
                 <ul class="store-pagination">


                     <li class="<?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?>"><a href="
                                 <?php if ($pageno <= 1) {
                                    } else {
                                        echo "stock.php?pageno=" . ($pageno - 1);
                                    } ?> ">
                             <!-- <i class="fa fa-angle-left"> -->
                             Prev
                         </a>
                     </li>
                     <?php

                for ($i = 1; $i <= $total_pages; $i++) {
                ?>
                     <li class="<?php if ($pageno == $i) {
                                echo 'active';
                            } ?>">
                         <a href="stock.php?pageno=<?= $i ?>"><?= $i ?></a>
                     </li>
                     <?php } ?>
                     <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?>">
                         <a href="<?php if ($pageno >= $total_pages) {
                                echo '#';
                            } else {
                                echo "stock.php?pageno=" . ($pageno + 1);
                            } ?>">
                             Next
                         </a>
                     </li>
                 </ul>
             </div>
             <!-- /store bottom filter -->
         </div>
         <!-- /STORE -->
     </div>
     <!-- /row -->
 </div>
 <!-- /container -->
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