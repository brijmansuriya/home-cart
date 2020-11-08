<?php

    require_once('Auth.php');
    class CustomerCart extends Auth{
        public function __construct()
            {
                parent :: __construct();
            }
        
        function JSON_PRODUCT_LIMIT(){
            print_r(json_encode(Array("statusCode"=>"PRODCUT_PUR_LIMIT")));
        }

        function JSON_PRODUCT_ADD_CART_SUCCESS(){
            print_r(json_encode(Array("statusCode"=>"PRODCUT_ADD_CART_SUCCESS")));
        }

        function JSON_PRODUCT_EXIST_IN_CART(){
            print_r(json_encode(Array("statusCode"=>"PRODCUT_EXIST_IN_CART")));
        }
        function JSON_QUANTITY_OVER_STOCK(){
            print_r(json_encode(Array("statusCode"=>"PRODCUT_QANTITY_OVER_STOCK")));
        }
        function JSON_PRODUCT_QTY_INVALID(){
            print_r(json_encode(Array("statusCode"=>"PRODCUT_QANTITY_INVALID")));
        }

        function JSON_PRODUCT_UPDATED(){
            print_r(json_encode(Array("statusCode"=>"CART_PRODCUT_UPDATED")));
        }

        function JSON_PRODUCT_DELETED(){
            print_r(json_encode(Array("statusCode"=>"PRODUCT_DELETED_FROM_CART")));
        }
        function CheckCartExist($user_ref){
            $r = $this->select('','_ecm_cart_mstr',"user_id ='".$user_ref."'");
            if(mysqli_num_rows($r) < 1){
                print(mysqli_num_rows($r));
                return true;
            }
            return false;
        }

        function CreateCart($var){
            if($this->CheckCartExist($var['user_ref'])){
                $data = Array(
                    "cart_id" => $this->FinalGenerateRandomSequence(10,'cart_id','_ecm_cart_mstr'),
                    "user_id" => $var['user_ref']
                );
                if($this->insert('_ecm_cart_mstr',$data)){
                    return true;
                }
                return -1;
            }
            return true;
        }

        function GetCartId($user_ref){
            $r = $this->select('','_ecm_cart_mstr'," user_id ='".$user_ref."'");
            $t = mysqli_fetch_assoc($r);
            return $t['cart_id'];
        }

        function AddProductToCart($var){
            if($this->CreateCart($var) == true){
               $r = $this->select(Array('MAX','STOCK'),'v_product_details'," TC = '".$var['product_ref']."'");
               if(mysqli_num_rows($r) > 0){
                    $t = mysqli_fetch_assoc($r);
                    if($var['product_qty'] > $t['MAX'] || $var['product_qty'] > $t['STOCK']){
                        $this->JSON_PRODUCT_LIMIT();
                        return;
                    }
                    $add_pro_cart_data = Array(
                        "cart_id" => $this->GetCartId($var['user_ref']),
                        "p_t_c" => $var['product_ref'],
                        "qty" => $var['product_qty']
                    );
                    $r = $this->select(Array('s.p_t_c'),"_ecm_cart_mstr c,_ecm_cart_sub_mstr s"," s.p_t_c ='".$var['product_ref']."' and s.cart_id = c.cart_id and c.user_id ='".$var['user_ref']."'");
                    if(mysqli_num_rows($r) > 0){
                        $this->JSON_PRODUCT_EXIST_IN_CART();   
                        return; 
                    }
                    if($this->insert('_ecm_cart_sub_mstr',$add_pro_cart_data)){
                        $this->JSON_PRODUCT_ADD_CART_SUCCESS();
                    }
                    else{
                        $this->JSON_500();
                    }
               }
               else{
                   $this->JSON_403();
               }
            }else{
                $this->JSON_500();
            }
        }

        function GenerateCart($var){
            // SELECT p.IMG1,p.TITLE, p.SR, c.qty FROM v_product_details p, _ecm_cart_sub_mstr c, _ecm_cart_mstr mc WHERE c.p_t_c = p.TC and c.cart_id = mc.cart_id and mc.user_id = 'vivekkudecha'
            $r = $this->select(Array('p.TC,p.IMG1','p.TITLE','p.SR','c.qty'),"v_product_details p, _ecm_cart_sub_mstr c, _ecm_cart_mstr mc","c.p_t_c = p.TC and c.cart_id = mc.cart_id and mc.user_id = '".$var."'");
            if(mysqli_num_rows($r) > 0){
                ?>
                <div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
                    <table class='table-shopping-cart'>
                        <tr class='table-head'>
                            <th class='column-1'></th>
                            <th class='column-2'>Product</th>
                            <th class='column-3'>Price</th>
                            <th class='column-4 p-l-70'>Quantity</th>
                            <th class='column-5'>Total</th>
                        </tr>
                <?php
                $total = 0;
                while($data = mysqli_fetch_assoc($r)){
                    $total += $data['SR']*$data['qty'];
                    print("
                            <tr class='table-row'>
                            <td class='column-1'>
                                <div class='cart-img-product b-rad-4 o-f-hidden'>
                                    <img src='data:image/*;base64,".base64_encode($data['IMG1'])."'>
                                </div>
                            </td>
                            <td class='column-2'>".html_entity_decode($data['TITLE'])."</td>
                            <td class='column-3'>".html_entity_decode($data['SR'])."</td>
                            <td class='column-4'>
                                <div class='flex-w bo5 of-hidden w-size17'>
                                    
                                    <input class='t-center num-product' type='number' name='num-product1' id='p_qty".html_entity_decode($data['TC'])."' value='".html_entity_decode($data['qty'])."'>

                                </div>
                            </td>
                            <td class='column-5'>".(html_entity_decode($data['SR']) * html_entity_decode($data['qty']))."</td>
                            <td class='column-2'>
                                <button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' style='padding:15px;margin-bottom:5px' value='".html_entity_decode($data['TC'])."' onclick='UpdateQuantity(this)'><i class='fs-18 fa fa-edit' aria-hidden='true'></i></button>
                                <button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' style='padding:15px;margin-bottom:5px' value='".html_entity_decode($data['TC'])."' onclick='DeleteProduct(this)'><i class='fs-18 fa fa-trash' aria-hidden='true'></i></button>
                            </td>
                        </tr>
                    ");
                }
                ?>
                    </table>
            </div>
            </div>     
            <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">					
				<div class=" trans-0-4 m-t-10 m-b-10" id="">
                    <h3> Total Amount : <?php print($total) ?> </h3> 
                    <button id='PlaceOrder' class='flex-c-m bg1 bo-rad-23 hov s-text1' style='padding:10px;margin-top:5px'> Place Order</button>
				</div>
			</div>       
                <?php
            }
            else{
                print("
               
                        <div style='display:flex;justify-content:center'>
                            <img src='images/empty-cart.png' style='max-height:250px' class='text-center'>
                        </div>
               
            ");
            }
        }

        function UpdateCartProductQty($val){
            array_pop($val);
            $r = $this->select(Array('p.STOCK','p.MAX'),"v_product_details p, _ecm_cart_sub_mstr c, _ecm_cart_mstr mc","c.cart_id = mc.cart_id and mc.user_id = '".$val['user_ref']."' and c.p_t_c = p.TC and c.p_t_c = '".$val['product_ref']."'");
            $data = mysqli_fetch_assoc($r);
            
            if($val['qty'] > $data['STOCK']){
                $this->JSON_QUANTITY_OVER_STOCK();
                return;
            }
            if($val['qty'] > $data['MAX']){
                $this->JSON_PRODUCT_LIMIT();
                return;
            }
            if($val['qty'] < 1){
                $this->JSON_PRODUCT_QTY_INVALID();
                return;
            }

            if($this->update("_ecm_cart_sub_mstr mc,_ecm_cart_mstr c",Array("mc.qty"=>$val['qty']),"p_t_c = '".$val['product_ref']."' and mc.cart_id = c.cart_id and c.user_id = '".$val['user_ref']."'")){
                $this->JSON_PRODUCT_UPDATED();
                return;
            }
            else{
                $this->JSON_500();
            }
        }

        function DeleteCartProduct($val){

            $cart = $this->GetCartId($val['user_ref']);
            if($this->delete("_ecm_cart_sub_mstr","p_t_c = '".$val['product_ref']."' and cart_id = '".$cart."'")){
                $this->JSON_PRODUCT_DELETED();
            }
        }
    }

    if(isset($_POST['action'])){
        $cart = new CustomerCart();
        switch ($_POST['action']) {
            case 'AddToCart':
                $cart->AddProductToCart($_POST);
                break;

            case 'GenerateCart':
                $cart->GenerateCart($_POST['user_ref']);
                break;

            case 'UpdateCartProductQantity':
                $cart->UpdateCartProductQty($_POST);
                break;
            
            case 'DeleteCartProduct':
                $cart->DeleteCartProduct($_POST);
                break;
            default:
                //$cart->JSON_403();
                break;
        }
    }
?>