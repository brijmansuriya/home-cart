<?php 
    include_once('controller/Functional.php');
    $site = new Assets();
   // $a->CommonRedirect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("model/HeaderScript.php"); ?>
    <title>Administrator | Product Manager</title>
    <style>
        @media (min-width: 992px){
            .modal-lg {
            max-width: 80%;
            }
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php require_once("navbar.php"); ?>
        <!-- END MENU SIDEBAR-->
            <!-- STATISTIC-->
            <section class="statistic m-t-75">
                <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="user-data m-b-40">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Host New Product
                                    </h3>
                                    <div class="filters m-b-45">
                                        <div class="navbar-sidebar2">
                                            <ul class="list-unstyled navbar__list">   
                                                <?php include_once('view/BrandForm.php'); ?>     
                                                <li class="has-sub">
                                                    <a class="js-arrow" href="#" data-toggle='modal' onclick='Clears1ProductForm()' data-target='#product_s1model'>
                                                        <i class="fas fa-plus"></i>Register New Product
                                                        <span class="arrow">
                                                            <i class="fas fa-angle-down"></i>
                                                        </span>
                                                    </a>
                                                </li>                
                                            </ul>    
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-data" style="background:white">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Product Name & Code</td>
                                                <td>Catagory</td>
                                                <td>Product Brand</td>
                                                <td>Tax Slab</td>
                                                <td>Short Desciption</td>
                                                <td>View & Edit</td>
                                            </tr>
                                        </thead>
                                        <tbody id="s1_product_short_tbl">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row" style="margin-top: 15px;display:flex;justify-content:center;align-items: center;">
                <div class="view-more-section">
                    <a class="btn btn-primary" href='ProductMasterData.php'>View More</a>
                </div>
            </div>

           <?php require_once("model/FooterData.php"); ?>
        </div>

    </div>
   
    <?php require_once('view/ProductS1Form.php'); ?>
    
    <?php require_once('view/ProductS2Form.php'); ?>
                  
    <?php require_once('view/SuperSubProductForm.php'); ?>
    
    <?php require_once('view/UpdateBrandForm.php'); ?>
                                               
    <?php require_once("model/BottomScript.php"); ?>
    
</body>
</html>
<script src="controller/js/ProductManage.js"></script>
