<?php 
    // Do Not Include The database File Here
    require_once("controller/Customer.php"); 
    $site = new Customer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once("model/HeaderScript.php"); ?>
    <!-- Title Page-->
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
    </style>    
</head>
<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php require_once("navbar.php"); ?>
        <!-- END MENU SIDEBAR-->
            <!-- STATISTIC-->
             <!-- MAIN CONTENT-->
             <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="au-card m-b-30">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 m-b-40"><?php printf($site->SITE_DATA['SITE_NAME']) ?> | Customer Growth</h3>
                                            <canvas id="team-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- DATA TABLE -->
                                    <div id="CustomerTable">   
                                    </div>                                  
                                   
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;display:flex;justify-content:center;align-items: center;">
                                <div class="view-more-section">
                                    <button class="btn btn-primary">View More</button>
                                </div>
                            </div>
                                               
                         </div>
                        </div>
                    </div>
                </div>

                <?php require_once("model/FooterData.php"); ?>
            <!-- END PAGE CONTAINER-->
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
                    <form action="#" method="post" class="" id="frm_mod">
                        <div class="form-group">
                            <label for="_e_cat_nm" class="form-control-label">Category</label>
                            <input type="text" id="_e_cat_nm" name="_e_cat_nm" class="form-control" maxlength="20" />
                            <!-- <span class="help-block">Please enter your email</span> -->
                        </div>
                        <div class="form-group">
                            <label for="_e_cat_desc" class="form-control-label">Description</label>
                            <input type="text" id="_e_cat_desc" name="_e_cat_desc" class="form-control" maxlength="50" />
                            <!-- <span class="help-block">Please enter your email</span> -->
                        </div>
                        <!-- <div class="form-group">
                            <label for="_e_p_cat_drop_down" class="form-control-label">Parent Catagory</label>
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" id="_e_p_cat_drop_down" name="_e_p_cat_drop_down">
                                    
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        <div> -->
                        <div class="form-group">
                            <div id="mod_err">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                            <button type="button" class="btn btn-danger btn-md" id="btn_del">
                                <i class="fa fa-ban"></i> Delete
                            </button>
                            <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">
                            <span aria-hidden="true">×</span> Close
                            </button>
                        </div>
                        <div class="form-group">
                            <div id="mod_p_cat_war">
                                <span>Note :</span>
                                <div class='sufee-alert alert with-close alert-warning' alert-dismissible fade show'><span class='badge badge-pill badge-warning''>Parent Category</span>&nbsp;&nbsp;Not Be Updated
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="mod_p_cat_war">
                                <div class='sufee-alert alert with-close alert-warning' alert-dismissible fade show'><span class='badge badge-pill badge-warning''>Category Delete Action</span>&nbsp;&nbsp;When You Delete Any Category Then It Will Delete The Sub-category And Product Releted That Category.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
<?php require_once("model/BottomScript.php"); ?>
</body>
</html>
<!-- end document-->
<script type="text/javascript">
	$(document).ready(function(){
		load_data(1);  
        function load_data(page)  
        {  
            console.log(page);
            var data = new FormData();
            data.append('page',page);
            data.append('action','CustomerTable')
            $.ajax({  
                    url:"controller/Customer.php",  
                    type:"POST",  
                    data:data,
                    processData : false,
                    contentType : false,
                    cache : false,
                    async : false,
                    success:function(data){  
                        $('#CustomerTable').html(data);  
                    }  
            })  
        }  
        $(document).on('click', '.pagination_link', function(){  
            var page = $(this).attr("id");  
            load_data(page);  
        });  
	})
</script>
