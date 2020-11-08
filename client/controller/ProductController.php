<?php
    require_once('../../admin/controller/Functional.php');

    class Cart extends Assets{
        function __construct(){
            parent :: __construct();
        }
        
        function ProductCardGenerator($match='',$FromPrice=0,$ToPrice=0)
        {
            if(!empty($match))
            {
                $r = $this->conn->query("select `v_sub_product_prop`.`TITLE` AS `TITLE`,`v_sub_product_prop`.`SELLING_RATE` AS `SELLING_RATE`,`v_sub_product_prop`.`IMAGE1` AS `IMAGE1`,`v_sub_product_prop`.`TRAKING_CODE` AS `TRAKING_CODE` from `v_sub_product_prop` where ((`v_sub_product_prop`.`ACTIVATE` = 1) and (`v_sub_product_prop`.`STOCK` > 0))");
                while($data = $this->fetch_assoc($r))
				{
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
            }
        }
    }

    if(isset($_GET['action'])){
        $cart = new Cart();
        switch ($_GET['action']) {
            case 'DefaultProductList':
                $cart->ProductCardGenerator('DefaultProductList');
                break;
            default:
                # code...
                break;
        }
    }
?>