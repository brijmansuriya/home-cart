<?php 
    // Do Not Include The database File Here
    require_once("controller/AdminController.php"); 
    $site = new AdminController();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("model/HeaderScript.php"); ?>
    <!-- Title Page-->
    <title>Seller | Dashboard</title>    
</head>
<body>
<div class="page-wrapper">

    <img src="data:images/*;base64,<?php print(base64_encode($site->SITE_DATA['SITE_LOGO'])) ?>" alt="" srcset="">
        <!-- MENU SIDEBAR-->
        <?php if($site->SITE_STATUS){require_once("navbar.php");}  ?>

        
                
</div>
</body>
</html>

<?php include_once('model/BottomScript.php'); ?>