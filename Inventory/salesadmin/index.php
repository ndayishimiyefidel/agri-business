<?php
require_once('../salesadmin/../includes/cnx.php');
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



$user_email = $_SESSION['emailId'];
$user_id = $_SESSION['userId']; ?>
<?php

//echo "your user id is" . "" . $user_email;
include('../salesadmin/../includes/urlsheader.php');
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
        include('../salesadmin/../includes/navbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../salesadmin/../includes/mainsidebar.php');

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
            $sql2 = "select COUNT(*)  AS total FROM products where id = '$user_id' ";
            $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            while ($data1 = mysqli_fetch_array($run2)) {
                $count_row = $data1['total'];
            }

            // echo "now" . $now;
            // echo "<br>expire" . $_SESSION['expire'];
            $count_row1 = 0;
            $sql20 = "select COUNT(*) AS tot FROM orders where id = '$user_id' and status='Received' ";
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
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> <?php if ($count_row1 > 0) {
                                                echo  $count_row1;
                                            } else {
                                                echo 0;
                                            }  ?></h3>

                                    <p>Total paid orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="completedorders.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <h3>
                                        <?php if ($count_row > 0) {
                                            echo  $count_row;
                                        } else {
                                            echo 0;
                                        }  ?>
                                    </h3>
                                    <p>Total products</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="viewproducts.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        $sql = "SELECT DISTINCT (customers.firstname)
                                                FROM customers ,orders  
                                                where customers.customer_id=orders.customer_id and orders.id='$user_id';";
                                        $runsql = mysqli_query($connection, $sql);

                                        $data = mysqli_num_rows($runsql);
                                        echo $data;
                                        ?>
                                    </h3>

                                    <p>Total Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <a href="viewcustomers.php" class="small-box-footer">More info <i
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

                                        $sql = "SELECT * FROM `orders`  where id='$user_id' and (status='Pending' OR status='Cancelled' OR status='Expired')";
                                        $runsql = mysqli_query($connection, $sql);

                                        $data = mysqli_num_rows($runsql);
                                        echo $data;
                                        ?>
                                    </h3>

                                    <p>Total Pending orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <a href="pendingorders.php" class="small-box-footer">More info <i
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


                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Latest paid orders</h3>

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
                                        <?php
                                        $query = "SELECT
                                                         customers.firstname,
                                                         customers.lastname,
                                                         products.product_name,
                                                         orders.order_id,
                                                         orders.unit_price,
                                                         orders.qty
                                                        
                                                     FROM
                                                         customers,
                                                         products,
                                                         orders
                                                     WHERE
                                                         orders.id = '$user_id' AND orders.customer_id = customers.customer_id AND orders.pr_id = products.pr_id AND orders.status = 'Received'";
                                        $sql = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($sql) > 0) {
                                        ?>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table no-margin">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Customer Names</th>
                                                            <th>Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Total Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['order_id'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['firstname'] . " " . " " . $row['lastname'] ?>
                                                            </td>
                                                            <td><?= $row['product_name'] ?></td>
                                                            <td><span
                                                                    class="label label-success"><?= $row['qty'] ?></span>
                                                            </td>
                                                            <td>
                                                                <?= $row['unit_price'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['qty'] * $row['unit_price'] ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">

                                            <a href="completedorders.php"
                                                class="btn btn-sm btn-default btn-flat pull-right"
                                                style="float:right;">View paid order </a>
                                        </div>
                                        <?php
                                        } else {
                                            echo "<span class='text-danger text-md'>No Recent yet paid orders</span>";
                                        }
                                        ?>

                                        <!-- /.box-footer -->
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card card-secondary" style="margin-top:1cm;">
                                <div class=" card-header">
                                    <h3 class="card-title">Recently Pending Orders</h3>

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
                                                            <th>Item ID</th>
                                                            <th>Item/Product</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total Price</th>
                                                            <th>Order Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $qrty1 = "select * from products,orders where products.pr_id=orders.pr_id and orders.id='$user_id' and orders.status='Pending' ORDER BY order_date DESC LIMIT 4;";
                                                        $runqrty1 = mysqli_query($connection, $qrty1);
                                                        if (mysqli_num_rows($runqrty1) > 0) {
                                                            while ($result1 = mysqli_fetch_array($runqrty1)) {
                                                        ?>
                                                        <tr>
                                                            <td><a href="pages/examples/invoice.html">
                                                                    <?= $result1['order_id'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $result1['product_name'] ?></td>
                                                            <td>
                                                                <span class="label label-success">
                                                                    <?= $result1['qty'] ?></span>
                                                            </td>
                                                            <td>
                                                                <?= $result1['unit_price'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['qty'] * $result1['unit_price'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['order_date'] ?>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='3' class='text-danger'>No order recently placed</td></tr>";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">
                                            <?php
                                            $qrty2 = "select * from products,orders where products.pr_id=orders.pr_id and orders.id='$user_id' and orders.status='Pending' ORDER BY order_date DESC LIMIT 4;";
                                            $runqrty2 = mysqli_query($connection, $qrty2);
                                            if (mysqli_num_rows($runqrty2) > 0) {

                                            ?>
                                            <a href="pendingorders.php"
                                                class="btn btn-sm btn-default btn-flat pull-right"
                                                style="float:right;">View All orders
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
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Recently Added Products</h3>

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
                                        $qrty = "select * from products where id='$user_id' ORDER BY add_date DESC LIMIT 4;";
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
                                            <a href="viewproducts.php" class="uppercase">View All
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

        include('../salesadmin/../includes/urlsfooter.php');
        ?>