<?php
    require_once('Auth.php');
    class Customer extends Auth{

        public function __construct()
        {
            parent :: __construct();
        }

        public function JSON_CUSTOMER_ADD(){ 
            printf(json_encode(Array("statusCode"=>"CUSTOMER_ADD")));
        }

        public function CheckCustomerExist($arr){
            $r = $this->select(Array('user_id','email','phNo'),'_ecm_customer_mstr',"user_id like '%".$arr['user_id']."%' OR email like '%".$arr['email']."%' or phNo like '%".$arr['phNo']."%'");
            $cnt = mysqli_num_rows($r);
            return $cnt > 0 ? true : false;
        }

        public function RegisterNewCustomer($arr)
        {
            array_pop($arr);
            if(!$this->CheckTextEmpty($arr)){
                $this->JSON_EMPTY();
                return;
            }
            if ($this->CheckCustomerExist($arr))
            {   
                $this->JSON_DATA_EXIST();
                return;
            }
            if(!$this->CheckEmail($arr['email']))
            {
                $this->JSON_EMAIL();
                return;
            }
            if(!$this->CheckPassword($arr['pwd']))
            {
                $this->JSON_PASSWORD();
                return;
            }
            if(!$this->CheckPhoneNumber($arr['phNo']))
            {
                $this->JSON_PHONE();
                return;
            }
            
            $arr['pwd'] = $this->EncryptHash($arr['pwd'],$arr['user_id']);
            $arr = $this->PureArray($arr,true,$this->conn);

            if( $this->insert('_ecm_customer_mstr',$arr) &&
                $this->insert('_ecm_customer_verify_mstr',Array(
                                                                'token' => $this->EncryptHash(substr($arr['user_id'],1,4),substr($arr['email'],1,4)),
                                                                'email' => $arr['email'],
                                                                'otp' => random_int(100000,999999)))
                                    ){
                                        $this->JSON_CUSTOMER_ADD();
                                    }
                                    else{
                                        $this->JSON_500();
                                    }
        }


        public function CustomerTable($value){
                $record_per_page = 500;  
                $page = '';  
                $output = '';  
                if(isset($value["page"]))  
                {  
                    $page = $value["page"];  
                }  
                
                $start_from = ($page - 1)*$record_per_page; 
                
                $r = $this->select('','_ecm_customer_mstr',"1 ORDER BY reg_date DESC LIMIT ".$start_from.",".$record_per_page."");  
                
                $output .= "<div class='table-responsive table-responsive-data2'>
                <table class='table table-data2'>
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>date of registration</th>
                            <th>verified ?</th>
                            <th></th>
                        </tr>
                    </thead>
                <tbody>";
               
                if(mysqli_num_rows($r) > 0){
                        while ($data = $this->fetch_assoc($r)) {
           
                          $output .='<tr class="tr-shadow">
                                    <td>'.$data["fname"].'</td>
                                    <td>
                                        <span class="block-email">'.$data['email'].'</span>
                                    </td>
                                    <td>'.$data['reg_date'].'</td>
                                    <td>'; $output .=  $data['verfied'] == 0 ? 'NO' : 'YES'; $output.='</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>                     
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>';
                    }                  
                    if(mysqli_num_rows($r) > 0){
                        $r = $this->select('','_ecm_customer_mstr','1 ORDER BY reg_date DESC');
                        $total_records = mysqli_num_rows($r);  
                        $total_pages = ceil($total_records/$record_per_page);  
                        $output .= "<nav aria-label='Page navigation example'>
                                        <ul class='pagination justify-content-center'>";
                        for($i=1; $i<=$total_pages; $i++)  
                        {  
                           $output .= "<li class='page-item'><span class='page-link pagination_link' id='$i'>$i</span></li>";                                                                                              
                        }
                        $output .= "    </ul>
                                    </nav>";
                    }
                    
                }else{
                   $output .= '<tr>
                        <td colspan=5>
                        <h4>No Data Priview Avialable</h4>
                        </td>
                    </tr>';
                    }
                
                   $output .= '</tbody>
                </table>
            </div>';

            
            echo $output;   
         }

        public function CustomerShortList(){
            ?>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>date of registration</th>
                            <th>verified ?</th>
                            <th></th>
                        </tr>
                    </thead>
                <tbody>
            <?php
                $r = $this->select('','V_MIN_CUST_LIST','1');
                if(mysqli_num_rows($r) > 0){
                        while ($data = $this->fetch_assoc($r)) {
            ?>
                    <tr class="tr-shadow">
                        <td><?php printf($data['NAME']); ?></td>
                        <td>
                            <span class="block-email"><?php printf($data['EMAIL']); ?></span>
                        </td>
                        <td><?php printf($data['REG_DATE']); ?></td>
                        <td><?php printf($data['VERIFY'] == 0 ? "NO" : "YES"); ?></td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>                     
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
            <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan=5>
                        <h4>No Data Priview Avialable</h4>
                        </td>
                    </tr>
                <?php }
                ?>
                
                    </tbody>
                </table>
            </div>                
        <?php }

        public function GenerateVerificationToken($username,$email){
            return $this->EncryptHash($username,$email);
        }

        public function VerifyCustomer($email,$otp){
            $r = $this->select(Array('username'),'_ecm_customer_mstr',"email LIKE '%".$email."%'");
            $count = mysqli_num_rows($r);

            if($count == 1){
                $data = mysqli_fetch_assoc($r);

                $r = $this->select('','V_CUST_VERIFY_MSTR',"SEC_TOKEN LIKE '%".$this->GenerateVerificationToken($data['username'],$email)."%' AND EMAIL LIKE '%".$email."%' AND OTP LIKE '%".$otp."%'");
                $count = mysqli_num_rows($r);
    
                if($count == 1){
                    if($this->update('_ecm_customer_mstr',Array('isblock'=>0,'verified'=>1,'activated'=>true),"email LIKE '%".$email."%'") and
                        $this->delete('_ecm_customer_verify_mstr',"email LIKE '%".$email."%'")){
                            return true;
                    }
                    else{
                        return false;
                    }
                }
            }
            else{
                return false;
            }
        }
        
        function UpdateProfile($var){
            session_start();
            $ref = $this->GetClientIdByAccessTocken();
            if($this->CheckTextEmpty($var)){
                $r = $this->select('','_ecm_customer_mstr'," (email = '".$var['email']."' and user_id <> '".$ref."') or (phNo='".$var['phNo']."' and user_id <> '".$ref."') ");
                if(mysqli_num_rows($r) < 1){
                    if(!$this->CheckPhoneNumber($var['phNo'])){
                        $this->JSON_PHONE();
                        return;
                    }
                    if(!$this->CheckEmail($var['email'])){
                        $this->JSON_EMAIL();
                        return;
                    }
                    $var = $this->PureArray($var,true,$this->conn);
                    array_pop($var);
                    array_pop($var);
                    if($this->update('_ecm_customer_mstr',$var,"user_id ='".$ref."'")){
                        $this->JSON_SAVE();
                    }else{
                        $this->JSON_500();
                    }
                }else{
                    $this->JSON_DATA_EXIST();
                }
            }else{
                $this->JSON_EMPTY();
            }
            
        }
    }

    if(isset($_POST['action'])){
        $customer = new Customer();
        switch ($_POST['action']) {
            case 'CustomerTable':
                $customer->CustomerTable($_POST);
                break;
            case 'short_list_customer':
                $customer->CustomerShortList();
            break;
            case 'reg_new_cust':
                $customer->RegisterNewCustomer($_POST);
                break;
            case 'update_profile':
                $customer->UpdateProfile($_POST);
                break;
            default:
                # code...
                break;
        }
    }
?>