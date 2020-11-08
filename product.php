<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();

	if(empty($_REQUEST['Sort']))
		$_REQUEST['Sort'] = 'Default';
	else{
		if($_REQUEST['Sort'] != 'Default' or $_REQUEST['Sort'] != 'MostPopuler' or $_REQUEST['Sort'] != 'PriceLow' or $_REQUEST['PriceHigh']){
			$_REQUEST['Sort'] = 'Default';
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	require_once('client/model/HeaderScript.php');
?>
<title>Home Cart | Product</title>
</head>
<body class="animsition">

<?php require_once('client/model/Navbar.php') ?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product-banner.png);">
		
	</section>
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>
						<ul class="p-b-54">

						<?php
						
							$result = $site->select(Array("`Record`","`Catagory`","`CatImg`","`SuperCat`"),"v_cat_mstr","`Catagory` = `SuperCat`");
							while($data = mysqli_fetch_assoc($result)){
							
						?>
								<li class='p-t-8'>
									<img height='25px' width='25px' src="data:imgages/*;base64,<?php print(base64_encode($data['CatImg'])); ?>" alt="IMG-PRODUCT">
									<button onclick="GetProductList('<?php printf($data['Record']) ?>')">
										<?php printf($data['Catagory']) ?>
									</button>
								</li>
						<?php 
            				}       
						?>
						</ul>
						
						<h4 class="m-text14 p-b-7">
							Shop By Brands
						</h4>
						<ul class="p-b-54" id="product-brand">
							<?php
									$r = $site->select('','v_product_brand','1');
									?>
									<?php
										while($data = mysqli_fetch_assoc($r)){
											?>
												<li style='padding-bottom:10px'>
												<?php echo("<img style='height:30px;width:30px;' src='data:image/*;base64,".base64_encode($data['CMPANY_LOGO'])."'>"); ?>
													<button onclick="GetproductByBrand(<?php printf($data['COMPANY_NO']) ?>">
														<?php printf(strlen($data['COMPANY_NAME']) < 15 ? $data['COMPANY_NAME'] : substr($data['COMPANY_NAME'],0,13)."..") ; ?>
													</button>
												</li>
											<?php
										}
							?>
						</ul>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>
						<?php
						if($_REQUEST['Sort'] == 'Default')
							$r = $site->conn->query("select `v_sub_product_prop`.`TITLE` AS `TITLE`,`v_sub_product_prop`.`SELLING_RATE` AS `SELLING_RATE`,`v_sub_product_prop`.`IMAGE1` AS `IMAGE1`,`v_sub_product_prop`.`TRAKING_CODE` AS `TC` from `v_sub_product_prop` where ((`v_sub_product_prop`.`ACTIVATE` = 1) and (`v_sub_product_prop`.`STOCK` > 0))");
						$cnt = 0;
						while($data = $site->fetch_assoc($r))
						{
							$check_cart = $site->select('',' _ecm_cart_mstr m,_ecm_cart_sub_mstr s',"s.p_t_c = '".$data['TC']."' AND m.user_id ='".$site->user_id."' AND m.cart_id = s.cart_id");
							$exist = mysqli_num_rows($check_cart) > 0 ? true : false;
						?>
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative">
										<img src="data:images/*;base64,<?php print(base64_encode($data['IMAGE1'])) ?>" title="<?php $data['TITLE'] ?>">
										
											<div class="block2-overlay trans-0-4">
												<div class="block2-btn-addcart w-size1 trans-0-4">
													<div id="btn-cart-toggle">
														<?php if($exist){ ?>
															<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" style="background-color:darkolivegreen" onclick="GotoCart(this)" value="<?php print($data['TC']) ?>">
																Goto Cart &nbsp;<i class='fs-20 fa fa-shopping-cart' aria-hidden='true'></i>
															</button>
														<?php } else { ?>
														<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" onclick="AddToCartFromCard(this)" value="<?php print($data['TC']) ?>">
															<span>Add to Cart</span>
														</button>
														<?php } ?>
													</div>
												</div>
											</div>
									</div>
		
									<div class="block2-txt p-t-20">
										<a href="ProductDetail.php?ptc=<?php print($data['TC']) ?>" class="block2-name dis-block s-text3 p-b-5">
											<?php print($data['TITLE']) ?>
										</a>
										<span class="block2-price m-text6 p-r-5">
											<?php print($data['SELLING_RATE']) ?>
										</span>
									</div>
								</div>
							</div>					
					<?php
							$cnt++;
						}
					?>					
					</div>

					<!-- Pagination -->
					<!-- <div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div> -->
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<div class="row" id='product_card_section'>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require_once('client/model/FooterData.php'); ?>	
	<?php require_once('client/model/FooterScript.php'); ?>
</body>
</html>
