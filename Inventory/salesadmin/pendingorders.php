<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>
alert('Plz , Login first !')
</script>";
    echo "<script>
window.location.href = '../index.php';
</script>";
} ?><?php
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<script>alert('Your session have been expired,login again')</script>";
        echo  "<script>window.location.href = '../index.php';</script>";
    }
    include('../salesadmin/../includes/urlsheader.php');
    ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader 
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/loading-icon-animated-gif-19.jpg" alt="loading image"
                height="60" width="60">
        </div>-->

        <!-- Navbar -->
        <?php
        $user_email = $_SESSION['emailId'];
        $user_id = $_SESSION['userId'];
        include('../salesadmin/../includes/navbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../salesadmin/../includes/mainsidebar.php');

        // echo 'your user id'.$user_id;
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pending Orders </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Pending orders</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pending Orders Lists</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1"
                                                    class="table table-bordered table-responsive table-striped dataTable dtr-inline collapsed"
                                                    role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Rendering engine: activate to sort column descending">
                                                                No</th>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Rendering engine: activate to sort column descending">
                                                                Order ID</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Customer Name</th>

                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Product Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Unit Price</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Quantity</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Amout to be Paid (Rwf)</th>

                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Order Date</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <?php



                                                    $xy = 0;
                                                    $jointables =
                                                        "SELECT
                                                    customers.firstname,
                                                    customers.lastname,
                                                    products.product_name,
                                                    orders.qty,
                                                    orders.order_id,
                                                    orders.unit_price,
                                                    orders.order_date,
                                                    orders.status
                                                FROM
                                                    customers,
                                                    products,
                                                    orders
                                                WHERE
                                                    orders.id = '$user_id' AND orders.customer_id = customers.customer_id AND orders.pr_id = products.pr_id 
                                                    AND (orders.status='Cancelled' OR orders.status='Pending' OR orders.status='Expired')";

                                                    $qwe = mysqli_query($connection, $jointables);
                                                    while ($power = mysqli_fetch_array($qwe)) {
                                                        $xy++;
                                                    ?>

                                                    <tbody>
                                                        <tr class="odd">
                                                            <td><?= $xy ?></td>
                                                            <td><?= $power['order_id'] ?></td>
                                                            <td class="">
                                                                <?= $power['firstname'] . " " . $power['lastname'] ?>
                                                            </td>
                                                            </td>

                                                            <td class=""><?= $power['product_name'] ?></td>
                                                            <td class=""><?= $power['unit_price'] ?></td>
                                                            <td class=""><?= $power['qty'] ?></td>
                                                            <td class="">
                                                                <?= $power['qty'] * $power['unit_price'] ?></td>

                                                            <td class=""><?= $power['order_date'] ?></td>
                                                            <td class=""><?= $power['status'] ?></td>
                                                            <td class="project-actions text-right">
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="cancelorder.php?id=<?= $power['order_id'] ?>">
                                                                    <i class="fa fa-times-circle"
                                                                        aria-hidden="true"></i>
                                                                </a>&nbsp;<a class="btn btn-success btn-sm"
                                                                    href="confirmorder.php?id=<?= $power['order_id'] ?>">
                                                                    <i class="fa fa-check-square"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            </td>

                                                    </tbody>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        </script>
        <!-- DataTables  & Plugins -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/jszip/jszip.min.js"></script>
        <script src="../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- DataTables -->
        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <?php

        include('../salesadmin/../includes/urlsfooter.php');
        ?>