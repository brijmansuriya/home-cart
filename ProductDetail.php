<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
	
</head>
<body class="animsition">

	<?php require_once('client/model/Navbar.php') ?>

	<?php 
		$r = $site->select('','v_product_details',"TC = '".$_REQUEST['ptc']."'");

		if (mysqli_num_rows ($r) == 1){
			$product = $site->fetch_assoc($r);
			$all_child = $site->select(Array('TITLE','PACK','SR','TC'),'v_product_details',"CODE = '".$product['CODE']."'");
		}
		else{
			printf("Page Error");
		}
	?>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="data:images/*;base64,<?php print(base64_encode($product['IMG1'])) ?>">
							<div class="wrap-pic-w">
								<img src="data:images/*;base64,<?php print(base64_encode($product['IMG1'])) ?>" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="data:images/*;base64,<?php print(base64_encode($product['IMG2'])) ?>">
							<div class="wrap-pic-w">
								<img src="data:images/*;base64,<?php print(base64_encode($product['IMG2'])) ?>" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="data:images/*;base64,<?php print(base64_encode($product['IMG3'])) ?>">
							<div class="wrap-pic-w">
								<img src="data:images/*;base64,<?php print(base64_encode($product['IMG3'])) ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13" id="product_title">
					<?php print($product['TITLE']) ?>
				</h4>

				<span class="m-text17">
					&#x20b9; <?php print($product['SR']) ?>
				</span>

				<!-- <p class="s-text8 p-t-10">
					
				</p> -->

				<!--  -->


				<div class="p-t-33 p-b-60">
						<?php 
							if(mysqli_num_rows($all_child) > 0)
							{
								
								?>
								<div class="flex-m flex-w p-b-10">
									<div class="s-text15 w-size15 t-center">
										More From : <?php print($product['CMP']) ?>
									</div>
								
									<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
										<select class="selection-1" id="child_product_list">
										<option value="-1">Select Another</option>
								
								<?php
								while($child = $site->fetch_assoc($all_child))
								{
								?>
										<option value="<?php print($child['TC']) ?>"><?php print($child['TITLE']) ?> | &#x20b9; <?php print($child['SR']) ?> </option>
										
								<?php
								}
							}
						?>
										</select>
									</div>
								</div>				

					
					<div class="flex-r-m flex-w p-t-10">
							
						<?php

							//print($site->user_id);

							$check_cart = $site->select('',' _ecm_cart_mstr m,_ecm_cart_sub_mstr s',"s.p_t_c = '".$product['TC']."' AND m.user_id ='".$site->user_id."' AND m.cart_id = s.cart_id");	
							$exist  = mysqli_num_rows($check_cart) > 0 ? true : false;
							if ($exist){
								$temp = $site->fetch_assoc($check_cart);
								$qty = $temp['qty'];
							}
						?>

						<div class="w-size16 flex-m flex-w">

							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="<?php print($exist == true ? $qty  : '1') ?>" id='product_qty'>

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>
							<div id="product_action"  style='padding:0;margin:0;display:contents'>

								<?php 
									if (!$exist)
									{
								?>
										<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
											
											<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="<?php print($product['TC']) ?>" onclick="AddToCart(this)">
												Add to Cart
											</button>
										</div>
									

								<?php
									}
									else if($exist){							
										
								?>
									<div id="" style='padding:0;margin:0;display:contents'>
										<!-- <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
											<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
												<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
											</button>

											<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="<?php print($pqic['qty']) ?>" id='product_qty'>

											<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
												<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
											</button>
										</div> -->

										<div class="btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10" style='display:flex;'>
											
											<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="<?php print($product['TC']) ?>" onclick="UpdateToCart(this)" style='margin-right:10px'>
												<i class="fs-18 fa fa-edit" aria-hidden="true"></i>
											</button>

											<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="<?php print($product['TC']) ?>" onclick="DeleteToCart(this)">
												<i class="fs-18 fa fa-trash" aria-hidden="true"></i>
											</button>
										</div>

										<div class="btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10">
											<a style='background-color:darkolivegreen' class="flex-c-m sizefull bo-rad-23 hov1 s-text1 trans-0-4" href=''>
												Goto Cart &nbsp;<i class="fs-20 fa fa-shopping-cart" aria-hidden="true"></i>
											</a>
										</div>
									</div>

								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: <?php print($product['SKU']) ?></span>
					<span class="s-text8">Category: <?php print($product['CAT']) ?></span>
				</div>

				<?php
					if(!empty($product['DESC']))
					{
				?>
					<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Description
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['DESC'])) ?>
							</p>
						</div>
					</div>
				<?php
					}

					if(!empty($product['AF'])){
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Additional information
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['AF'])) ?>
							</p>
						</div>
					</div>
				<?php
					}

					if(!empty($product['UM']))
					{
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Usage Methods
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['UM'])) ?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($product['ST']))
					{
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Storage Tips
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['ST'])) ?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($product['BEN']))
					{
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Benifits
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['BEN'])) ?>
							</p>
						</div>
					</div>
				<?php
					}
					if(!empty($product['WAR']))
					{
				?>
					<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
						<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
							Warranty Info.
							<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
							<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						</h5>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
							<p class="s-text8">
								<?php print(html_entity_decode($product['WAR'])) ?>
							</p>
						</div>
					</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
	
	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					More <?php print($product['CAT']); ?> Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					<?php 
						$releted_product = $site->select(Array('IMG1','TITLE','SR','TC'),'v_product_details',"TC <> '".$product['TC']."' AND CAT = '".$product['CAT']."' LIMIT 10");
						if (mysqli_num_rows($releted_product) > 0){
							while($data = $site->fetch_assoc($releted_product))
							{
								$check_cart = $site->select('',' _ecm_cart_mstr m,_ecm_cart_sub_mstr s',"s.p_t_c = '".$data['TC']."' AND m.user_id ='".$site->user_id."' AND m.cart_id = s.cart_id");
								$exist = mysqli_num_rows($check_cart) > 0 ? true : false;
					
					?>
							<div class="item-slick2 p-l-15 p-r-15">
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative">
										<img src="data:imgages/*;base64,<?php print(base64_encode($data['IMG1'])); ?>" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<div class="block2-btn-addcart w-size1 trans-0-4">
												<div id="btn-cart-toggle">
													<?php if($exist){ ?>
														<a style='background-color:darkolivegreen' class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4' href=''>
															Goto Cart &nbsp;<i class='fs-20 fa fa-shopping-cart' aria-hidden='true'></i>
														</a>
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
											&#x20b9; <?php print($data['SR']) ?>
										</span>
									</div>
								</div>
							</div>
						<?php
						}
					}
					?>

				</div>
			</div>

		</div>
	</section>


	<?php require_once('client/model/FooterData.php'); ?>	
	<?php require_once('client/model/FooterScript.php'); ?>

</body>
</html>

<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
</script>

<script>

	<?php
		print("
		
			var max = ".$product['MAX'].";
		
		");
	?>

	$(document).ready(function(e){
			$('#child_product_list').on('change',function(){
				if ($('#child_product_list').val() != -1 && ptc != $('#child_product_list').val())
					location.href='ProductDetail.php?ptc='+$('#child_product_list').val();
				else
					return;
			});
	});

</script>


