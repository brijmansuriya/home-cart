<?php 
    include_once('script/server/Auth.php');
    $a = new Auth();
    $a->CommonRedirect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("include_script.php"); ?>
    <!-- Title Page-->
    <title>Administrator | Dashboard</title>
        
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
                                        <i class="zmdi zmdi-account-calendar"></i>Vendor Data</h3>
                                    <div class="filters m-b-45">
                                        <?php include("vendor-reg-form.php"); ?>
                                    </div>
                                    <div class="table-responsive table-data" style="background:white">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>Vendor Name</td>
                                                        <td>Contact No</td>
                                                        <td>Address</td>
                                                        <td>Pincode</td>
                                                        <td>Email</td>
                                                        <td>Owner Name</td>
                                                        <td>Blocked ?</td>
                                                        <td>Verify ?</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $data = mysqli_fetch_all($a->select('','v_disp_short_vendor'));
                                                        if(empty($data)){
                                                    ?>
                                                            <tr>
                                                                <td colspan="8">
                                                                    <h4>No Data To Show</h4>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                        else{
                                                            for($i=0;$i<count($data);$i++){  ?>                                                        
                                                    <tr>
                                                        <td>
                                                            <div class="table-data__info">
                                                                <h6>lori lynch</h6>
                                                                <span>
                                                                    <a href="#">johndoe@gmail.com</a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="role admin">admin</span>
                                                        </td>
                                                        <td>
                                                            <div class="rs-select2--trans rs-select2--sm">
                                                                <select class="js-select2 select2-hidden-accessible" name="property" aria-hidden="true">
                                                                    <option selected="selected">Full Control</option>
                                                                    <option value="">Post</option>
                                                                    <option value="">Watch</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="more">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">load more</button>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>                            
                        </div>
                    </div>
                </div>
            </section>

           <?php require_once("footer_data.php"); ?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
<?php require_once("bottom_include_script.php"); ?>
</body>
</html>
<script>
$(document).ready(function(e){
    $('#vendor_reg').on('submit',function(e){
        e.preventDefault();
        alert('ok');
        // var data = new FormData();
        // data.append('action','Revoke');
        // let r = new SiteGlobal();
        // r.Transaction('script/server/Auth.php','POST',data,'#logout');
    });
});
</script>