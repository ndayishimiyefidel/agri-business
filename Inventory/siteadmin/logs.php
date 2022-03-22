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
                            <h1 class="m-0">Logs or History</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Logs or History</li>
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
                                    <h3 class="card-title">Logs or History on products</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 float-start"> <a href="productlist.php"
                                                    class=" btn btn-primary mb-3">all purchase</a>
                                            </div>

                                        </div>
                                        <?php
                                        $count_row = 0;
                                        $sql2 = "select COUNT(*)  AS total FROM tbl_history";
                                        $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                                        while ($data1 = mysqli_fetch_array($run2)) {
                                            $count_row = $data1['total'];
                                        }
                                        if ($count_row > 0) {
                                        ?>
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

                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Category Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Product Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Quantity</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Unit Price</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Disccount</th>


                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Action Date</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Action happened</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                            $count_row = 0;
                                                            $in = 0;
                                                            $sql2 = "select 
                                                            DISTINCT (tbl_history.action_happened),
                                                            products.product_name,
                                                            products.pro_category,
                                                            tbl_history.qty,
                                                            tbl_history.pr_id,
                                                            tbl_history.unit_price,
                                                            tbl_history.discount,
                                                            tbl_history.action_date                   
                                                            FROM products,tbl_history 
                                                            where  products.pr_id=tbl_history.pr_id 
                                                            ORDER BY action_date DESC";
                                                            $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                                                            while ($data1 = mysqli_fetch_array($run2)) {
                                                                $count_row++;

                                                                $idd = $data1['pr_id']; ?>

                                                        <tr class="odd">
                                                            <td class="">
                                                                <?= $count_row ?>
                                                            </td>

                                                            <td class=""> <?= $data1['product_name'] ?></td>
                                                            <td class=""> <?= $data1['pro_category'] ?></td>
                                                            <td class=""><?= $data1['qty'] ?></td>
                                                            <td class=""> <?= $data1['unit_price'] ?></td>
                                                            <td class="">
                                                                <?php
                                                                        if ($data1['discount'] > 0) {
                                                                            echo  $data1['discount'];
                                                                        } else {
                                                                            echo 0;
                                                                        }

                                                                        ?></td>
                                                            <td class="project-actions text-right">
                                                                <?= $data1['action_date'] ?>
                                                            </td>
                                                            <td class="project-actions text-right">
                                                                <?php $act = $data1['action_happened'];
                                                                        if ($act == 'Ordered') {
                                                                            echo "<span class='btn btn-success'>$act</span>";
                                                                        } elseif ($act == 'Updated') {
                                                                            echo "<span class='btn btn-warning'>$act</span>";
                                                                        } elseif ($act == 'Uncancelled') {
                                                                            echo "<span class='btn btn-danger'>$act</span>";
                                                                        } elseif ($act == 'Added') {
                                                                            echo "<span class='btn btn-info'>$act</span>";
                                                                        }



                                                                        ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            } ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>

                                        <?php
                                        } ?>
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
        <!--javascript for updating project-->

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
        <script type="text/javascript">
        $(document).ready(function() {
            $('table').DataTable();
        });
        </script>
        <?php

        include('../siteadmin/../includes/urlsfooter.php');
        ?>