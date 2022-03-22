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
                            <h1 class="m-0">Product List </h1>
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
                                    <h3 class="card-title text-info">Product List In Stock</h3>

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
                                                <table class="table table-striped table-bordered table-reponsive"
                                                    id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                No</th>

                                                            <th>
                                                                Category Name</th>
                                                            <th>
                                                                Product Name</th>
                                                            <th>
                                                                Quantity (kgs)</th>
                                                            <th>
                                                                Unit Price (Rwf)</th>
                                                            <th>
                                                                Discount (Rwf)</th>
                                                            <th>
                                                                Product Owner</th>
                                                            <th>
                                                                Purchased date</th>

                                                            <th> Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $count_row = 0;
                                                        $in = 0;
                                                        $sql2 = "select *  FROM users, products where users.id=products.id";
                                                        $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                                                        while ($data1 = mysqli_fetch_array($run2)) {
                                                            $count_row++;
                                                            $img = $data1['imag1'];
                                                            $idd = $data1['pr_id'];
                                                            $id = $data1['id'];
                                                        ?>


                                                        <tr>
                                                            <td>
                                                                <?= $count_row ?>
                                                            </td>

                                                            <td> <?= $data1['product_name'] ?></td>
                                                            <td> <?= $data1['pro_category'] ?></td>
                                                            <td><?= $data1['qty'] ?></td>
                                                            <td> <?= $data1['unit_price'] ?></td>
                                                            <td>
                                                                <?php
                                                                    if ($data1['discount'] > 0) {
                                                                        echo  $data1['discount'];
                                                                    } else {
                                                                        echo 0;
                                                                    }

                                                                    ?></td>
                                                            <td><a href="#" id="<?php echo $data1['pr_id']; ?>"
                                                                    class="view_data"><?= $data1['firstname'] ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php $original_date = $data1['add_date'];
                                                                    // Creating timestamp from given date
                                                                    $timestamp = strtotime($original_date);
                                                                    // Creating new date format from that timestamp
                                                                    $new_date = date("d-m-Y", $timestamp);
                                                                    echo $new_date; ?>
                                                            </td>
                                                            <td class=" project-actions text-right">
                                                                <button class="btn btn-info btn-sm editbtn"> <i
                                                                        class="fas fa-pencil-alt">
                                                                    </i>
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
        <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Product Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="editpro.php" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input type="hidden" name="inc_id" id="inc_id">
                            <input type="hidden" name="update_id" id="update_id">

                            <div class="form-group">
                                <label> Product Name</label>
                                <input type="text" name="pro_name" id="pro-name" class="form-control" placeholder="..."
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label> Category </label>
                                <input type="text" name="category" id="category" class="form-control" placeholder="..."
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label> Quantity</label>
                                <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter qty">
                            </div>

                            <div class="form-group">
                                <label> Price </label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="price...">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="updatedata" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Content Wrapper. Contains page content -->
        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Product or item owner information</h4>
                    </div>
                    <div class="modal-body" id="user_detail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('.view_data').click(function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "select.php",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    success: function(data) {
                        $('#user_detail').html(data);
                        $('#dataModal').modal("show");
                    }
                });
            });
        });
        </script>

        <script>
        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#inc_id').val(data[0]);
                // $('#update_id').val(data[1]);
                $('#pro-name').val(data[1]);
                $('#category').val(data[2]);
                $('#qty').val(data[3]);
                $('#price').val(data[4]);


            });
        });
        </script>
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