<?php
   require_once("controller/AdminController.php"); 
   $asset  = new AdminController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once("model/HeaderScript.php"); ?>
    <!-- Title Page-->
    <title>Seller | Dashboard</title>    
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php if($site->SITE_STATUS){require_once("navbar.php");} ?>
        <!-- END MENU SIDEBAR-->
            <section class="statistic m-t-60">
                <div class="container-fluid">
                    <div class="col-lg-12" id="pg_err"></div>
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fa fa-gear"></i>Site Settings <?php if(!$site->SITE_STATUS){ printf(": First Time Configuration"); } ?>
                            </h3>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-info"></i>Site Information
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                                <?php include_once("site-setting-form.php"); ?> 
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-info"></i>Update Profile Picture
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                            <div class="card">
                                                    <div class="card-header">
                                                        <strong>Update</strong>
                                                        <small> Profile Image</small>
                                                    </div>
                                                    <form action="#" id="frm_save_profile_pic" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                                <div class="card-body card-block">
                                                                    <div class="form-group" id="save_profile_err">
                                                                    </div>
                                                                    <div class="form-group" id="extra_attr">
                                                                    </div>
                                                                <div class="form-group">
                                                                    <label for="profile_picture" class=" form-control-label">Select Profile Picture</label>
                                                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control"> 
                                                                </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-refresh"></i>Reset Username And Password
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                                <?php include_once("reset-password-form.php"); ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-group"></i>Contact Us Page
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                                
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-comment"></i>About Us Page
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                                <?php include_once("aboutus-page-form.php"); ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filters m-b-45">     
                                <div class="navbar-sidebar2">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-tags"></i>Social Links
                                                    <span class="arrow">
                                                        <i class="fas fa-angle-down"></i>
                                                    </span>
                                            </a>
                                            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                                                <?php include_once("social-media-link-form.php"); ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                    </div>
                <div>
            </section>
            <?php require_once("model/FooterData.php"); ?>
            <!-- END PAGE CONTAINER-->
        </div>
    </div>
    <?php include_once('model/BottomScript.php'); ?>
</body>
</html>
<!-- end document-->
<script>
    let site = new SiteGlobal();
    $(document).ready(function(e){
        $("#frm_site_admin").on('submit',function(event){
            event.preventDefault();
            var data = new FormData();
            data.append('snm',$('#web_name').val());
            data.append('slogo',$('#web_logo')[0].files[0]);
            data.append('cmp_nm',$('#cmp_name').val());
            data.append('cmplogo',$('#cmp_logo')[0].files[0]);
            data.append('edt',$('#cmp_e_dt').val());
            data.append('gst',$('#cmp_gst').val());
            data.append('addr',$('#cmp_addr').val());
            data.append('ct',$('#city').val());
            data.append('pin',$('#pincode').val());
            data.append('country',$('#country').val());
            data.append('email',$('#cmp_email').val());
            data.append('ph',$('#phone').val());
            data.append('img1',$('#cimg1')[0].files[0]);
            data.append('img2',$('#cimg2')[0].files[0]);
            data.append('img3',$('#cimg3')[0].files[0]);
            data.append('img4',$('#cimg4')[0].files[0]);
            data.append('img5',$('#cimg5')[0].files[0]);
            data.append('action','save_company_data');
            site.Transaction('controller/site-data-master.php','POST',data,'#site_frm_err');           
        });

        $('#frm_site_pwd').on('submit',function(e){
            e.preventDefault();
            var data = new FormData();
            data.append('username',$('#username').val());
            data.append('pwd',$('#new_pwd').val());
            data.append('confrim_pwd',$('#confrim_pwd').val());
            <?php if(!empty($site->SITE_DATA['ID'])){ echo("data.append('old_pwd',$('#old_pwd').val());"); } ?>
            data.append('action','save_admin_data');
            site.Transaction('controller/site-data-master.php','POST',data,'#reset_pwd_err');
        });
        
        $('#social_frm').on('submit',function(e){
            e.preventDefault();
            var data = new FormData();
            data.append('gp',$('#g_p').val());
            data.append('fb',$('#fb').val());
            data.append('insta',$('#insta').val());
            data.append('yt',$('#youtube').val());
            data.append('lnk',$('#linkedin').val());
            data.append('wpg',$('#wg').val());
            data.append('action','save_social_link');
            site.Transaction('controller/site-data-master.php','POST',data,'#social_frm_err');           

        });

        $('#frm_save_profile_pic').on('submit',(function(e){
            e.preventDefault();
            var data = new FormData();
            data.append('pro_pic',$('#profile_picture')[0].files[0]);
            data.append('action','save_profile_pic');
            site.Transaction('controller/site-data-master.php','POST',data,'#save_profile_err');          
            
        }));

        $('#frm_aboutus_page').on('submit',(function(e){
            e.preventDefault();
            var data = new FormData();
            data.append('pg_banner',$('#page_banner')[0].files[0]);
            data.append('pg_ft_img',$('#page_feature_img')[0].files[0]);
            data.append('pg_story',$('#page_story').val());
            data.append('pg_thought',$('#page_thought').val());
            data.append('action','save_aboutus_pg');
            site.Transaction('controller/site-data-master.php','POST',data,'#aboutus_pg_err');          
        }));
        
    });
</script>