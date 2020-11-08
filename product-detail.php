<?php
	session_start();
	include_once('private/script/server/Auth.php');
	$db = new Auth();
	$db->CommonRedirectUserSide();
	$product_ref = $_REQUEST['product'];
	
	$user_ref = $_SESSION['Username'];
		print("
			<script>
				var product_ref = '".$product_ref."';
				var user_ref = '".$user_ref."';
			</script>
		");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once("include_script.php"); ?>
	<title>Product Detail | Home Cart</title>
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src='private/script/server/site-custom-js.js'></script>
	<script src='private/script/server/Class/client-product.js'></script>
</head>
<body class="animsition">

	<?php require_once("navbar.php"); ?>
	<!-- Product Detail -->
	<!-- <div id="product_detail_section"></div> -->

	<?php
			$r = $db->select('','V_PRODUCT_DETAILS',"TC = '".$product_ref."'");
			$check_to_cart = $db->select(Array('s.p_t_c'),"_ecm_cart_mstr c,_ecm_cart_sub_mstr s"," s.p_t_c ='".$product_ref."' and s.cart_id = c.cart_id and c.user_id ='".$user_ref."'");
			while($data = mysqli_fetch_assoc($r)){
            //header('Content-type:image/jpg')
			?>
			<div class="container bgwhite p-t-35 p-b-80">
				<center><div id='product_msg'></div></center>
				<div class="flex-w flex-sb">
					<div class="w-size13 p-t-30 respon5">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="slick3">
								<?php print("<div class='item-slick3'data-thumb='data:image/*;base64,".base64_encode($data['IMG1'])."'>") ?>
									<div class="wrap-pic-w">
									<?php print("<img src='data:image/*;base64,".base64_encode($data['IMG1'])."'>") ?>
									</div>
								</div>

								<?php print("<div class='item-slick3'data-thumb='data:image/*;base64,".base64_encode($data['IMG2'])."'>") ?>
									<div class="wrap-pic-w">
									<?php print("<img src='data:image/*;base64,".base64_encode($data['IMG2'])."'>") ?>
									</div>
								</div>
								<?php print("<div class='item-slick3'data-thumb='data:image/*;base64,".base64_encode($data['IMG3'])."'>") ?>
									<div class="wrap-pic-w">
									<?php print("<img src='data:image/*;base64,".base64_encode($data['IMG3'])."'>") ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?php print(html_entity_decode($data['TITLE']));?>
				</h4>

				<span class="m-text17">
					RS. <?php print(html_entity_decode($data['SR']));?>
				</span>
				
				<div class="p-t-33 p-b-60">
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w" style='width:100%'>
							<?php
									if(mysqli_num_rows($check_to_cart) == 0){
							?>
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" id="product_qty" name="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>
							<?php
								}
							?>
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<?php
									if(mysqli_num_rows($check_to_cart) == 0){
								?>
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="<?php print($data['TC']) ?>" onclick="AddToCart(this)">
									Add to Cart
								</button>
								<?php 
									}
									else{
								?>
								<a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" href='cart.php'>
									View Cart
								</a>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: <?php print(html_entity_decode($data['SKU']));?></span>
					<span class="s-text8">Categories: <?php print(html_entity_decode($data['CAT']));?></span>
					<span class="s-text8">Brand: <?php print(html_entity_decode($data['CMP']));?></span>
				</div>

				<?php 
					if(!empty($data['DESC'])){
				?>
					<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Description
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['DESC']));?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($data['AF'])){
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Additional information
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['AF']));?>
							</p>
						</div>
					</div>

				<?php
					}
					if(!empty($data['WAR'])){
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Warranty Information
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['WAR']));?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($data['ST'])){
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Storage Tips
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['ST']));?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($data['BEN'])){
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Benifits
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['BEN']));?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($data['UM'])){
				?>
					
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Usage
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
							<?php print(html_entity_decode($data['UM']));?>
							</p>
						</div>
					</div>
				<?php
					}
				?>
			</div>
				</div>
			</div>				
			<?php
				}
			?>

	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			

		</div>
	</section>
	<?php require_once("footer.php"); ?>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



	<!--===============================================================================================-->
	
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	

<!--===============================================================================================-->
	
</body>
</html>



