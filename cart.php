<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
		print("
			<script>
				var user_ref = '".$site->GetClientIdByAccessTocken()."';
			</script>
		");
?>
<!DOCTYPE html>
<html lang="en">
<?php 
	require_once('client/model/HeaderScript.php');
?>
<title>My Cart</title>
<body class="animsition">

	<?php require_once('client/model/Navbar.php') ?>

	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/cart-banner.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div id='cart_body'></div>
		</div>
	</section>

	<?php require_once('client/model/FooterData.php'); ?>	
	<?php require_once('client/model/FooterScript.php'); ?>
</body>
</html>
<script src='assets/js/site-custom.js'></script>
<script src='assets/js/Client-Cart.js'></script>