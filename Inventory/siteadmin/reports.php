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
                            <h1 class="m-0">Sales Report</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Sales Report</li>
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
                                    <h3 class="card-title">Sales Reports</h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <!--date picker-->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-info text-white"
                                                                    id="basic-addon1"><i
                                                                        class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" id="start_date"
                                                                placeholder="Start Date" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-info text-white"
                                                                    id="basic-addon1"><i
                                                                        class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" id="end_date"
                                                                placeholder="End Date" readonly>
                                                            &nbsp;&nbsp;<div>
                                                                <button id="filter"
                                                                    class="btn btn-outline-info btn-sm">Filter</button>
                                                                <button id="reset"
                                                                    class="btn btn-outline-warning btn-sm">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!--/date picker -->
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
                                                                        Sales ID</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Engine version: activate to sort column ascending">
                                                                        Customer Name</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Engine version: activate to sort column ascending">
                                                                        Customer Phone</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Engine version: activate to sort column ascending">
                                                                        Customer Address</th>

                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Browser: activate to sort column ascending">
                                                                        Product Name</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Unit Price</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Quantity</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Amout Paid (Rwf)</th>

                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                                        aria-label="Engine version: activate to sort column ascending">
                                                                        Date Paid</th>

                                                                </tr>
                                                            </thead>


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

        <!--single script-->
        <script>
        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });
        </script>
        <script>
        // Fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "getrecords.php",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                dataType: "json",
                success: function(data) {
                    // Datatables
                    var i = "1";
                    $('#example1').DataTable({
                        "data": data,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        // responsive
                        "responsive": true,
                        "columns": [{
                                "data": "order_id",
                                "render": function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                "data": "order_id"
                            },
                            {
                                "data": "firstname"
                            },

                            {
                                "data": "telphone"
                            },
                            {
                                "data": "district"
                            },
                            {
                                "data": "product_name"
                            },
                            {
                                "data": "unit_price"
                            },
                            {
                                "data": "qty"
                            },
                            {
                                "data": "status",
                                "render": function(data, type, row, meta) {
                                    return `${row.unit_price *row.qty}`;
                                }
                            },
                            {
                                "data": "order_date",
                                "render": function(data, type, row, meta) {
                                    return moment(row.order_date).format('DD-MM-YYYY');
                                }
                            }
                        ]

                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                }
            });
        }
        fetch();
        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("both date required");
            } else {
                $('#example1').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });
        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#example1').DataTable().destroy();
            fetch();
        });
        </script>

        <!--DataTables & Plugins-->
        <script src="../plugins/datatables/jquery.dataTables.min.js">
        </script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
        </script>
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