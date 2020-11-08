<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("include_script.php"); ?>
    <!-- Title Page-->
    <title>Seller | Customer</title>
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
                                            <h3 class="title-2 m-b-40">Home Cart | Customer Growth</h3>
                                            <canvas id="team-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- DATA TABLE -->
                                    <h3 class="title-5 m-b-35">Most Recent Customers</h3>
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2">
                                            <thead>
                                                <tr>
                                                    <th>name</th>
                                                    <th>email</th>
                                                    <th>description</th>
                                                    <th>date</th>
                                                    <th>location</th>
                                                    <th>verified ?</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                for($i = 0;$i < 5; $i++){                                                    
                                            ?>
                                                    <tr class="tr-shadow">
                                                    <td>Lori Lynch</td>
                                                        <td>
                                                            <span class="block-email">lori@example.com</span>
                                                        </td>
                                                        <td class="desc">Short description</td>
                                                        <td>2018-09-27 02:12</td>
                                                        <td>
                                                            <span class="status--process">India</span>
                                                        </td>
                                                        <td>Yes</td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>                                                      
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="spacer"></tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END DATA TABLE -->
                                   
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