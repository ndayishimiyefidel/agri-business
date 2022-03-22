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
                            <h1 class="m-0">User List View </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">User List View </li>
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
                                    <h3 class="card-title">User List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1"
                                                    class="table table-bordered table-responsive table-striped">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Rendering engine: activate to sort column descending">
                                                                Customer ID</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Customer Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                Telephone</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Email Address</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Tin Number</th>
                                                            <!-- <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Password</th> -->
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Province</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                District</th>

                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Sector</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Cell</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Village</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Role</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        $qrty1 = "select * from users  ORDER BY joined_date DESC";
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
                                                                <?= $result1['province'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['district'] ?>
                                                            </td>

                                                            <td>
                                                                <?= $result1['sector'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['cell'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['village'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $result1['role'] ?>
                                                            </td>
                                                            <td>

                                                                &nbsp;

                                                                <?php
                                                                        if ($result1['status_code'] == 'Activated') {
                                                                        ?>
                                                                <a class="btn btn-success btn-sm"
                                                                    href="activate.php?id=<?= $result1['id'] ?>"
                                                                    id="<?= $result1['id'] ?>">
                                                                    <?php
                                                                            echo "<span class='text-light'>" .
                                                                                $result1['status_code'] . "</span>";
                                                                        } else if ($result1['status_code'] == "") {
                                                                            echo "<span class='text-info'>
                                                                            Activated
                                                                           </span>";
                                                                        } else {
                                                                            ?>
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="activate.php?id=<?= $result1['id'] ?>"
                                                                        id="<?= $result1['id'] ?>">
                                                                        <?php
                                                                                echo "<span class='text-light'>" .
                                                                                    $result1['status_code'] . "</span>";
                                                                            }
                                                                                ?>


                                                                    </a>
                                                            </td>

                                                            <td class="project-actions text-right" style="width:4cm;">

                                                                <a class="btn btn-warning btn-sm"
                                                                    href="suspend.php?id=<?= $result1['id'] ?>"
                                                                    id="<?= $result1['id'] ?>">
                                                                    <?php if ($result1['status'] == 1) { ?>
                                                                    <i class="fa fa-pause" aria-hidden="true"></i>
                                                                    <?php } else { ?>
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                </a>
                                                                &nbsp;<a class="btn btn-danger btn-sm"
                                                                    href="deluser.php?id=<?= $result1['id'] ?>"
                                                                    id="<?= $result1['id'] ?>">
                                                                    <i class="fas fa-trash ">
                                                                    </i>

                                                                </a>

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
        <script type="text/javascript">
        <?php

            include('../siteadmin/../includes/urlsfooter.php');
            ?>