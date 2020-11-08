<?php
    session_start();
    if(isset($_SESSION['AdminToken'])){
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('controller/AdminController.php'); $site = new Functional(); ?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Home-Cart Seller | Admin">
    <meta name="author" content="Vivek Kudecha">

    <link href="assets/css/font-face.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="assets/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <?php echo("<img src='data:image/*;base64,".base64_encode($site->SITE_DATA['SITE_LOGO'])."'>"); ?>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post" id="frm_login">
                                <div class="form-group" id="AuthErr">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" id="username" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once("model/FooterData.php"); ?>
        </div>
    </div>
</body>
    <script src="assets/vendor/jquery-3.2.1.min.js"></script>
    <script src="assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src='assets/js/swal.js'></script>
    <script src="../assets/js/site-custom.js"></script>
</html>
<script>
    let site = new SiteGlobal();
    $(document).ready(function(e){
        $("#frm_login").on('submit',function(event){
            event.preventDefault();
            var data = new FormData();
            data.append('ID',$('#username').val());
            data.append('PASSWORD',$('#password').val());
            data.append('action','AuthAdmin');
            site.Transaction('controller/Auth.php','POST',data,'#AuthErr');           
        });
    });
</script>