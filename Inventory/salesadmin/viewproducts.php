<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
}
?>
<?php
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$user_email = $_SESSION['emailId'];
$user_id = $_SESSION['userId'];
include('../salesadmin/../includes/urlsheader.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include('../salesadmin/../includes/navbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include('../salesadmin/../includes/mainsidebar.php');
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
                                <li class="breadcrumb-item active">Item View </li>
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
                                    <h3 class="card-title text-info">LIST OF PRODUCTS IN STOCK</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 mb-3"> <a href=" addproducts.php"
                                                    class=" btn btn-primary">Add Item</a>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1"
                                                    class="table table-bordered table-responsive table-striped dataTable dtr-inline collapsed"
                                                    role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                No</th>
                                                            <th>
                                                                PID</th>
                                                            <th>
                                                                Category Name</th>
                                                            <th>
                                                                Product Name</th>
                                                            <th>
                                                                Quantity</th>
                                                            <th>
                                                                Unit Price</th>
                                                            <th>
                                                                Disccount</th>
                                                            <th>
                                                                Product Image</th>

                                                            <th> Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $count_row = 0;
                                                        $in = 0;
                                                        $sql2 = "select *  FROM products where id = '$user_id' ORDER BY add_date DESC ";
                                                        $run2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
                                                        while ($data1 = mysqli_fetch_array($run2)) {
                                                            $count_row++;
                                                            $img = $data1['imag1'];
                                                            $idd = $data1['pr_id']; ?>

                                                        <tr>
                                                            <td>
                                                                <?= $count_row ?>
                                                            </td>
                                                            <td>
                                                                <?= $idd ?>
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
                                                            <td><img src="../project_images/<?= $img ?>"
                                                                    alt="product-Image"
                                                                    style="width:150px;height:100px;">
                                                            </td>

                                                            <td class="project-actions text-right">
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
                                <input type="text" name="pro_name" id="pro-name" class="form-control" placeholder="...">
                            </div>

                            <div class="form-group">
                                <label> Category </label>
                                <input type="text" name="category" id="category" class="form-control" placeholder="...">
                            </div>

                            <div class="form-group">
                                <label> Quantity</label>
                                <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter qty">
                            </div>

                            <div class="form-group">
                                <label> Price </label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="price...">
                            </div>

                            <div class="form-group">
                                <label> Discount</label>
                                <input type="text" name="dis" id="dis" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label> Product Image</label>
                                <input type="file" name="img" id="img" class="form-control">
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
                $('#update_id').val(data[1]);
                $('#pro-name').val(data[2]);
                $('#category').val(data[3]);
                $('#qty').val(data[4]);
                $('#price').val(data[5]);
                $('#dis').val(data[6]);
                $('#img').val(data[7]);
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('table').DataTable();
        });
        </script>
        <?php

        include('../salesadmin/../includes/urlsfooter.php');
        ?>