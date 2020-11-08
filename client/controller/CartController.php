<?php
    require_once('../../admin/controller/Functional.php');

    class Cart extends Assets{
        function __construct(){
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

        function AddToCart($var){
            $user_id = $this->GetClientIdByAccessTocken();    
            if($this->CreateCart($user_id)){
                $r = $this->select(Array('MAX','STOCK'),'v_product_details'," TC = '".$var['product_code']."'");
                if(mysqli_num_rows($r) > 0){
                     $t = $this->fetch_assoc($r);
                     if($var['product_qty'] > $t['MAX'] || $var['product_qty'] > $t['STOCK']){
                         $this->JSON_PRODUCT_LIMIT();
                         return;
                     }
                     $add_pro_cart_data = Array(
                         "cart_id" => $this->GetCartId($user_id),
                         "p_t_c" => $var['product_code'],
                         "qty" => $var['product_qty']
                     );
                     $r = $this->select(Array('s.p_t_c'),"_ecm_cart_mstr c,_ecm_cart_sub_mstr s"," s.p_t_c ='".$var['product_code']."' and s.cart_id = c.cart_id and c.user_id ='".$user_id."'");
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

        function UpdateToCart($val){
            $user_id = $this->GetClientIdByAccessTocken();
            $r = $this->select(Array('p.STOCK','p.MAX'),"v_product_details p, _ecm_cart_sub_mstr c, _ecm_cart_mstr mc","c.cart_id = mc.cart_id and mc.user_id = '".$user_id."' and c.p_t_c = p.TC and c.p_t_c = '".$val['product_code']."'");
            $data = mysqli_fetch_assoc($r);
            
            if($val['product_qty'] > $data['STOCK']){
                $this->JSON_QUANTITY_OVER_STOCK();
                return;
            }
            if($val['product_qty'] > $data['MAX']){
                $this->JSON_PRODUCT_LIMIT();
                return;
            }
            if($val['product_qty'] < 1){
                $this->JSON_PRODUCT_QTY_INVALID();
                return;
            }

            if($this->update("_ecm_cart_sub_mstr mc,_ecm_cart_mstr c",Array("mc.qty"=>$val['product_qty']),"p_t_c = '".$val['product_code']."' and mc.cart_id = c.cart_id and c.user_id = '".$user_id."'")){
                $this->JSON_PRODUCT_UPDATED();
                return;
            }
            else{
                $this->JSON_500();
            }
        }

        function DeleteToCart($val){

            $user_id = $this->GetClientIdByAccessTocken();

            $cart = $this->GetCartId($user_id);
            if($this->delete("_ecm_cart_sub_mstr","p_t_c = '".$val['product_code']."' and cart_id = '".$cart."'")){
                $this->JSON_PRODUCT_DELETED();
            }
        }
    }

    if(isset($_POST['action'])){
        $cart = new Cart();
        switch ($_POST['action']) {
            case 'AddToCart':
                $cart->AddToCart($_POST);
                break;

            case 'UpdateToCart':
                $cart->UpdateToCart($_POST);
                break;

            case 'DeleteToCart':
                $cart->DeleteToCart($_POST);
                break;

            default:
                # code...
                break;
        }
    }
?>