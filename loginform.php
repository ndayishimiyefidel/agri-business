<?php
include("include/header.php");
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">User signin</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="registerform.php">Sign up</a>
                    </li>
                    <li class="active">user authentication form</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<div class="row">
    <div class="col-md-5" style="  float: none;
     margin-left: auto;
     margin-right: auto;">
        <div class="modal-header">
            <h4 class="modal-title text-center text-info" id="exampleModalToggleLabel">Customer Authentication form</h4>

        </div>
        <form method="post" action="processform.php">
            <div class="modal-body">
                <div class="card-body">

                    <div class=" form-group col-12">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="email" name="email" value="" class=" form-control" id="exampleInputEmail1"
                            placeholder="Enter username or email..." required>

                    </div>
                    <div class=" form-group col-12">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" value="" class=" form-control" id="exampleInputEmail1"
                            placeholder="Enter password...">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">

                    <button type="submit" name="signin1" class="btn btn-primary">Sign
                        In
                    </button>
                    <a href="#" class="text-danger" style="margin-left:50px;">Are you forget password ?
                    </a>
                    <br>Not Registered ?<a href=" registerform.php" class="text-primary ">Sign up
                    </a>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-7">

    </div>
</div>
<?php
include("include/footer.php");
?>