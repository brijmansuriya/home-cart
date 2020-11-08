<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("include_script.php"); ?>
    <!-- Title Page-->
    <title>Seller | Products</title>
    <style>
        .table-top-campaign tbody tr{
           
            align-items: baseline;
            
        }
    </style>

</head>
<body class="animsition">
    <div class="page-wrapper">
        
        <?php require_once("seller-navbar.php"); ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">
          
          <?php require_once("seller-header.php"); ?>

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="au-card m-b-30">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 m-b-40">Your Product Growth</h3>
                                            <canvas id="team-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="au-card m-b-30">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 m-b-40">Product & Operation</h3>
                                                <!-- TOP CAMPAIGN-->
                                                        <div class="table-responsive">
                                                            <table class="table table-top-campaign">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Total Stock</td>
                                                                        <td>23 Items</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Add New Product</td>
                                                                        <td> <a class="item" href="add-product.php" data-toggle="tooltip" data-placement="top" title="Add Product">
                                                                                <i class="zmdi zmdi-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Update Stock</td>
                                                                        <td> <button class="item" data-toggle="tooltip" data-placement="top" title="Update Stock">
                                                                                <i class="zmdi zmdi-edit"></i>
                                                                                </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                <h3 class="title-2 m-b-40">Your Most Recent Products</h3>
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>type</th>
                                                <th>description</th>
                                                <th>status</th>
                                                <th>price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                for($i = 0;$i < 5; $i++){                                                    
                                            ?>
                                                <tr>
                                                <td>2018-09-29 05:57</td>
                                                <td>Mobile</td>
                                                <td>iPhone X 64Gb Grey</td>
                                                <td class="process">Processed</td>
                                                <td>$999.00</td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                            <div class="row" style="margin-top: 15px;display:flex;justify-content:center;align-items: center;">
                                <div class="view-more-section">
                                    <button class="btn btn-primary">View More</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="copyright">
                                        <p>Copyright © 2019 Home Cart. All rights reserved.</p>
                                    </div>
                                </div>
                            </div>                      
                         </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php require_once("js-include.php"); ?>
</body>
</html>