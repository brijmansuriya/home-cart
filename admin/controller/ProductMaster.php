<?php
     require_once('Functional.php');
    class ProductMaster extends Assets{
        function __construct(){
            parent:: __construct();
        }

        function JSON_PRODUCT_NAME(){
            printf(json_encode(Array("statusCode"=>'PRODUCT_NAME_EMPTY')));
        }

        function JSON_PRODUCT_CATAGORY_NONE(){
            printf(json_encode(Array("statusCode"=>'PRODUCT_CATAGORY_NONE')));
        }

        function JSON_PRODUCT_TAX_SLAB_EMPTY(){
            printf(json_encode(Array("statusCode"=>'PRODUCT_TAX_SLAB_EMPTY')));
        }

        function JSON_PRODUCT_TAX_SLAB_WRONG(){
            printf(json_encode(Array("statusCode"=>'PRODUCT_TAX_SLAB_WRONG')));
        }

        function JSON_PARENT_PRODUCT(){
            printf(json_encode(Array("statusCode"=>"MAIN_PRODUCT_SELECT")));
        }

        function JSON_PRODUCT_SKU(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_SKU")));
        }

        function JSON_PRODUCT_DATA_LENGTH_VIOLATE(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_DATA_LENGTH_VIOLATE")));
        }

        function JSON_PRODUCT_PACKAGE_UNIT(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_PACKAGE_UNIT")));
        }

        function JSON_PRODUCT_AMOUNT_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_AMOUNT_INVALID")));
        }
        
        function JSON_PRODUCT_STOCK_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_STOCK_INVALID")));
        }

        function JSON_PRODUCT_NQTY_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_NQTY_INVALID")));
        }

        function JSON_PRODUCT_DIAMANTION_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_DIAMANTION_INVALID")));
        }

        function JSON_PRODUCT_WARRANTY_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_WARRANTY_INVALID")));
        }

        function JSON_PRODUCT_MAX_PER_CUST_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_MAX_PER_CUST_INVALID")));
        }

        function PRODUCT_ADDINFO_INVALID(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_ADDINFO_INVALID")));
        }

        function JSON_PRODUCT_SAVED(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_SAVED")));
        }

        function JSON_PRODUCT_S2_DELETE(){
            printf(json_encode(Array("statusCode"=>"PRODUCT_S2_DELETE")));
        }

        function RegisterNewProduct($val){
            if(empty($val['product_name'])){
                $this->JSON_PRODUCT_NAME();
                return;
            }

            if($val['product_category'] == -1){
                $this->JSON_PRODUCT_CATAGORY_NONE();
                return;
            }

            if(empty($val['product_tax_slab'])){
                $this->JSON_PRODUCT_TAX_SLAB_EMPTY();
                return;
            }else{
                if(!is_numeric($val['product_tax_slab']) || $val['product_tax_slab'] > 100){
                    $this->JSON_PRODUCT_TAX_SLAB_WRONG();
                    return;
                }
            }

            $new_product = Array(
                'p_name' => $this->PureText($val['product_name'],true,$this->conn),
                'p_cat' => $val['product_category'],
                'p_m_c' => $val['product_marketing_brand'],
                'p_m' => $val['product_manufacturer_company'],
                'tax_s' => $val['product_tax_slab'],
                'p_desc' => $this->PureText($val['product_desc']),
                'p_s_t' => $this->PureText($val['product_storage_tips']),
                'p_b' => $this->PureText($val['product_benifits']),
                'p_u' => $this->PureText($val['product_usage'])
            );            

            if($val['action'] == 'update_s1_product'){
                if($this->update('_ecm_m_product_mstr',$new_product,"p_code = '".$val['p_code']."'")){
                    printf(json_encode(Array("statusCode"=>"S1_UPDATE")));
                    return;
                }
                else{
                    $this->JSON_500();
                    return;
                }
            }
            $temp = Array(
                    'p_code' => $this->FinalGenerateRandomSequence(10,'p_code','_ecm_m_product_mstr'),        
                    'p_t_c' => $this->FinalGenerateRandomSequence(10,'p_t_c','_ecm_m_product_mstr')
                );
                $new_product = $temp + $new_product;
                //print_r($new_product);
                if($this->insert('_ecm_m_product_mstr',$new_product)){
                    printf(json_encode(Array("statusCode"=>"S1_DONE",
                    "PCode"=>$new_product['p_code'])));
                }
                else{
                    $this->JSON_500();
                }
        }

        function SaveNewProduct($val,$file){
            if($val['action'] == 'save_s2product'){
                if(empty($val['p_code'])){ 
                    $this->JSON_PARENT_PRODUCT();
                    return;
                }
            }
                
            if(!empty($val['sku']))
                if(strlen($val['sku']) > 20 and strlen($val['sku']) < 3){
                    $this->JSON_PRODUCT_DATA_LENGTH_VIOLATE();
                    return;
                }
            
            
            if(strlen($val['title']) > 50 and strlen($val['title']) < 3){
                $this->JSON_PRODUCT_DATA_LENGTH_VIOLATE();
                return;
            }

            if(!empty($val['ean']))
                if(strlen($val['ean']) > 20 and strlen($val['ean']) < 3){
                    $this->JSON_PRODUCT_DATA_LENGTH_VIOLATE();
                    return;
                }
            
            if($val['product_package_unit'] == -1){
                $this->JSON_PRODUCT_DATA_LENGTH_VIOLATE();
                return;
            }

            if(empty($val['product_selling_rate']) or empty($val['product_mrp']) or strlen($val['product_selling_rate']) > 7 or strlen($val['product_mrp']) > 7){
                $this->JSON_PRODUCT_DATA_LENGTH_VIOLATE();
                return;
            }
            else{
                if(!is_numeric($val['product_selling_rate']) or !is_numeric($val['product_mrp'])){
                    $this->JSON_PRODUCT_AMOUNT();
                    return;
                }
                elseif($val['product_mrp'] < $val['product_selling_rate']){
                    $this->JSON_PRODUCT_AMOUNT_INVALID();
                    return;
                }
            }

            if(empty($val['product_stock']) or strlen($val['product_stock']) > 10){
                $this->JSON_PRODUCT_STOCK_INVALID();
                return;
            }else{
                if(!is_numeric($val['product_stock'])){
                    $this->JSON_PRODUCT_STOCK_INVALID();
                    return;
                }
                elseif($val['product_stock'] < 1){
                    $this->JSON_PRODUCT_STOCK_INVALID();
                    return;
                }
            }

            if(empty($val['product_net_qty']) or strlen($val['product_net_qty']) > 10){
                $this->JSON_PRODUCT_NQTY_INVALID();
                return;
            }else{
                if(!is_numeric($val['product_net_qty'])){
                    $this->JSON_PRODUCT_NQTY_INVALID();
                    return;
                }
                elseif($val['product_net_qty'] < 1){
                    $this->JSON_PRODUCT_NQTY_INVALID();
                    return;
                }
            }

            if(!empty($val['p_height']) or !empty($val['p_width']) or !empty($val['p_length']))
                if((!is_numeric($val['p_height']) or !is_numeric($val['p_width']) or !is_numeric($val['p_length'])) or
                    strlen($val['p_height']) > 5 or strlen($val['p_width']) > 5 or strlen($val['p_length']) > 5){
                    $this->JSON_PRODUCT_DIAMANTION_INVALID();
                    return;
                }

            if(!empty($val['product_warranty'])){
                if(strlen($val['product_warranty']) > 30){
                    $this->JSON_PRODUCT_WARRANTY_INVALID();
                    return;
                }
            }
            
            if(empty($val['product_max_per_cust']) or !is_numeric($val['product_max_per_cust']) or strlen($val['product_max_per_cust']) > 7){
                $this->JSON_PRODUCT_MAX_PER_CUST_INVALID();
                return;
            }

            if(!empty($val['product_additional_info'])){
                if(strlen($val['product_additional_info']) > 250){
                    $this->PRODUCT_ADDINFO_INVALID();
                    return;
                }
            }
            if($val['action']=='save_s2product'){
                if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png','webp'),10,200)){
                    array_pop($val);
                    $val = $this->PureArray($val,true,$this->conn);
                    $val = Array(
                        'p_code' => $val['p_code'],
                        'p_id' => $this->FinalGenerateRandomSequence(10,'p_id','_ecm_s_product_mstr'),
                        'p_sku' => $this->PureText($val['sku'],true,$this->conn),
                        'p_title' => $this->PureText($val['title'],true,$this->conn),
                        'p_ean' => $this->PureText($val['ean'],true,$this->conn),
                        'p_p_u' => $this->PureText($val['product_package_unit'],true,$this->conn),
                        'p_s_r' => $this->PureText($val['product_selling_rate'],true,$this->conn),
                        'p_mrp' => $this->PureText($val['product_mrp'],true,$this->conn),
                        'p_s' => $this->PureText($val['product_stock'],true,$this->conn),
                        'n_qty' => $this->PureText($val['product_net_qty'],true,$this->conn),
                        'p_h' => $this->PureText($val['p_height'],true,$this->conn),
                        'p_w' => $this->PureText($val['p_width'],true,$this->conn),
                        'p_l' => $this->PureText($val['p_length'],true,$this->conn),
                        'p_war' => $this->PureText($val['product_warranty'],true,$this->conn),
                        'p_img1' => addslashes(file_get_contents($file['product_img1']['tmp_name'])),
                        'p_img2' => addslashes(file_get_contents($file['product_img2']['tmp_name'])),
                        'p_img3' => addslashes(file_get_contents($file['product_img3']['tmp_name'])),
                        'p_a_inf' => $this->PureText($val['product_additional_info'],true,$this->conn),
                        'm_p_c_o' => $this->PureText($val['product_max_per_cust'],true,$this->conn),
                        'p_t_c' =>$this->FinalGenerateRandomSequence(10,'p_t_c','_ecm_s_product_mstr'),
                        'p_act' => 1
                    );
                    if($this->insert('_ecm_s_product_mstr',$val)){
                        $this->JSON_PRODUCT_SAVED();
                    }
                    else{
                        $this->JSON_500();
                    }
                    return;
                }
            }
            if($val['action'] == 'update_s2product'){
                    $ref = $val['ref'];
                    $val = $this->PureArray($val,true,$this->conn);
                    $val = Array(
                        'p_sku' => $this->PureText($val['sku'],true,$this->conn),
                        'p_title' => $this->PureText($val['title'],true,$this->conn),
                        'p_ean' => $this->PureText($val['ean'],true,$this->conn),
                        'p_p_u' => $this->PureText($val['product_package_unit'],true,$this->conn),
                        'p_s_r' => $this->PureText($val['product_selling_rate'],true,$this->conn),
                        'p_mrp' => $this->PureText($val['product_mrp'],true,$this->conn),
                        'p_s' => $this->PureText($val['product_stock'],true,$this->conn),
                        'n_qty' => $this->PureText($val['product_net_qty'],true,$this->conn),
                        'p_h' => $this->PureText($val['p_height'],true,$this->conn),
                        'p_w' => $this->PureText($val['p_width'],true,$this->conn),
                        'p_l' => $this->PureText($val['p_length'],true,$this->conn),
                        'p_war' => $this->PureText($val['product_warranty'],true,$this->conn),
                        'p_a_inf' => $this->PureText($val['product_additional_info'],true,$this->conn),
                        'm_p_c_o' => $this->PureText($val['product_max_per_cust'],true,$this->conn),
                        'p_act' => 1                       
                    );                  
                    

                if(isset($file['product_img1'])){
                    if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png','webp'),10,200)){
                        $val = $val + Array('p_img1'=>addslashes(file_get_contents($file['product_img1']['tmp_name'])));
                    }
                }
                if(isset($file['product_img2'])){
                    if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png'),10,200)){
                        $val = $val + Array('p_img2'=>addslashes(file_get_contents($file['product_img2']['tmp_name'])));
                    }
                }
                if(isset($file['product_img3'])){
                    if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png'),10,200)){
                        $val = $val + Array('p_img3'=>addslashes(file_get_contents($file['product_img3']['tmp_name'])));
                    }
                }

                if($this->update('_ecm_s_product_mstr',$val,"p_id ='".$ref."'")){
                    $this->JSON_PRODUCT_SAVED();
                }
                else{
                    $this->JSON_500();
                }
                return;
            }
        }
        function Gets1ProductForm(){
            print("
                    <form id='frm_new_product' name='frm_new_product'>
                        <div class='card-body card-block'>
                            <div class='row form-group'>
                                <div class='col-12' id='reg_pro_msg'>

                                </div>
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_name' class='form-control-label'>Product Name</label>
                                        <input type='text' id='product_name' name='product_name' placeholder='Name Of Product | Help in Search' class='form-control'  />
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_category' class=' form-control-label'>Select Product Catagory :</label>
                                        <select class='form-control' id='p_cat_drop_down'></select>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_marketing_brand' class=' form-control-label'>Product Marketing Company</label>
                                        <select class='form-control' id='product_marketing_brand' name='product_marketing_brand'></select>
                                    </div>
                                </div> 
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_manufacturer_company' class=' form-control-label'>Product Manufacturer Company</label>
                                        <select class='form-control' id='product_manufacturer_company' name='product_manufacturer_company'></select>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_tax_slab' class=' form-control-label'>TAX SLAB (in %)</label>
                                        <input type='text' id='product_tax_slab' placeholder='Tax Slab' class='form-control' />
                                    </div>
                                </div>
                                
                            </div>
                            <div class='row form-group'>
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_desc' class=' form-control-label'>Description (If Required)</label>
                                        <textarea name='product_desc' id='product_desc' rows='5' class='form-control'></textarea>
                                    </div>
                                </div>           
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_storage_tips' class='form-control-label'>Storage Tips (If Required)</label>
                                        <textarea id='product_storage_tips' name='product_storage_tips' class='form-control' rows='5'></textarea>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_benifits' class=' form-control-label'>Benifits (If Required)</label>
                                        <textarea name='product_benifits' id='product_benifits' rows='5' class='form-control'></textarea>
                                    </div>
                                </div>           
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_usage' class='form-control-label'>Usage (If Required)</label>
                                        <textarea id='product_usage' name='product_usage' class='form-control' rows='5'></textarea>
                                    </div>
                                </div>             
                            </div>
                            <div class='row form-group m-t-10'>
                                <div class='col-6'>
                                    <div class='form group'>
                                        <button type='submit' id='save_data' class='col-4 btn btn-primary'>Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class='row form-group m-t-10'>
                                <div class='col-6' id='frm_new_product_msg'>
                                
                                </div>

                            </div>
                        </div>
                    </form>
                    "
                );
        }

        function Gets2ProductForm(){
            print(" 
                    <form id='frm_new_product_s2' name='frm_new_product_s2'>
                        <div class='card-body card-block'>
                            <div class='row form-group'>
                                <div class='col-12' id='product_msg'>

                                </div>
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='p_product_dd' class='form-control-label'>Select Parent Product Code</label>
                                        <input type='text' name='p_code' id='p_code' class='form-control'  disabled />
                                        <!--<select id='p_product_dd' class='form-control'>
                                            <option value=-1>None</option>
                                        </select>-->
                                    </div>
                                </div> 
                                <!--<div class='col-4'>
                                    <div class='form-group'>
                                        <label for='p_name' class='form-control-label'>Name :</label>
                                        <input type='text' name='p_name' id='p_name' class='form-control'  disabled />
                                    </div>
                                </div>-->
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='sku' class=' form-control-label'>SKU</label>
                                        <input type='text' id='sku' name='sku' placeholder='Product SKU' class='form-control'  />
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='title' class=' form-control-label'>Title :</label>
                                        <input type='text' name='title' id='title' placeholder='Product Title' class='form-control'  />
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='ean' class=' form-control-label'>EAN</label>
                                        <input type='text' name='ean' id='ean' placeholder='Product EAN' class='form-control'  />
                                    </div>
                                </div> 
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_package_unit' class=' form-control-label'>Packaging Units</label>
                                        <select class='form-control' id='product_package_unit' name='product_package_unit'></select>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_selling_rate' class='form-control-label'>Selling Rate</label>
                                        <input type='text' id='product_selling_rate' placeholder='Product Selling Rate (Without TAX)' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_mrp' class='form-control-label'>MRP</label>
                                        <input type='text' id='product_mrp' placeholder='Actual Product MRP (Printed On Product)' class='form-control' />
                                    </div>
                                </div>   
                            </div>
                            <div class='row form-group'>                    
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_stock' class='form-control-label'>Total Stock </label>
                                        <input type='text' id='product_stock' placeholder='Total Avialable Stock In Warehouse' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_net_qty' class=' form-control-label'>Net Product Qty</label>
                                        <input type='text' id='product_net_qty' placeholder='Product Net Quantity As Per Product Unit' class='form-control' />
                                    </div>
                                </div>           
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for=' class='form-control-label'>Product Diamantion in Inch (Only)</label>
                                        <div class='row for-group'>
                                            <div class='col-4'>
                                                <div class='form-group'>
                                                    <input type='text' name='p_height' id='p_height' placeholder='height' class='form-control'>
                                                </div>
                                            </div>x 
                                            <div class='col-3'>
                                                <div class='form-group'>
                                                    <input type='text' name='p_width' id='p_width' placeholder='width' class='form-control'>
                                                </div>
                                            </div>x 
                                            <div class='col-4'>
                                                <div class='form-group'>
                                                    <input type='text' name='p_length' id='p_length' placeholder='length' class='form-control'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                            <div class='row form-group'>                    
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_warranty' class='form-control-label'>Warranty Information | If Applicable </label>
                                        <input type='text' id='product_warranty' placeholder='Actual Product Warranty Info' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_max_per_cust' class='form-control-label' style='font-size:14px'>Maximum Qty Per Customer As Per Product Unit</label>
                                        <input type='text' id='product_max_per_cust' placeholder='Maximum Order Per Customer' class='form-control' />
                                    </div>
                                </div>           
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_additional_info' class='form-control-label'>Additional Information </label>
                                        <textarea type='text' id='product_additional_info' class='form-control' row='0'></textarea>
                                    </div>
                                </div>             
                            </div>
                            <div class='row form-group'>                    
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_img1' class='form-control-label'>Product Image 1 </label>
                                        <input type='file' id='product_img1' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_img2' class='form-control-label'>Product Image 2 </label>
                                        <input type='file' id='product_img2' class='form-control' />
                                    </div>
                                </div>           
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_img3' class='form-control-label'>Product Image 3 </label>
                                        <input type='file' id='product_img3' class='form-control' />
                                    </div>
                                </div>             
                            </div>
                            <div class='row form-group m-t-10'>
                                <div class='col-6'>
                                    <div class='form group'>
                                        <button type='submit' id='save_product' class='col-4 btn btn-primary'>Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class='row form-group m-t-10'>
                                <div class='col-6' id='frm_new_product_msg'>
                                
                                </div>

                            </div>
                        </div>
                    </form>"
            );
        }

        function s1ProductTableShort(){
            $r = $this->select('','v_short_m_pro_tbl','1');
            
                while ($data = mysqli_fetch_assoc($r)) {
                    print("<tr>
                            <td>
                                <div class='table-data_info'>
                                    <h6>".html_entity_decode($data['NAME'],ENT_QUOTES)."</h6>
                                    <span>".html_entity_decode($data['CODE'],ENT_QUOTES)."</span>
                                </div>
                            </td>
                            <td>".html_entity_decode($data['CATAGORY'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['BRAND'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['TAX'],ENT_QUOTES)."</td>
                            <td>".substr(html_entity_decode($data['DESC'],ENT_QUOTES),0,30)."..</td>
                            <td>
                                <div class='dropdown'> 
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Edit or View
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <button class='dropdown-item' onclick='s1_s2_sub(this)' value=\"".$data['CODE']."\" data-toggle='modal' data-target='#s1_s2_sub_model'>View product and subproduct</button>
                                        <button id='btn-s1-data' onclick='s1ProductProp(this)' value=\"".$data['CODE']."\" data-toggle='modal' data-target='#product_model' class='dropdown-item'>Add product</button>
                                        <button id='btn-s1-single' onclick='Gets1Single(this)' value=\"".$data['CODE']."\"  data-toggle='modal' data-target='#product_s1model' class='dropdown-item'>Edit Master</button>
                                    </div>
                                </div>
                               <!--<button class='btn btn-primary' id='btn-s1-data' onclick='s1ProductProp(this)' value=\"".$data['CODE']."\" data-toggle='modal' data-target='#product_model'>Show</button>-->
                            </td>
                           </tr>

                    ");
                }
            
        }

        function CountS1Product(){
            $r = $this->select('','v_main_product_prop');
            $cnt = mysqli_num_rows($r);
            print($cnt);
        }

        function Gets1SingleProduct($val){
            $r = $this->select('','v_main_product_prop',"CODE = '".$val['ref']."'"); 
            
            
            while($data = mysqli_fetch_assoc($r)){
            
                print_r(json_encode(Array(  "NAME"=>html_entity_decode($data['NAME'],ENT_QUOTES),
                                            "CAT"=>html_entity_decode($data['CATAGORY'],ENT_QUOTES),
                                            "MARKETING"=>html_entity_decode($data['MARKETING_COMPANY'],ENT_QUOTES),
                                            "MANUFACTURER"=>html_entity_decode($data['MANUFACTURER_COMPANY'],ENT_QUOTES),
                                            "TAX"=>html_entity_decode($data['TAX_SLAB'],ENT_QUOTES),
                                            "DESC"=>html_entity_decode($data['DESCRIPTION'],ENT_QUOTES),
                                            "S_TIPS"=>html_entity_decode($data['STORAGE_TIPS'],ENT_QUOTES),
                                            "BEN"=> html_entity_decode($data['BENIFITS'],ENT_QUOTES),
                                            "U_METHOD"=>html_entity_decode($data['USAGE_METHOD'],ENT_QUOTES))));
            }
        }

        function Gets2SingleProduct($val){
            $r = $this->select('','v_sub_product_prop',"PRODUCT_ID = '".$val['ref']."'");
            while($data = mysqli_fetch_assoc($r)){
                print_r(json_encode(Array(  "SKU"=>html_entity_decode($data['SKU'],ENT_QUOTES),
                                            "TITLE"=>html_entity_decode($data['TITLE'],ENT_QUOTES),
                                            "EAN"=>html_entity_decode($data['EAN'],ENT_QUOTES),
                                            "PPU"=>html_entity_decode($data['PRODUCT_PACKAGE_UNIT'],ENT_QUOTES),
                                            "SR"=>html_entity_decode($data['SELLING_RATE'],ENT_QUOTES),
                                            "MRP"=>html_entity_decode($data['MRP'],ENT_QUOTES),
                                            "STOCK"=>html_entity_decode($data['STOCK'],ENT_QUOTES),
                                            "NQTY"=>html_entity_decode($data['NET_QTY'],ENT_QUOTES),
                                            "PH"=>html_entity_decode($data['P_HEIGHT'],ENT_QUOTES),
                                            "PW"=>html_entity_decode($data['P_WIDTH'],ENT_QUOTES),
                                            "PL"=>html_entity_decode($data['P_LENGTH'],ENT_QUOTES),
                                            "WAR"=>html_entity_decode($data['WARRANTY'],ENT_QUOTES),
                                            "ADD_INFO"=>html_entity_decode($data['ADD_INFO'],ENT_QUOTES),
                                            "MPC"=>html_entity_decode($data['MAX_PER_CUST'],ENT_QUOTES))));
            }
        }

        function Gets2Tbl($val){
            $r = $this->select('','v_sub_product_prop',"PRODUCT_CODE = '".$val['ref']."'");
            while($data = mysqli_fetch_assoc($r)){
                print("
                        <tr>
                            <td>".substr(html_entity_decode($data['SKU'],ENT_QUOTES),0,5)."..</td>
                            <td>".html_entity_decode($data['TITLE'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['EAN'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['SELLING_RATE'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['MRP'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['STOCK'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['WARRANTY'],ENT_QUOTES)."</td>
                            <td>".html_entity_decode($data['MAX_PER_CUST'],ENT_QUOTES)."</td>
                            <td>".substr(html_entity_decode($data['ADD_INFO'],ENT_QUOTES),0,10)."..</td>
                            <td><img style='height:30px;width:30px;' src='data:image/*;base64,".base64_encode($data['IMAGE1'])."'></td>
                            <td><img style='height:30px;width:30px;' src='data:image/*;base64,".base64_encode($data['IMAGE2'])."'></td>
                            <td><img style='height:30px;width:30px;' src='data:image/*;base64,".base64_encode($data['IMAGE3'])."'></td>
                            <td>
                                <div class='dropdown'> 
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Edit or Delete
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <button id='btn-s1-single' onclick='Gets2Single(this)' value=\"".$data['PRODUCT_ID']."\"  data-toggle='modal' data-target='#product_model' class='dropdown-item'>Edit</button>
                                        <button id='btn-s1-single' onclick='Deletes2Product(this)' value=\"".$data['PRODUCT_ID']."\" class='dropdown-item'>Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                ");
            }
        }

        function s2Delete($val){
            if($this->delete('_ecm_s_product_mstr',"p_id = '".$val['ref']."'")){
                $this->JSON_PRODUCT_S2_DELETE();
            }else{
                $this->JSON_500();
            }
        }

        function GenerateUserProductCardListAll(){
            $r = $this->select('','user_product_card');
            while($data = mysqli_fetch_assoc($r)){
            ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<?php print("<img style='height:100%' src='data:image/*;base64,".base64_encode($data['IMAGE1'])."'>") ?>

									<div class="block2-overlay trans-0-4">
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
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
        }

        function GenerateHomePageProductCard(){
            $r = $this->select('','user_product_card');
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
        }

        function GenerateProduct($product_ref){
            $r = $this->select('','V_PRODUCT_DETAILS',"TC = '".$product_ref."'");
            while($data = mysqli_fetch_assoc($r)){
            //header('Content-type:image/jpg')
            ?>
                	<div class="flex-w flex-sb">
                        <div class="w-size13 p-t-30 respon5">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots">
                                    <ul class="slick3-dots" role="tablist" style="">
                                        <li class="slick-active" role="presentation">
                                            <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG1'])."'>") ?>
                                            <div class="slick3-dot-overlay"></div>
                                        </li>
                                        <li role="presentation">
                                            <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG2'])."'>") ?>
                                            <div class="slick3-dot-overlay"></div>
                                        </li>
                                        <li role="presentation">
                                            <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG3'])."'>") ?>
                                            <div class="slick3-dot-overlay"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="slick3 slick-initialized slick-slider slick-dotted">
                                    <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 252px;">
                                        <div class="item-slick3 slick-slide slick-current slick-active" data-thumb="images/thumb-item-01.jpg" data-slick-index="0" aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10" style="width: 84px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                            <div class="wrap-pic-w">
                                                <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG1'])."'>") ?>
                                            </div>
                                        </div>
                                        <div class="item-slick3 slick-slide" data-thumb="images/thumb-item-02.jpg" data-slick-index="1" aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide11" aria-describedby="slick-slide-control11" style="width: 84px; position: relative; left: -84px; top: 0px; z-index: 998; opacity: 0;">
                                            <div class="wrap-pic-w">
                                                <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG2'])."'>") ?>
                                            </div>
                                        </div>
                                        <div class="item-slick3 slick-slide" data-thumb="images/thumb-item-03.jpg" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide12" aria-describedby="slick-slide-control12" style="width: 84px; position: relative; left: -168px; top: 0px; z-index: 998; opacity: 0;">
                                            <div class="wrap-pic-w">
                                                <?php print("<img src='data:image/*;base64,".base64_encode($data['IMG3'])."'>") ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
            }
        }

    }

    $pm = new ProductMaster();
    if(isset($_POST['action'])){
        switch ($_POST['action']) {
            case 'reg_new_product':
                $pm->RegisterNewProduct($_POST);
                break;
            case 'update_s1_product':
                $pm->RegisterNewProduct($_POST);
                break;
            case 'save_s2product':
                $pm->SaveNewProduct($_POST,$_FILES);
                break;
            case 'update_s2product':
                $pm->SaveNewProduct($_POST,$_FILES);
                break;
            case 's2_delete':
                $pm->s2Delete($_POST);
                break;
            case 's1_product_form':
                $pm->Gets1ProductForm();
                break;
            
            case 's2_product_form':
                $pm->Gets2ProductForm();
                break;
            case 's1_product_short_tbl':
                $pm->s1ProductTableShort();
                break;

            case 'count_s1_product':
                $pm->CountS1Product();
                break;  
                
            case 'get_s1_single':
                $pm->Gets1SingleProduct($_POST);
                break;
            
            case 'get_s2_single':
                $pm->Gets2SingleProduct($_POST);
                break;
            case 's2_product_tbl':
                $pm->Gets2Tbl($_POST);
                break;

            case 'user_product_card':
                $pm->GenerateUserProductCardListAll();
                break;
            case 'HomePageProducts':
                $pm->GenerateHomePageProductCard();
                break;
            case 'GetProductDetails':
                $pm->GenerateProduct($_POST['ref']);
                break;
            default:
                $pm->JSON_403();
                break;
        }
    }
    else{
        print_r($_POST);
        $pm->JSON_403();
    }
?>