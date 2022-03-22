<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>alert('Plz , Login first !')</script>";
    echo "<script>window.location.href = '../index.php';</script>";
} ?>

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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add Item/Prodcuts </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Item/Prodcuts </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Add new product/Item</h3>
                                        </div>

                                        <!-- /.card-header -->
                                        <div class="card-body">

                                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <form action="addpro.php" method="post"
                                                            enctype="multipart/form-data"
                                                            style="padding:1rem;
                                                                    background-color:#fff;margin:1rem;border-radius:5px;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <select class="custom-select rounded-0"
                                                                            name="ctgry" id="ctgry"
                                                                            onchange="populate(this.id,'prodname')">
                                                                            <option value="">Select Product Name---
                                                                            </option>
                                                                            <option value="Beans">Beans</option>
                                                                            <option value="Rice">Rice</option>
                                                                            <option value="Patotoes">Patotoes</option>
                                                                            <option value="Cassava">Cassava</option>
                                                                            <option value="Vegetables">Vegetables &
                                                                                Fruit</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-6">
                                                                    <div class="input-group mb-3 ">
                                                                        <select class="custom-select rounded-0"
                                                                            name="prodname" id="prodname"
                                                                            onchange="display()">
                                                                            <option value="">Select Product category --
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            name="other-products" id="showtext"
                                                                            placeholder="name of product not listed"
                                                                            style="display:none;">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <select class="custom-select rounded-0"
                                                                            name="season" id="">
                                                                            <option selected disabled> Select Season
                                                                            </option>
                                                                            <option>A</option>
                                                                            <option>B</option>
                                                                            <option>C</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <input type="date" class="form-control"
                                                                            name="date" placeholder="dd-mm-yyyy"
                                                                            required>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3 ">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Product quantity in kg..."
                                                                            name="product_qty" required>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Unit price..." name="price"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <input type="file" class="form-control"
                                                                            name="imag1" required>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <textarea name="description"
                                                                    placeholder=" Type Product description ...."
                                                                    class="form-control" style="height:5cm;"></textarea>
                                                            </div>

                                                            <div class="row">

                                                                <!-- /.col -->

                                                                <div class="col-md-12">
                                                                    <button type="submit" name="add"
                                                                        class="btn btn-primary btn-md"
                                                                        style="float:right;">Add
                                                                        product</button>
                                                                </div>

                                                                <!-- /.col -->
                                                            </div>
                                                        </form>
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
                    <!-- </div> -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->

        </div>
        <!-- /.content-wrapper -->

        <script>
        function populate(s1, s2) {
            var s1 = document.getElementById(s1)
            var s2 = document.getElementById(s2)
            s2.innerHTML = "";
            if (s1.value == "Beans") {
                var optionArray = ['amajoni|Amajoni', 'shyushya|Shyushya',
                    'cooperative|Cooperative', 'others|Others'
                ];
            } else if (s1.value == "Rice") {
                var optionArray = ['buryohe|Buryohe', 'uni|Uni', 'others|Others'];
            } else if (s1.value == "Patotoes") {
                var optionArray = ['kinigi|Kinigi', 'ibyumweru|Ibyumweru',
                    'others|Others'
                ];
            } else if (s1.value == "Cassava") {
                var optionArray = ['dryler|Dryler', 'flesh|Flesh',
                    'flavour|Flavour', 'others|Others'
                ];
            } else if (s1.value == "Vegetables") {
                var optionArray = ['carrot|Carrot', 'imbwija|Imbwija',
                    'orange|Orange', 'others|Others'
                ];
            }
            for (var option in optionArray) {

                var pair = optionArray[option].split("|");
                var newoption = document.createElement("option");
                newoption.value = pair[0];
                newoption.innerHTML = pair[1];
                s2.options.add(newoption);


            }


        }

        function display() {
            var e = document.getElementById("prodname");
            var value = e.options[e.selectedIndex].text;
            //var index = e.selectedIndex;
            if (value == 'Others') {
                document.getElementById("showtext").style.display = 'block'

            } else if (value != 'Others') {
                document.getElementById("showtext").style.display = 'none'

            }
        }
        </script>

        <?php
        include('../salesadmin/../includes/urlsfooter.php');
        ?>