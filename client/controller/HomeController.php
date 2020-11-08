<?php


    require_once('../../admin/controller/Functional.php');
    
    class HomeController extends Assets{
        function CatagoryCard(){
            $r = $this->select('','V_CAT_MSTR');
            while($d = mysqli_fetch_assoc($r)){

                ?>

                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <?php print("<img src='data:image/*;base64,".base64_encode($d['CatImg'])."' alt=''>") ?>
                        <div class="block1-wrapbtn w-size2">
                            <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                <?php print($d['Catagory']) ?>
                            </a>
                        </div>
                    </div>
                </div>	
            
                <?php
            } 
        }

        function GetBrandSilderContent(){
            $r = $this->select('','v_product_brand','1');
            while($data = $this->fetch_assoc($r)){
                ?>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src='data:images/*;base64,<?php print(base64_encode($data['CMPANY_LOGO'])) ?>' alt="IMG-PRODUCT">
                                <div class="block2-overlay trans-0-4">
                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
        			
    }

    //$post = json_decode(file_get_contents("php://input"));

    
    if(isset($_POST['action'])){

        $home = new HomeController();

        switch ($_POST['action']) {
            case 'GetCatagoryCard':
                $home->CatagoryCard();
                break;

            case 'GetBrandSliderContent';
                $home->GetBrandSilderContent();
                break;
            
            default:
                # code...
                break;
        }
    }

?>