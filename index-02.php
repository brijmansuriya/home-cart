<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- File Includes -->
    <?php 
        require_once("include_script.php"); // Include The Require CSS     
    ?>
</head>
<title>Home Cart | Home</title>
</head>
<body class="animsition">

    <?php require_once("navbar.php");  ?>

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(images/bg_1.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						
						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							Fresh Vegetables & Fruits
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(images/bg_2.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
							
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
							New arrivals
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(images/bg_3.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
							
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight">
							New arrivals
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="product.php" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Banner -->
	

	<!-- New Product -->
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Fresh Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2" id="home-page-products">
			<?php
				include_once('private/script/server/dbConnect.php');
				$db = new dbConnect();
				$r = $db->select('','user_product_card');
            while($data = mysqli_fetch_assoc($r)){
            ?>
                    <div class="item-slick2 p-l-15 p-r-15">
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <?php print("<img style='height:100%' src='data:image/*;base64,".base64_encode($data['IMAGE1'])."'>") ?>
								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
                                        <a class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" href='product-detail.php?product=<?php print($data['TRAKING_CODE']) ?>'>
												View Product
										</a>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                    <?php print(html_entity_decode($data['TITLE'],ENT_QUOTES)); ?>
								</a>

								<span class="block2-price m-text6 p-r-5">
                                    <?php print(html_entity_decode($data['SELLING_RATE'],ENT_QUOTES)); ?>
								</span>
							</div>
						</div>
					</div>                    
            <?php
			}
			?>
				</div>
			</div>

		</div>
	</section>
	
	<?php require_once("footer.php"); ?>

	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
	
</body>
</html>

<script src='private/script/server/site-custom-js.js'></script>
<!-- <script>
	function product_card() {
		var data = new FormData();
		data.append('action','HomePageProducts');
		
		return site.ControlGenerator('private/script/server/Class/ProductMaster.php','POST',data);
	}
	$(document).ready(function(){

		alert('ok');
		$('#home-page-products').html(product_card());
	});
</scitpt> -->