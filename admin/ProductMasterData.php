<?php 
    include_once('controller/Functional.php');
    $asset = new Assets();
    //$a->CommonRedirect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("model/HeaderScript.php"); ?>
    <!-- Title Page-->
    <title>Product Master Data</title>
    <style>
        .table-data {
            height : 90%;
        }
        @media (min-width: 992px){
            .modal-lg {
            max-width: 80%;
            }
        }
    </style>
</head>
<body class="animsition">
    <div class="page-wrapper">
        <?php require_once("navbar.php"); ?>
        <section class="statistic m-t-75">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
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
        </section>
        <div class="row" style="margin-top: 15px;display:flex;justify-content:center;align-items: center;">
                <div class="view-more-section" id='pagination_product'>
                </div>
            </div>
    </div>
    <?php require_once("model/FooterData.php"); ?>
    
    <?php require_once('view/ProductS1Form.php'); ?>
    
    <?php require_once('view/SuperSubProductForm.php'); ?>


    <?php require_once('view/ProductS2Form.php'); ?>           
    
<?php require_once("model/BottomScript.php"); ?>
</body>
</html>

<script src="controller/js/ProductManage.js"></script>