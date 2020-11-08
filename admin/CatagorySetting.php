<?php
    require_once('controller/AdminController.php');
    $site = new AdminController();
    //$asset->CommonRedirect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("model/HeaderScript.php"); ?>
    <title>Administrator | Categoty Settings</title>
    <style>
        .au-input--xl{
            margin-left:20px;
        }
        @media (max-width: 767px){
            .au-input--xl {
                min-width: 150px;
                margin-top: 20px;
                width: 70%;
            }
        }
        @media (max-width: 991px){
            .au-input--xl {
                min-width: 350px;
                margin-left: 20px;
                width: 410px;
            }
        }
        @media (max-width: 1600px){
            .au-input--xl {
                min-width: 350px;
                margin-left: 20px;
                width: 70%;
            }
        }
        .cat_icon{
            height : 35px;
            width : 35px;
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="err"></div>
                        <div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="user-data m-b-40">
                                <h3 class="title-3 m-b-30">
                                    <img src="assets/images/Tags_48px.png">  Main Catagories
                                </h3>
                                <div class="main_grid" style="">
                                    <div class="col-lg-6">
                                        <form action="#" enctype='multipart/form-data' method="post" class="" style="margin-left:30px;" id="frm_cat" name="frm_cat">
                                            <div class="form-group" id="cat_msg"></div>
                                            <div class="form-group">
                                                <label for="cat_name" class="pr-1  form-control-label">Catagory Name</label>
                                                <input type="text" id="cat_name" name="cat_name" placeholder=""  class="form-control" maxlength="20">
                                            </div>
                                            <div class="form-group">
                                                <label for="cat_desc" class="pr-1  form-control-label">Catagory Description</label>
                                                <textarea id="cat_desc" name="cat_desc" class="form-control" maxlength="250" rows="10"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="cat_img" class="pr-1  form-control-label">Catagory Image</label>
                                                <input type="file" id="cat_img" name="cat_desc" class="form-control">
                                            </div>
                                            <div class="form-group" ng-controller="Catagory">
                                                <label for="p_cat_drop_down" class="pr-1  form-control-label">Parent Catagory</label>
                                                <select class="form-control" id="p_cat_drop_down" name="p_cat_drop_down" ng-mode="parent_cat">
                                                </select>
                                            <div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <input type="hidden" name="save_data" id="save_data" value="add_cat">
                                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" name="btn_save_cat" type="submit">
                                                <i class="zmdi zmdi-plus"></i>add item</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class='col-lg-6' style="">
                                        <!-- <img src="assets/images/Tags_48px.png" height="100%" width="100%" alt="" srcset=""> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>Catagory Data
                                    <input class="au-input au-input--xl" id="cat_search" type="text" name="search" placeholder="Search for Catagory &amp; Description...">
                                </h3>
                                
                                <div class="table-responsive table-data">
                                    <table class="table" id="CatTableData">
                                                                            
                                    </table>
                                </div>
                                <div class="user-data__footer">
                                    <!-- <button class="au-btn au-btn-load">load more</button> -->
                                </div>
                            </div>
                            <!-- END USER DATA-->
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

           <?php require_once("model/FooterData.php"); ?>
    </div>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="card" style="margin-bottom:0">
                <div class="card-header">
                    <strong>Modify</strong> Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body card-block">
                   <?php require_once('view/UpdateCatagoryForm.php') ?>
                </div>
            </div>
		</div>
	</div>
</div>
<?php require_once("model/BottomScript.php"); ?>
</body>
</html>
<script src="controller/js/Catagory.js"></script>
