<?php
require_once('../siteadmin/../includes/cnx.php');
//check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}



$user_phone = $_SESSION['phone_number'];
$user_number = $_SESSION['Id']; ?>
<?php

//echo "your user id is" . "" . $user_email;
include('../siteadmin/../includes/urlsheader.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        ../
        <!-- Preloader 
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/img/loading-icon-animated-gif-19.jpg" alt="loading image"
                height="60" width="60">
        </div>-->

        <!-- Navbar -->
        <?php
        include('../siteadmin/../includes/adminnavbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../siteadmin/../includes/adminsidebar.php');

        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php
            $count_row = 0;
            $sql2 = "select SUM(qty)  AS total FROM products";
            $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            while ($data1 = mysqli_fetch_array($run2)) {
                $count_row = $data1['total'];
            }

            // echo "now" . $now;
            // echo "<br>expire" . $_SESSION['expire'];
            //display total number of users
            $count_row1 = 0;
            $sql20 = "select COUNT(*) AS tot FROM users";
            $run20 = mysqli_query($connection, $sql20) or die(mysqli_error($connection));
            while ($data10 = mysqli_fetch_array($run20)) {
                $count_row1 = $data10['tot'];
            }
            ?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3> <?php if ($count_row1 > 0) {
                                                echo  $count_row1 . " " . "<span class='text-sm'>users</span>";
                                            } else {
                                                echo 0;
                                            }  ?></h3>

                                    <p>Total Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="allusers.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-dark">
                                <div class="inner">

                                    <h3>
                                        <?php if ($count_row > 0) {
                                            echo  $count_row . " " . "<span class='text-sm'>kg</span>";
                                        } else {
                                            echo 0;
                                        }  ?>
                                    </h3>
                                    <p>Total products</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        $sql = "SELECT
                                         SUM(orders.qty) AS totcas 
                                         
                                         
                                     FROM
                                         products,
                                         orders
                                         WHERE orders.pr_id = products.pr_id and orders.status='Received'";
                                        $runsql = mysqli_query($connection, $sql);

                                        while ($result = mysqli_fetch_array($runsql)) {
                                            $data = $result['totcas'];
                                        }
                                        echo $data . " " . "<span class='text-sm'>kg</span>";
                                        ?>
                                    </h3>

                                    <p>Total Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <a href="allsales.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">

                                    <h3>
                                        <?php
                                        $sql = "SELECT SUM(qty) as totcas FROM `products`  where pro_category='Cassava'";
                                        $runsql = mysqli_query($connection, $sql);

                                        while ($data = mysqli_fetch_array($runsql)) {

                                            $result0 = $data['totcas'];
                                        }
                                        echo $result0 . " " . "<span class='text-sm'>kg</span>";
                                        ?>
                                    </h3>

                                    <p>Cassava</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Small boxes2 (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3> <?php
                                            $sql = "SELECT SUM(qty) as totcas FROM `products`  where pro_category='Beans'";
                                            $runsql = mysqli_query($connection, $sql);

                                            while ($data = mysqli_fetch_array($runsql)) {

                                                $result0 = $data['totcas'];
                                            }
                                            echo $result0 . " " . "<span class='text-sm'>kg</span>";
                                            ?>
                                    </h3>

                                    <p>Beans</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-podcast" aria-hidden="true"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">

                                    <h3>
                                        <?php

                                        $sql0 = "SELECT SUM(qty) AS tot FROM products  WHERE pro_category='Rice' ";
                                        $runsql0 = mysqli_query($connection, $sql0);

                                        while ($data0 = mysqli_fetch_array($runsql0)) {

                                            $result0 = $data0['tot'];
                                        }
                                        echo $result0 . " " . "<span class='text-sm'>kg</span>";
                                        ?>
                                    </h3>
                                    <p>Rice</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        $sql = "SELECT SUM(qty) as totcas FROM `products`  where pro_category='Patotoes'";
                                        $runsql = mysqli_query($connection, $sql);

                                        while ($data = mysqli_fetch_array($runsql)) {

                                            $result0 = $data['totcas'];
                                        }
                                        echo $result0 . " " . "<span class='text-sm'>kg</span>";
                                        ?>
                                    </h3>

                                    <p>Potatoes</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <h3>
                                        <?php
                                        $sql = "SELECT SUM(qty) as totcas FROM `products`  where pro_category='Vegetables'";
                                        $runsql = mysqli_query($connection, $sql);

                                        while ($data = mysqli_fetch_array($runsql)) {

                                            $result0 = $data['totcas'];
                                        }
                                        echo $result0 . " " . "<span class='text-sm'>kg</span>";
                                        ?>
                                    </h3>

                                    <p>Vegetables and Fruits</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-free-code" aria-hidden="true"></i>
                                </div>
                                <a href="productlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->


                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Sales products</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div class="box box-info">

                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table no-margin">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>product name</th>
                                                            <th>Seller name</th>
                                                            <th>Buyer name</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total Price</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $i = 0;
                                                        $sql = "SELECT
                                                                orders.qty,
                                                                orders.order_date,
                                                                orders.unit_price,
                                                                products.pro_category,
                                                                customers.firstname,
                                                                users.lastname
                                                                
                                                                
                                                            FROM
                                                                users,
                                                                products,
                                                                customers,
                                                                orders
                                                                WHERE users.id=orders.id AND customers.customer_id=orders.customer_id AND orders.pr_id = products.pr_id AND orders.status='Received'";
                                                        $runsql = mysqli_query($connection, $sql);

                                                        while ($result = mysqli_fetch_array($runsql)) {
                                                            $i++;
                                                            $qty = $result['qty'];

                                                            //echo $data . " " . "<span class='text-sm'>kg</span>";
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td><?= $result['pro_category'] ?></td>
                                                            <td><span
                                                                    class="label label-success"><?= $result['lastname'] ?></span>
                                                            </td>
                                                            <td>
                                                                <?= $result['firstname'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result['qty'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result['unit_price'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result['unit_price'] * $result['qty'] ?>
                                                            </td>
                                                            <td>

                                                                <?= $result['order_date'] ?>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">

                                            <a href="allsales.php" class="btn btn-sm btn-default btn-flat pull-right"
                                                style="float:right;">View paid sales </a>
                                        </div>
                                        <!-- /.box-footer -->
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card card-secondary" style="margin-top:1cm;">
                                <div class=" card-header">
                                    <h3 class="card-title">Recently Joined Users or Customers</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div class="box box-info">

                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table no-margin">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Names</th>
                                                            <th>Telephone</th>
                                                            <th>Email</th>
                                                            <th>TIN</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        $qrty1 = "select * from users  ORDER BY joined_date DESC LIMIT 4";
                                                        $runqrty1 = mysqli_query($connection, $qrty1);
                                                        if (mysqli_num_rows($runqrty1) > 0) {
                                                            while ($result1 = mysqli_fetch_array($runqrty1)) {
                                                                $i++;
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>

                                                            </td>
                                                            <td><?= $result1['firstname'] ?>&nbsp;<?= $result1['lastname'] ?>
                                                            </td>
                                                            <td>
                                                                <span class="label label-success">
                                                                    <?= $result1['telphone'] ?></span>
                                                            </td>
                                                            <td>
                                                                <?= $result1['email'] ?>
                                                            </td>

                                                            <td>
                                                                <?= $result1['tin_number'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['district'] ?>,&nbsp;<?= $result1['sector'] ?>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='3' class='text-danger'>No User registered!</td></tr>";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">
                                            <?php
                                            $qrty2 = "select * from users  ORDER BY joined_date DESC LIMIT 4";
                                            $runqrty2 = mysqli_query($connection, $qrty2);
                                            if (mysqli_num_rows($runqrty2) > 0) {

                                            ?>
                                            <a href="allusers.php" class="btn btn-sm btn-default btn-flat pull-right"
                                                style="float:right;">View All Users
                                            </a>
                                            <?php } ?>
                                        </div>
                                        <!-- /.box-footer -->
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">

                            <!-- Map card -->
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Recently Purchased Products</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div class="box box-primary">
                                        <?php
                                        $qrty = "select * from products  ORDER BY add_date DESC LIMIT 4;";
                                        $runqrty = mysqli_query($connection, $qrty);
                                        if (mysqli_num_rows($runqrty) > 0) {
                                            while ($result = mysqli_fetch_array($runqrty)) {
                                        ?>
                                        <div class="box-body">
                                            <ul class="products-list product-list-in-box">

                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="../project_images/<?= $result['imag1'] ?>"
                                                            alt="Product Image">
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="javascript:void(0)" class="product-title">
                                                            <?= $result['product_name'] ?>
                                                            <span class="label label-warning pull-right text-dark"
                                                                style="float: right;">Kg
                                                                <?= $result['qty'] ?></span></a>
                                                        <span class="product-description">
                                                            <?= $result['description'] ?>
                                                        </span>
                                                        <span class="text-primary" style="float:right;">
                                                            <?= $result['add_date'] ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <?php
                                                } ?>
                                                <!-- /.item -->

                                            </ul>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <a href="productlist.php" class="uppercase">View All
                                                Products</a>
                                        </div>
                                        <!-- /.box-footer -->
                                        <?php

                                        } else {
                                            echo "No Recently Added Products";
                                        }
                                            ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php

        include('../siteadmin/../includes/urlsfooter.php');
        ?>