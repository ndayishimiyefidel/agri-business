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


        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Item View </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Product List </li>
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
                                    <h3 class="card-title text-info">LIST OF ITEMS IN STOCK</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 mb-3"> <a href="clear.php"
                                                    class=" btn btn-warning">Clear All</a>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered table-responsive"
                                                    id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                No</th>

                                                            <th>
                                                                Order ID</th>
                                                            <th>
                                                                Seller Name</th>
                                                            <th>
                                                                buyer Name</th>
                                                            <th>Buyer Phone
                                                            </th>

                                                            <th>
                                                                Buyer Address</th>
                                                            <th>
                                                                Product Name</th>
                                                            <th>
                                                                Quantity (kgs)</th>
                                                            <th>
                                                                Unit Price (Rwf)</th>
                                                            <th>
                                                                Amount Paid (Rwf)</th>

                                                            <th>
                                                                Date Paid</th>
                                                            <th>
                                                                Status</th>

                                                            <th>
                                                                Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $query = "SELECT
                                                            users.firstname,
                                                            customers.lastname,
                                                            customers.telphone,
                                                            customers.district,
                                                            products.product_name,
                                                            orders.order_id,
                                                            products.pr_id,
                                                            orders.unit_price,
                                                            orders.qty,
                                                            orders.order_date,
                                                            orders.status
                                                        FROM
                                                            users,
                                                            customers,
                                                            products,
                                                            orders
                                                        WHERE
                                                           users.id=orders.id AND orders.customer_id = customers.customer_id AND orders.pr_id = products.pr_id AND orders.status = 'Received'";
                                                        $x = 0;

                                                        $sum = 0;
                                                        $sql = mysqli_query($connection, $query);
                                                        while ($data1 = mysqli_fetch_array($sql)) {
                                                            $x++;
                                                            $sum = $sum + ($data1['unit_price'] * $data1['qty']);
                                                        ?>


                                                        <tr>
                                                            <td>
                                                                <?= $x ?>
                                                            </td>
                                                            <td> <?= $data1['order_id'] ?></td>
                                                            <td>
                                                                <?= $data1['firstname'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $data1['lastname'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $data1['telphone'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $data1['district'] ?>
                                                            </td>
                                                            <td> <?= $data1['product_name'] ?></td>

                                                            <td><?= $data1['qty'] ?></td>
                                                            <td> <?= $data1['unit_price'] ?></td>
                                                            <td> <?= $data1['qty'] * $data1['unit_price'] ?></td>
                                                            <td>
                                                                <?php $original_date = $data1['order_date'];
                                                                    // Creating timestamp from given date
                                                                    $timestamp = strtotime($original_date);
                                                                    // Creating new date format from that timestamp
                                                                    $new_date = date("d-m-Y", $timestamp);
                                                                    echo $new_date; ?>
                                                            </td>
                                                            <td>
                                                                <?php $act = $data1['status'];
                                                                    if ($act == 'Received') {
                                                                        echo "<span class='btn btn-success'>$act</span>";
                                                                    } elseif ($act == 'Pending') {
                                                                        echo "<span class='btn btn-warning'>$act</span>";
                                                                    }



                                                                    ?>

                                                            </td>

                                                            <td class=" project-actions text-right">
                                                                <button class="btn btn-success btn-sm editbtn"
                                                                    onclick="window.location.href='viewinvoice.php'">
                                                                    <i class=" fa fa-eye" aria-hidden="true"></i>
                                                                </button>

                                                                <a class="btn btn-danger btn-sm"
                                                                    href="delproduct.php?id=<?= $data1['pr_id'] ?>"
                                                                    id="<?= $data1['pr_id'] ?>">
                                                                    <i class="fas fa-trash">
                                                                    </i>

                                                                </a>
                                                            </td>


                                                        </tr>
                                                        <?php

                                                        } ?>
                                                    </tbody>

                                                    <tr>
                                                        <td colspan="2" style="text-align:center;font-weight:bold;">
                                                            Total Amount:
                                                        </td>
                                                        <td colspan="7" style="text-align:center"></td>
                                                        <td colspan="1" style="text-align:center"> <?= $sum ?></td>
                                                    </tr>

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
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->


        <?php

        include('../salesadmin/../includes/urlsfooter.php');
        ?>