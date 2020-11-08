<?php
    require('CustomerCart.php');
    class OrderController extends CustomerCart{
        public function __construct()
        {
            parent :: __construct();
        }
        
        public function JSON_USER_DETAILS(){ 
            printf(json_encode(Array("statusCode"=>"USER_DETAILS")));
        }

        public function JSON_ORDER_PLACED(){ 
            printf(json_encode(Array("statusCode"=>"ORDER_PLACED",
                                    "EmptyCart"=>"<div style='display:flex;justify-content:center'>
                                                        <img src='images/empty-cart.png' style='max-height:250px' class='text-center'>
                                                    </div>")));
        }


        function CreateOrderBucket(){
            
                $order_id = $this->FinalGenerateRandomSequence(10,'order_id','_ecm_order_mstr');
                $data = Array(
                    "order_id" => $order_id,
                    "user_id" => $this->GetClientIdByAccessTocken()
                );
                if($this->insert('_ecm_order_mstr',$data)){
                    return $order_id;
                }
                else{
                    return false;
                }
            
        }

        public function PlaceOrder()
        {
            session_start();
            $user_id = $this->GetClientIdByAccessTocken();           
            $user_data = $this->select('','_ecm_customer_mstr',"user_id = '".$user_id."'");

            if(mysqli_num_rows($user_data) == 1)
            {
                $data = $this->fetch_assoc($user_data);
                if(!empty($data['f_addr']) && !empty($data['pincode']))
                {
                    $order_id = $this->CreateOrderBucket();
                    $flag = false;
                    $total_product_cnt = 0;
                    if(!empty($order_id) || !$order_id)
                    {
                        $cart_id = $this->GetCartId($this->GetClientIdByAccessTocken());
                        $no_of_products = $this->select('','_ecm_cart_sub_mstr',"cart_id='".$cart_id."'");
                        //$p = Array();
                        if(mysqli_num_rows($no_of_products) > 0)
                        {
                            while($data = $this->fetch_assoc($no_of_products))
                            {
                                $p = $this->select(Array('p_s'),'_ecm_s_product_mstr',"p_t_c='".$data['p_t_c']."'");
                                $get_product = $this->fetch_assoc($p);  

                                if($this->update('_ecm_s_product_mstr',Array("p_s" => $get_product['p_s'] - $data['qty']),"p_t_c='".$data['p_t_c']."'")){
                                    $flag = true;
                                    $total_product_cnt++;
                                }
                                else{
                                    $flag = false;
                                    break;
                                }
                            }
                        }
                        if( $flag and
                                        $this->update('_ecm_cart_sub_mstr',
                                                        Array(
                                                                "cart_id"=>$order_id,
                                                                "ordered"=>1
                                                        ),
                                        "cart_id='".$cart_id."'")
                                        
                                    and 
                                        $this->update('_ecm_order_mstr',
                                                        Array("pcnt"=>$total_product_cnt),
                                        "order_id='".$order_id."'")){
                                    
                                    if($this->delete('_ecm_order_mstr',"user_id='".$user_id."' AND pcnt = 0")){
                                        $this->JSON_ORDER_PLACED();
                                    }
                        }
                        
                    }
                }
                else{
                    $this->JSON_USER_DETAILS();
                }
            }
            else
            {
              //  $this->JSON_403();
            }
        }

        function OrderTable($value)
        {
            $record_per_page = 3;  
            if(isset($value['rec_per_page'])){
                $record_per_page = $value['rec_per_page'];
            }
            $page = '';  
            $output = '';  
            if(isset($value["page"]))  
            {  
                $page = $value["page"];  
            }  
            
            $start_from = ($page - 1) * $record_per_page; 

           
            session_start();
            $r = $this->select('','_ecm_order_mstr'," user_id = '".$this->GetClientIdByAccessTocken()."' ORDER BY ord_date DESC LIMIT ".$start_from.",".$record_per_page."");  
            
            if(mysqli_num_rows($r) > 0)
            {
                while($order = $this->fetch_assoc($r))
                {
                    $p = $this->select('','_ecm_cart_sub_mstr',"cart_id ='".$order['order_id']."' AND ordered = 1");                   
                    

                    $output .= "<div id='order_block'> 
                                <div class='container-table-cart pos-relative'>
                                    <div class='wrap-table-shopping-cart bgwhite'>
                                        <table class='table-shopping-cart'>
                                            <tr class='table-head'>
                                                <th class='column-1'></th>
                                                <th class='column-2'>Product</th>
                                                <th class='column-3'>Price</th>
                                                <th class='column-4'>Quantity</th>
                                                <th class='column-5'>Total</th>
                                            </tr>";
                    while($product = $this->fetch_assoc($p))
                    {
                        $qty = $product['qty'];

                        $product_details = $this->select('','v_product_details',"TC='".$product['p_t_c']."'");

                        $product_detail = $this->fetch_assoc($product_details);

                        $img = $product_detail['IMG1'];

                        $title = $product_detail['TITLE'];

                        $price = $product_detail['SR'];

                        $total = $qty * $price;
                       
                        
                                   $output .= "  <tr class='table-row'>
                                                    <td class='column-1'>
                                                        <div class='cart-img-product b-rad-4 o-f-hidden'>
                                                            <img src='data:images/*;base64,".base64_encode($img)."' alt='IMG-PRODUCT'>
                                                        </div>
                                                    </td>
                                                    <td class='column-2'>".$title."</td>
                                                    <td class='column-3'>₹ ".$price."</td>
                                                    <td class='column-4'>".$qty."</td>
                                                    <td class='column-5'>₹ ".$total."</td>
                                                </tr>";                       
                    }
                                if($order['ord_status'] == 0)
                                    $status = 'ORDERD';
                                else if($order['ord_status'] == 1)
                                    $status = 'DISPATCHED';
                                else if ($order['ord_status'] == 2)
                                    $status = 'TRANSIST';
                                else if ($order['ord_status'] == 3)
                                    $status = 'DILEVERD';
                                else if($order['ord_status'] == 4)
                                    $status ='CANCELD';
                                else if($order['ord_status'] == 5)
                                    $status = 'NOT APROVED';
                                $output .= "   
                                            </table>
                                        </div>
                                    </div>
                        
                                    <div class='flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm'>
                                        <div class='size12 trans-0-4 m-t-10 m-b-10 m-r-10'>
                                                <span class='flex-c-m sizefull s-text1 trans-0-4' style='color:black'>
                                                    Order id : ".$order['order_id']."
                                                </span>
                                        </div>				
                                        <div class='size12 trans-0-4 m-t-10 m-b-10 m-r-10'>
                                                <span class='flex-c-m sizefull s-text1 trans-0-4' style='color:black'>
                                                    Date : ".$order['ord_date']."
                                                </span>
                                        </div>	
                                        <div class='size12 trans-0-4 m-t-10 m-b-10 m-r-10'>
                                                <span class='flex-c-m sizefull s-text1 trans-0-4' style='color:black'>
                                                    Products :  ".$order['pcnt']."
                                                </span>
                                        </div>					
                                        <div class='size12 trans-0-4 m-t-10 m-b-10 m-r-10'>
                                                <span class='flex-c-m sizefull s-text1 trans-0-4' style='color:black'>
                                                    Status :  ".$status."
                                                </span>
                                        </div>	
                                        <div class='size10 trans-0-4 m-t-10 m-b-10'>
                                            <!-- Button -->
                                            <button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' value='".$order['order_id']."' onclick='CancelOrder(this)'>
                                                Cancel Order
                                            </button>
                                            
                                        </div>
                                    </div><div style='margin-bottom:65px'></div></div>";                                       
                }
                if(mysqli_num_rows($r) > 0){
                    $r = $this->select('','_ecm_order_mstr'," user_id = '".$this->GetClientIdByAccessTocken()."' ORDER BY ord_date DESC");  
                    $total_records = mysqli_num_rows($r);  
                    $total_pages = ceil($total_records/$record_per_page);  
                    $output .= "<nav aria-label='Page navigation example' style='margin-top : 35px'>
                                    <ul class='pagination justify-content-center'>";
                    for($i=1; $i<=$total_pages; $i++)  
                    {  
                            $output .= "<li class='page-item' style='padding : 5px;cursor: pointer'><span class='page-link pagination_link' id='$i'>$i</span></li>";                                                                                              
                    }
                    $output .= "    </ul>
                                </nav>";
                }
                echo $output; 
            }        
        }


    }

    if($_POST['action'])
    {
        $order = new OrderController();
        switch ($_POST['action']) {
            case 'place_order':                
                $order->PlaceOrder();
                break;

            case 'OrderTable':
                $order->OrderTable($_POST);
                break;
            
            default:
                //$order->JSON_403();
                break;
        }
    }
?>