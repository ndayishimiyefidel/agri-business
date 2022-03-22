<?php
require_once('Inventory/includes/cnx.php');
if (isset($_GET['uid'])) {
    $id = $_GET['uid'];
    $f = "SELECT * FROM products where pr_id='$id'";
    $runf = mysqli_query($connection, $f);
    while ($data = mysqli_fetch_array($runf)) {
        $filename = $data['imag1'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 rounded-2" style="background-color:#fff;">
            <div class="panel">
                <div class="panel-body">
                    <div class="row"
                        style="border-top:1px solid #ccc;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc;">
                        <div class="col-md-6 mt-2">
                            <img style="max-height:6cm;width:100%;" src="./Inventory/project_images/<?= $filename ?>"
                                class="img-responsive img-fluid rounded-2" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <table class="table-responsive">
                                <tr>
                                    <td>Product Name:</td>
                                    <td><b><?= $data['product_name'] ?></b> </td>
                                </tr>
                                <tr>
                                    <td>Category:</td>
                                    <td><b><?= $data['pro_category'] ?></b> </td>
                                </tr>
                                <tr>
                                    <td>Avail.Quantity:</td>
                                    <td><b><?= $data['qty'] ?>&nbsp;Kg</b> </td>
                                </tr>
                                <tr>
                                    <td>Product Price:</td>
                                    <td><b>Rwandan Francs (RWF) <?= $data['unit_price'] ?>.00</b></td>
                                </tr>


                            </table>
                        </div>

                    </div>
                    <div class="h4 mt-4 pt-4 text-info">
                        Product or Item Description
                        <hr>
                    </div>
                    <p class="mb-4">

                        <?= $data['description'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
}