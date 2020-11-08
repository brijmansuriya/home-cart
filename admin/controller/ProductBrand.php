<?php
    require_once('Auth.php');
    Class ProductBrand extends Auth{
        function __construct(){
            parent :: __construct();
        }

        function CheckBrandExist($val){
            if($r = $this->select(Array('cmp_name'),'_ecm_product_brand_mstr',"cmp_name like '%".$val['cmp_name']."%'")){
                $cnt = mysqli_num_rows($r);
                if($cnt > 0 || $cnt == 1){
                    return true;
                }
            }
            return false;
        }
        function AddProductCompany($val,$file){
            array_pop($val);
            if($this->CheckTextEmpty($val) && !empty($file)){
                if($this->CheckStanardDatalength($val,1)){
                    if(!$this->CheckBrandExist($val)){
                        if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png'),10,100)){
                            $data = Array(
                                'cmp_no' => $this->FinalGenerateRandomSequence(10,'cmp_no','_ecm_product_brand_mstr'),
                                'cmp_name' => $this->PureText($val['cmp_name'],true,$this->conn),
                                'cmp_address' => $this->PureText($val['cmp_address'],true,$this->conn),
                                'cmp_cell' => $this->PureText($val['cmp_cell'],true,$this->conn),
                                'cmp_email' => $this->PureText($val['cmp_email'],true,$this->conn),
                                'cmp_logo' => addslashes(file_get_contents($file['cmp_logo']['tmp_name'])),
                                'cmp_type' => $this->PureText($val['cmp_type'],true,$this->conn)
                            );
                            if($this->insert('_ecm_product_brand_mstr',$data)){
                                $this->JSON_SAVE();
                            }
                            else{
                                $this->JSON_500();
                            }
                        }
                    }
                    else{
                        $this->JSON_DATA_EXIST();
                    }
                }else{
                    $this->JSON_LENGTH();
                }
            } 
            else{
                $this->JSON_EMPTY();
            }
        }

        function GetBrandListAsDropdown(){
            $r = $this->select('','v_product_brand','1');
            ?>
            <option value='-1' selected='selected'>None</option>
            <?php
                while($data = mysqli_fetch_assoc($r)){
                    ?>
                        <option value='<?php printf($data['COMPANY_NO']) ?>'><?php printf($data['COMPANY_NAME']." | ". ($data['COMPANY_TYPE'] == 1 ? 'Marketing Company' : ($data['COMPANY_TYPE'] == 2 ? 'Manufacturer Company' : 'Marketing & Menufacturer Company'))) ; ?></option>
                    <?php
                }
        }       

        function GetMarketingCompany(){
            $r = $this->select('','v_product_brand','COMPANY_TYPE = 1 or COMPANY_TYPE = 3');
            ?>
            <?php
                while($data = mysqli_fetch_assoc($r)){
                    ?>
                        <option value='<?php printf($data['COMPANY_NO']) ?>'><?php printf($data['COMPANY_NAME']." | ". ($data['COMPANY_TYPE'] == 1 ? 'Marketing Company' : ($data['COMPANY_TYPE'] == 2 ? 'Manufacturer Company' : 'Marketing & Menufacturer Company'))) ; ?></option>
                    <?php
                }
        }

        function GetManufacturerCompany(){
            $r = $this->select('','v_product_brand','COMPANY_TYPE = 2 or COMPANY_TYPE = 3');
            ?>
            <?php
                while($data = mysqli_fetch_assoc($r)){
                    ?>
                        <option value='<?php printf($data['COMPANY_NO']) ?>'><?php printf($data['COMPANY_NAME']." | ". ($data['COMPANY_TYPE'] == 1 ? 'Marketing Company' : ($data['COMPANY_TYPE'] == 2 ? 'Manufacturer Company' : 'Marketing & Menufacturer Company'))) ; ?></option>
                    <?php
                }
        }

        function GetSingleBrandRecord($val){
            $r = $this->select('','v_product_brand','COMPANY_NO = \''.$val['ref'].'\'');
            if(mysqli_num_rows($r) == 1){
                $data = mysqli_fetch_assoc($r);
                printf(json_encode(Array("COMPANY_NAME"=>html_entity_decode($data['COMPANY_NAME'],ENT_QUOTES),
                                        "COMPANY_ADDRESS" => html_entity_decode($data['COMPANY_ADDRESS'],ENT_QUOTES),
                                        "COMPANY_CELL" => html_entity_decode($data['COMPANY_CELL'],ENT_QUOTES),
                                        "COMPANY_EMAIL" => html_entity_decode($data['COMPANY_EMAIL'],ENT_QUOTES),
                                        "COMPANY_TYPE" => html_entity_decode($data['COMPANY_TYPE'],ENT_QUOTES))));
            }
            else{
                $this->JSON_NOTHING();
            }
        }

        function UpdateBrand($val,$file){
            if(isset($val['cmp_no'])){
                $data = Array(
                    'cmp_name' => $this->PureText($val['cmp_name'],true,$this->conn),
                    'cmp_address' => $this->PureText($val['cmp_address'],true,$this->conn),
                    'cmp_cell' => $this->PureText($val['cmp_cell'],true,$this->conn),
                    'cmp_type' => $this->PureText($val['cmp_type'],true,$this->conn)
                );
                if(!empty($file)){
                    $data += Array('cmp_logo' => addslashes(file_get_contents($file['cmp_logo']['tmp_name'])));
                }
                if($this->update('_ecm_product_brand_mstr',$data,' cmp_no = \''.$val['cmp_no'].'\'')){
                    $this->JSON_SAVE();
                }
                else{
                    $this->JSON_500();
                }
            }
            else{
                $this->JSON_EMPTY();
            }
        }

        function GetProductBrandList(){
            $r = $this->select('','v_product_brand','1');
            ?>
            <?php
                while($data = mysqli_fetch_assoc($r)){
                    ?>
                        <li style='padding-bottom:10px'>
                        <?php echo("<img style='height:30px;width:30px;' src='data:image/*;base64,".base64_encode($data['CMPANY_LOGO'])."'>"); ?>
                            <button onclick="GetproductByBrand(<?php printf($data['COMPANY_NO']) ?>">
                                <?php printf($data['COMPANY_NAME']); ?>
                            </button>
                        </li>
                    <?php
                }
        }
    }

    if(isset($_POST['action']))
    {
        $pb = new ProductBrand();
        switch ($_POST['action']) {
            case 'new_product_company':
                $pb->AddProductCompany($_POST,$_FILES);
                break;
            
            case 'get_product_as_drop_down':
                $pb->GetBrandListAsDropdown();
                break;
            
            case 'get_single_brand_data':
                array_pop($_POST);
                $pb->GetSingleBrandRecord($_POST);
                break;
            
            case 'update_company':
                array_pop($_POST);
                $pb->UpdateBrand($_POST,$_FILES);
                break;

            case 'get_marketing_company_list':
                $pb->GetMarketingCompany();
                break;

            case 'get_manufacturer_company_list':
                $pb->GetManufacturerCompany();
                break;
            
            case 'get_product_brand_list':
                $pb->GetProductBrandList();
                break;
            default:-
                $a->JSON_403();
                break;
        }
    }
    else{
       //print_r($_POST);
        $a->JSON_403();
    }
?>