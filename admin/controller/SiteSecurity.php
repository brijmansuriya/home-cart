<?php

    // Include Database Connection File
    include_once('Database.php');
    //require_once('htmlpurifier/library/HTMLPurifier.auto.php');
    class SiteSecurity extends Database
    {
        public $SITE_DATA = NULL;
        public $ABOUT_US_PAGE = NULL;
        public $SITE_STATUS = false;
        public $AccessToken = NULL;
        public $PublicToken = NULL;
        // Check Weather The Site Configure or Not
        function __construct(){
            parent :: __construct();
            $this->Init();
        }
        function Init(){
            try{
                $flag = false;
                $db = new Database();
                $r = $db->select('','V_SITE_DATA','1');
                
                $s = mysqli_fetch_assoc($r);
                if($s['ID'] != NULL && $s['SITE_NAME'] != NULL && $s['COMPANY_NAME'] != NULL)
                    $flag = true;
                else   
                    $flag = false;
                
                $r = $this->select('','V_ABOUT_US_PAGE','1');
                $a = mysqli_fetch_assoc($r);
                if($a['PAGE_BANNER_IMAGE'] != NULL && $a['PAGE_STORY'])
                    $flag = true;
                else
                    $flag = false;
                
                $db->conn->close();
                $this->SITE_DATA = $s;
                $this->ABOUT_US_PAGE = $a;
                $this->SITE_STATUS = $flag;
                return $flag;
            }
            catch(Exception $e){
                $db->conn->close();
                header('location:403.php');
            }
        }
        // Check The Username is Exist or Not
        public function InitSet(){
            try{
                $db = new Database();
                $r = $db->select('','V_SITE_DATA','1');
                
                $d = mysqli_fetch_assoc($r);
                if($d['ID'] != NULL && $d['SITE_NAME'] != NULL && $d['COMPANY_NAME'] != NULL){
                    return true;
                }else{
                        return false;
                }
                
                $r = $db->select('','V_SITE_DATA','1');
                $d = mysqli_fetch_assoc($r);
                if($d['PAGE_BANNER_IMAGE'] != NULL && $d['PAGE_STORY']){                    
                    return true;
                }else{
                    return false;
                }
                
            }
            catch(Exception $e){
                print($e->getMessage);
            }
        }

        // Prevent From The HTML Entity And javascript Input And Prevent To Store in Database
        public function PureText($data,$sql=false,$dbCon=null){
            return $sql == true ? mysqli_real_escape_string($dbCon,filter_var(htmlspecialchars($data,ENT_QUOTES),FILTER_SANITIZE_STRING)) : filter_var(htmlspecialchars($data,ENT_QUOTES),FILTER_SANITIZE_STRING);
        }

        // Pure Value Array Derived From PureText
        public function PureArray($arr,$sql=false,$dbCon=null,$special=""){
            if(is_array($arr)){
                foreach ($arr as $k => $v) {
                    $arr[$k] = $this->PureText($v,$sql,$dbCon);
                }
                return $arr;
            }
        }

        //Check String Contains The Special Character Or Not
        public function CheckSpecialChar($var,$least=1){
            $count = 0;
            // Check The Special Char Part 1
            for($j=0; $j < strlen($var); $j++){
                for ($i=33; $i < 48; $i++) {
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }        
            } 

            // Check The Special Char Part 2
            for($j=0; $j < strlen($var); $j++){
                for ($i=58; $i < 65; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }
            

            // Check The Special Char Part 3
            for($j=0; $j < strlen($var); $j++){
                for ($i=91; $i < 97; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }

            // Check The Special Char Part 4
            for($j=0; $j < strlen($var); $j++){
                for ($i=123; $i < 127; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }
            return $count >=  $least ? true : false;
        }

        //Check String Contains Digit Or Not
        public function CheckDigit($var,$least=1){
            $count = 0;
            for($j=0; $j < strlen($var); $j++){
                for ($i=48; $i < 58; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }
            //print("<script>alert(digit : '$count' '$least')</script>");
            return $count >=  $least ? true : false;

        }

        //Check String Contains Small Alphabates Or Not
        public function CheckLowercase($var,$least=1){
            $count = 0;
            for($j=0; $j < strlen($var); $j++){
                for ($i=97; $i < 123; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }
            
            return $count >=  $least ? true : false;
        }

        //Check String Contains Uppercase Alphabates Or Not
        public function CheckUppercase($var,$least=1){
            $count = 0;
            for($j=0; $j < strlen($var); $j++){
                for ($i=65; $i < 91; $i++) { 
                    if($var[$j] == chr($i)){
                        $count++;
                    }
                }
            }
            return $count >=  $least ? true : false;
            //return ($count > 0) ? ($least == $count) ? true : false : false;
        }

        // Password Checker
        public function CheckPassword($pwd,$min = 6,$max = 16,$leastSpecialChar = 1,$leastDigit = 1,$leastSmallAlpha = 1,$leastUppercase = 1){
            if(strlen($pwd) >= $min && strlen($pwd) <= $max){
                $isSpecialChar = $this->CheckSpecialChar($pwd,$leastSpecialChar);
                $isDigit = $this->CheckDigit($pwd,$leastDigit);
                $isAlpha = ($this->CheckLowercase($pwd,$leastSmallAlpha) && $this->CheckUppercase($pwd,$leastUppercase));
                if($isSpecialChar && $isDigit && $isAlpha){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
            
        }

        // Generate Password Token
        function EncryptHash($baseString,$key){
            if(!empty($baseString) && !empty($key) && strlen($baseString) < 17 && strlen($key) < 17){
                $tempString = "";
                $tempKey = "";
                $token = "";
                
                // Convert The String To Reverse Order Then encrypt each character to base64_encode then md5
                for($i=strlen($baseString)-1; $i >= 0; $i--){
                    $mid = md5(base64_encode($baseString[$i]));
                    $tempString .= substr($mid, strlen($mid)/2,1);
                }
                for($i=strlen($key)-1; $i >= 0; $i--){
                    $mid = md5(base64_encode($key[$i]));
                    $tempKey .= substr($mid, strlen($mid)/2,1);
                }

                // combine encrypted string and store to variable
                $tempString = $tempString.$tempKey;

                // Convert The Temporary Encrypted String To The Reverse and each char to base64_encode then md5 for each length / 2
                for($i=strlen($tempString)-1; $i >= 0; $i--){
                    $mid = md5(base64_encode($tempString[$i]));
                    $tempKey .= substr($mid, strlen($mid)/2,1);
                }    

                // Taking One Char From First And One From Last As So On
                for($i=0;$i<strlen($tempKey);$i++)
                    $token .= ($i % 2 ==0) ? $tempKey[$i] : $tempKey[strlen($tempKey) - $i];
                }
                return md5($token);
        }
    }
    
?>