<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
	<style>
		.brand-icon-block{
			height : 200px;
			width : 200px;
			
			display : flex;
			align-items : center;
			align-content : center;
			border-radius : 30%;

			border : 0.5px solid #ccc;
		}

		.brand-icon {
			padding : 25px;
		}
	</style>
</head>
<body class="animsition">
	
	<?php require_once('client/model/Navbar.php') ?>
	
	
	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(assets/img/Slide1.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
							Fresh Vegetables & Fruits
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							New Collection
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(assets/img/Slide2.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
							All Home needs
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
							New Kitchenware Products
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(assets/img/Slide3.png);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
							Grocery
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
							At Low Cost
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Banner Category-->
	<div class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					Category
				</h3>
			</div>
			<div class="row" id="CatagoryCard"></div>
		</div>
	</div>
	<hr class='devide'>
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Top Brands
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2 rs1-slick2">
				<div class="slick2">
						<?php
							$r = $site->select('','v_product_brand','1');
							while($data = $site->fetch_assoc($r)){
								?>
									<div class="item-slick2 p-l-15 p-r-15">
										<div class="block2">
											<div class="block2-img wrap-pic-w of-hidden pos-relative brand-icon-block">
												<img src='data:images/*;base64,<?php print(base64_encode($data['CMPANY_LOGO'])) ?>' alt="IMG-PRODUCT" class='brand-icon'>
												<div class="block2-overlay trans-0-4">
													<div class="block2-btn-addcart w-size1 trans-0-4">
														<!-- <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
															Add to Cart
														</button> -->
													</div>
												</div>
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
	<hr class='devide'>
	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					Our Products
				</h3>
			</div>
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#new-launches" role="tab">New Launche</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<?php
					$r = $site->conn->query('CALL NewProductCard()');

					if(mysqli_num_rows($r) > 0)
					{
					?>
						<!--New Lauch Products -->
						<div class="tab-pane fade show active" id="new-launches" role="tabpanel">
							<div class="row">

								<?php
									
										while($data = $site->fetch_assoc($r))
										{
											// $check_cart = $site->select('s.p_t_c',' _ecm_cart_mstr m,_ecm_cart_sub_mstr s',"s.p_t_c = '".$data['TRAKING_CODE']."' AND m.user_id ='".$site->user_id."' AND m.cart_id = s.cart_id");
											// $exist = mysqli_num_rows($check_cart);
											?>
												<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
													<div class="block2">
														<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
															<img src="data:images/*;base64,<?php print(base64_encode($data['IMAGE1'])) ?>" title="<?php $data['TITLE'] ?>">

															<div class="block2-overlay trans-0-4">
																<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
																	<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
																	<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
																</a>

																<div class="block2-btn-addcart w-size1 trans-0-4">
																	<div id="btn-cart-toggle">
																		<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" onclick="AddToCart(this)" value="<?php print($data['TRAKING_CODE']) ?>">
																			Add to Cart
																		</button>
																	</div>
																</div>
															</div>
														</div>

														<div class="block2-txt p-t-20">
															<a href="ProductDetail.php?ptc=<?php print($data['TRAKING_CODE']) ?>" class="block2-name dis-block s-text3 p-b-5">
																<?php print($data['TITLE']) ?>
															</a>

															<span class="block2-price m-text6 p-r-5">
																<?php print($data['SELLING_RATE']) ?>
															</span>
														</div>
													</div>
												</div>						
										<?php
										}
								?>
		
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</section>
	<!-- Banner video -->
	<section class="parallax0 parallax100" style="background-image: url(assets/img/Banner.jpeg);">
		<div class="overlay0 p-t-190 p-b-200">
			<div class="flex-col-c-m p-l-15 p-r-15">
				<span class="m-text9 p-t-45 fs-20-sm">
					The Organic
				</span>

				<h3 class="l-text1 fs-35-sm">
					Product And Much More
				</h3>
				<span class="btn-play s-text4 hov5 cs-pointer p-t-25" data-toggle="modal" data-target="#modal-video-01">
					<i class="fa fa-play" aria-hidden="true"></i>
					Play Video
				</span>
			</div>
		</div>
	</section>

	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free delivery for certain region
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					Same Day Return On All Food Products
				</h4>

				<span class="s-text11 t-center">
					Simply return it on same days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Sunday to Saturday
				</span>
			</div>
		</div>
	</section>

	<?php require_once('client/model/FooterData.php'); ?>	

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
				<div class="video-mo-01">
					<!-- https://www.youtube.com/embed/Nt8ZrWY2Cmk?rel=0&amp;showinfo=0 -->
					<iframe src="https://www.youtube.com/embed/watch?v=nsBdBkyLW_8&list=PLAh-7CJCqyeknTG9o4ItsFQ1fvhfQDFSt" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('client/model/FooterScript.php'); ?>
</body>
</html>
<!-- 
<script src="assets/js/Assert.js"></script> -->

<script src="client/controller/Home.js"> </script>
	