<?php
    include_once('SiteMaster.php');
    
    class Auth extends SiteMaster
    {
        static $Token = "";
        
        function __construct(){
            parent::__construct();
        }

        public function JSON_CUST_GRANTED(){ // Forbidden
            printf(json_encode(Array("statusCode"=>"CUST_GRANTED")));
        }

        function GenerateRandomAccessToken($hash){
            $token = "";
            $random = bin2hex(openssl_random_pseudo_bytes(250));
            
            $j = 0;
            for($i = 0; $i < strlen($random); $i++){
                if ($i > strlen($hash)){
                    $j = 0;
                }
                $token .= $i % 2 == 0 ? $random[$i] : $hash[$j];
                $j++;
            }
            $token = $this->PureText(password_hash($token,PASSWORD_BCRYPT));
            return $token;
        }

        function PublicAccessToken(){
            if (!isset($_SESSION['PublicKey']))
                return $this->GenerateRandomAccessToken('Public');
        }

        function GetClientIdByAccessTocken(){
            if (isset($_SESSION['AccessToken'])){
                $r = $this->select('','_ecm_access_token_mstr'," t='".$_SESSION['AccessToken']."' LIMIT 1");

                $uid = $this->fetch_assoc($r);
    
                return !empty($uid['user_id']) ? $uid['user_id'] : '';
            }
            else if(isset($_SESSION['PublicKey'])){
                return substr($_SESSION['PublicKey'],strlen($_SESSION['PublicKey'])-50,50);
            }
            else{
                $this->JSON_403();
            }

        }

        function GetCartId($user_id){
            $r = $this->select('','_ecm_cart_mstr'," user_id ='".$user_id."' LIMIT 1");
            $t = mysqli_fetch_assoc($r);
            return $t['cart_id'];
        }

        function CheckCartExist($user_id){
            $r = $this->select('cart_id','_ecm_cart_mstr',"user_id ='".$user_id."' LIMIT 1");
            if(mysqli_num_rows($r) < 1){
                return true;
            }
            return false;
        }

        function CreateCart($user_id){
            if($this->CheckCartExist($user_id)){
                $data = Array(
                    "cart_id" => $this->FinalGenerateRandomSequence(10,'cart_id','_ecm_cart_mstr'),
                    "user_id" => $user_id
                );
                if($this->insert('_ecm_cart_mstr',$data)){
                    return true;
                }
                return -1;
            }
            return true;
        }

        function AuthAdmin($username,$password){
            if(!empty($username) && !empty($password)){
                if(($this->SITE_DATA['ID'] == $username) and ($this->SITE_DATA['PASSWORD'] == $this->EncryptHash($password,$username))){
                    $t = $this->GenerateRandomAccessToken($this->SITE_DATA['PASSWORD']);
                    if($this->insert('_ecm_access_token_mstr',Array('t' => $t))){
                            session_start();
                            $_SESSION['AdminToken'] = $t;
                            $this->JSON_GRANT_ADMIN();
                        }                        
                    }else{
                        $this->JSON_403();    
                    }
            }
            else{
                $this->JSON_EMPTY();
            }
            
        }


        function AuthCust($username,$password){
            if(!empty($username) && !empty($password)){
                //print( $this->EncryptHash($password,$username));
                $r = $this->select(Array('email','pwd'),'_ecm_customer_mstr'," user_id = '".$username."' and pwd = '".$this->EncryptHash($password,$username)."'");
                if(mysqli_num_rows($r) == 1){
                    $t = $this->GenerateRandomAccessToken($password);
                    if($this->insert('_ecm_access_token_mstr',Array('t' => $t,'user_id' => $username))){
                            session_start();
                            $_SESSION['AccessToken'] = $t;

                            /* STEP 1 GET PRODUCT FROM CART WHEN CUSTOMER NOT LOGGED IN */
                            $products = false;

                            $r = $this->select('','_ecm_cart_mstr',"user_id = '".$_SESSION['PublicKey']."' LIMIT 1");
                            if(mysqli_num_rows($r) == 1){
                                $t = mysqli_fetch_assoc($r);                                
                                $r = $this->select('','_ecm_cart_sub_mstr',"cart_id = '".$t['cart_id']."'");
                                if(mysql_num_rows($r) > 0)
                                {
                                    $products = True;
                                }
                                else{
                                    $this->delete('_ecm_cart_mstr',"user_id = '".$_SESSION['PublicKey']."'");
                                }
                            }

                            /* STEP 2 UPDATE PRODUCTS TO CUSTOMERS AFTER LOGGED IN */
                            if($products)
                            {
                                $r = $this->select('cart_id','_ecm_cart_mstr',"user_id ='".$username."' LIMIT 1");
                                if(mysqli_num_rows($r) == 1){
                                    $actual_cart = mysqli_fetch_assoc($r);
                                    $data = Array(
                                        "cart_id" => $actual_cart['cart_id']
                                    );
                                    if($this->update('_ecm_cart_sub_mstr',$data,"cart_id='".$t['cart_id']."'"))
                                    {
                                        $this->delete('_ecm_cart_mstr',"cart_id='".$t['cart_id']."'");
                                        unset($_SESSION['PublicKey']);
                                    }

                                }
                                else{
                                    if($this->CreateCart($username))
                                    {
                                        $data = Array(
                                            "cart_id" => $this->GetCartId($username)
                                        );
                                        if($this->update('_ecm_cart_sub_mstr',$data,"cart_id='".$t['cart_id']."'"))
                                        {
                                            $this->delete('_ecm_cart_mstr',"cart_id='".$t['cart_id']."'");
                                            unset($_SESSION['PublicKey']);
                                        }
                                    }
                                }
                            }   

                            $this->JSON_CUST_GRANTED();
                        }                        
                    }else{
                        $this->JSON_403();    
                    }
                }
            else{
                $this->JSON_EMPTY();
            }
            
        }

        function ValidateToken($t){

            $r = mysqli_num_rows($this->select(Array('t'),'_ecm_access_token_mstr',"t = '".$t."'"));
            $_t = mysqli_fetch_assoc($this->select(Array('t'),'_ecm_access_token_mstr',"t = '".$t."'"));
            if($t == $_t['t'] and $r == 1){
                return true;
            }
            else{
                return false;
            }
        }

        function DestroyAccessToken($t)
        {
            if($this->ValidateToken($t)){
                if($this->delete('_ecm_access_token_mstr',"t = '".$t."'")){
                    session_destroy();
                    
                    $this->JSON_ACCESS_REVOKE();
                    
                }
            }else{
                session_destroy();
                $this->JSON_ACCESS_REVOKE();
            }
        }

        function CommonRedirect(){
            if(!$this->SITE_STATUS){
                header('location:site-settings.php');
                return;
            }
            session_start();
            if(empty($_SESSION['AccessToken'])){
                session_destroy();
                header('location:login.php');
            }
            else if (!$this->ValidateToken($_SESSION['AccessToken'])){
                session_destroy();
                header('location:login.php');
            }
        }

        function CommonRedirectUserSide(){
            if(empty($_SESSION['CustAccessToken'])){
                session_destroy();
                header('location:login.php');
            }
            else if (!$this->ValidateToken($_SESSION['CustAccessToken'])){
                session_destroy();
                header('location:login.php');
            }
        }
    }

    if(isset($_POST['action'])){

        $auth = new Auth();
        switch ($_POST['action']) {
            case 'AuthAdmin':
                $auth->AuthAdmin($_POST['ID'],$_POST['PASSWORD']);
                break;
            case 'Revoke':
                session_start();
                $auth->DestroyAccessToken($_SESSION['AccessToken']);
                break;  
            case 'auth_cust':
                $auth->AuthCust($_POST['username'],$_POST['pwd']);
                break;

            case 'RevokeCust':
                session_start();
                $auth->DestroyAccessToken($_SESSION['CustAccessToken']);
                break;  
            default:
                # code...
                break;
        }
    }

?>