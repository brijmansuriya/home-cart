<?php

    include_once('SiteSecurity.php');
    class SiteMaster extends SiteSecurity
    {
        public function __construct()
        {
            parent :: __construct();
        }

        // Redirect Site Setting Page if Website not Configure
        function RedirectToConfig()
        {
            $s = new SiteSecurity();
            if(!$s->CheckInit())
            {
                unset($s);
                header('location:site-settings.php');
            }
        }

        // Convert 2D Array to 1D Array Extract Data Only Not A Key
        function ArrayDataExtractor($arr,$keyValuePair=0,$top_del=",",$in_del=":"){
            try{
                $dataArray = Array();
                $cnt = 1;
                if($keyValuePair == 1){
                    $keyArray = Array();
                    $valueArray = Array();
                    foreach(explode($top_del,$arr) as $row_data){
                        foreach(explode($in_del,$row_data) as $final_data){
                            if($cnt % 2 == 0){
                                array_push($valueArray,$final_data);
                            }
                            if($cnt % 2 == 1){
                                array_push($keyArray,$final_data);
                            }
                            $cnt++;
                        }
                    }
                    return array_combine($keyArray,$valueArray);
                }
                foreach(explode($top_del,$arr) as $row_data){
                    foreach(explode($in_del,$row_data) as $final_data){
                        if($cnt % 2 == 0){
                            array_push($dataArray,$final_data);
                        }
                        $cnt++;
                    }
                }
                return $dataArray;
            }
            catch(Exception $e){
                return $e;
            }
        }

        //function check values empty or not (General Terms  Text Only)
        function CheckTextEmpty($dataArray){
            foreach($dataArray as $row_data){
                if(empty($row_data)){
                    return false;
                }
            }
            return true;
        }

        function CheckStanardDatalength($dataArray,$minlen,$maxlen = 20){
            foreach($dataArray as $row_data){
                if((strlen($row_data) < $minlen)){// && (strlen($row_data) > $maxlen)){
                    return false;
                }
            }
            return true;
        }

        function CheckDate($data){
            $temp = explode('-',$data);
            return checkdate($temp[2],$temp[1],$temp[0]);
        }

        
        public function JSON_100(){ // Continue
            printf(json_encode(Array("statusCode"=>100)));
        }

        public function JSON_101(){ // Switching Protocol
            printf(json_encode(Array("statusCode"=>101)));
        }

        public function JSON_200(){ // Ok
            printf(json_encode(Array("statusCode"=>200)));
        }

        public function JSON_201(){ // Created
            printf(json_encode(Array("statusCode"=>201)));
        }

        public function JSON_202(){ // Accepted
            printf(json_encode(Array("statusCode"=>202)));
        }

        public function JSON_203(){ // Non-Authoritative Information
            printf(json_encode(Array("statusCode"=>203)));
        }

        public function JSON_204(){ // Non Content
            printf(json_encode(Array("statusCode"=>204)));
        }

        public function JSON_205(){ // Reset Content
            printf(json_encode(Array("statusCode"=>205)));
        }

        public function JSON_206(){ // Partail Content
            printf(json_encode(Array("statusCode"=>206)));
        }

        public function JSON_300(){ // Multiple Choice
            printf(json_encode(Array("statusCode"=>300)));
        }

        public function JSON_301(){ // Moved Perminently
            printf(json_encode(Array("statusCode"=>301)));
        }

        public function JSON_302(){ // Found
            printf(json_encode(Array("statusCode"=>302)));
        }

        public function JSON_303(){ // See Other
            printf(json_encode(Array("statusCode"=>303)));
        }

        public function JSON_304(){ // Not Modified
            printf(json_encode(Array("statusCode"=>304)));
        }

        public function JSON_305(){ // Use Proxy
            printf(json_encode(Array("statusCode"=>305)));
        }

        public function JSON_307(){ // Temporary Redirect
            printf(json_encode(Array("statusCode"=>307)));
        }

        public function JSON_400(){ // Bad Request
            printf(json_encode(Array("statusCode"=>400)));
        }

        public function JSON_401(){ // Unauthorized
            printf(json_encode(Array("statusCode"=>401)));
        }

        public function JSON_402(){ // Payment Required
            printf(json_encode(Array("statusCode"=>402)));
        }

        public function JSON_403(){ // Forbidden
            printf(json_encode(Array("statusCode"=>403)));
        }

        public function JSON_404(){ // Not Found
            printf(json_encode(Array("statusCode"=>404)));
        }

        public function JSON_405(){ // Method Not Allowed
            printf(json_encode(Array("statusCode"=>405)));
        }

        public function JSON_406(){ // Not Acceptable
            printf(json_encode(Array("statusCode"=>406)));
        }

        public function JSON_407(){ // Proxy Authentication Required
            printf(json_encode(Array("statusCode"=>407)));
        }

        public function JSON_408(){ // Request Timeout
            printf(json_encode(Array("statusCode"=>408)));
        }

        public function JSON_409(){ // Conflict
            printf(json_encode(Array("statusCode"=>409)));
        }        

        public function JSON_410(){ // Gone
            printf(json_encode(Array("statusCode"=>410)));
        }

        public function JSON_411(){ // Length Required
            printf(json_encode(Array("statusCode"=>411)));
        }

        public function JSON_412(){ // Precondition Faild.
            printf(json_encode(Array("statusCode"=>412)));
        }

        public function JSON_413(){ // Payload Too Large
            printf(json_encode(Array("statusCode"=>413)));
        }

        public function JSON_414(){ // URI Too Large
            printf(json_encode(Array("statusCode"=>414)));
        }

        public function JSON_415(){ // Unsupported Media Type
            printf(json_encode(Array("statusCode"=>415)));
        }

        public function JSON_416(){ // Range Not Satisfiable
            printf(json_encode(Array("statusCode"=>416)));
        }

        public function JSON_417(){ // Expecation Faild
            printf(json_encode(Array("statusCode"=>417)));
        }
        
        public function JSON_426(){ // Upgrade Required
            printf(json_encode(Array("statusCode"=>426)));
        }

        public function JSON_500(){ // Internal Server Error
            printf(json_encode(Array("statusCode"=>500)));
        }

        public function JSON_501(){ // Not Implimented
            printf(json_encode(Array("statusCode"=>501)));
        }

        public function JSON_502(){ // Bad Getway
            printf(json_encode(Array("statusCode"=>502)));
        }

        public function JSON_503(){ // Service Unavailable
            printf(json_encode(Array("statusCode"=>503)));
        }

        public function JSON_504(){ // Getway Timeout
            printf(json_encode(Array("statusCode"=>504)));
        }

        public function JSON_505(){ // Http Version Not Suppored
            printf(json_encode(Array("statusCode"=>505)));
        }

        public function JSON_SAVE(){ 
            printf(json_encode(Array("statusCode"=>"DATA_SAVE")));
        }

        public function JSON_EMPTY(){ 
            printf(json_encode(Array("statusCode"=>"EMPTY")));
        }

        public function JSON_LENGTH(){ 
            printf(json_encode(Array("statusCode"=>"DATA_LENGTH")));
        }

        public function JSON_PASSWORD(){ 
            printf(json_encode(Array("statusCode"=>"PASSWORD")));
        }

        public function JSON_PASSWORD_MIS(){ 
            printf(json_encode(Array("statusCode"=>"PASSWORD_MIS")));
        }

        public function JSON_EMAIL(){ 
            printf(json_encode(Array("statusCode"=>"EMAIL")));
        }

        public function JSON_PHONE(){ 
            printf(json_encode(Array("statusCode"=>"PHONE")));
        }

        public function JSON_PINCODE(){ 
            printf(json_encode(Array("statusCode"=>"PINCODE")));
        }

        public function JSON_FILE(){ 
            printf(json_encode(Array("statusCode"=>"FILE")));
        }

        public function JSON_FILE_SIZE(){ 
            printf(json_encode(Array("statusCode"=>"FILE_SIZE")));
        }

        public function JSON_FILE_FORMAT(){ 
            printf(json_encode(Array("statusCode"=>"FILE_FORMAT")));
        }

        public function JSON_FILE_EMPTY(){ 
            printf(json_encode(Array("statusCode"=>"FILE_EMPTY")));
        }

        public function JSON_DATE(){ 
            printf(json_encode(Array("statusCode"=>"DATE")));
        }

        public function JSON_GST(){
            printf(json_encode(Array("statusCode"=>"GST")));
        }

        public function JSON_URL(){
            printf(json_encode(Array("statusCode"=>"URL")));
        }

        public function JSON_GRANT_ADMIN(){
            printf(json_encode(Array("statusCode"=>"GRANT_ADMIN")));
        }

        public function JSON_VISIT_SITE(){
            printf(json_encode(Array("statusCode"=>"VISIT_SITE")));
        }
        public function JSON_ACCESS_REVOKE(){
            printf(json_encode(Array("statusCode"=>"REVOKE")));
        }

        public function JSON_DATA_EXIST(){
            printf(json_encode(Array("statusCode"=>"DATA_EXIST")));
        }

        public function JSON_NOTHING(){
            printf(json_encode(Array("statusCode"=>"NOTHING")));
        }

        // Check Indian Phone Number
        function CheckPhoneNumber($var){
            return preg_match("/^[6-9][0-9]{9}$/", $var) === 1 ? true : false;
            
        }

        // Check Valid Email Address
        function CheckEmail($var){
            return filter_var($var, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $var);
        }

        // Check Valid GST Number
        function CheckGST($var){
            return preg_match("/^([0-9]){2}([A-Za-z]){5}([0-9]){4}([A-Za-z]){1}([0-9]{1})([A-Za-z]){2}?$/", $var);
        }
        
        // Check Postal Code
        function CheckPinCode($var){
            return preg_match("/^[0-9]{6}$/", $var) === 1 ? true : false;
        }



        // Check MultipleImage
        function CheckMultipleImage($arr,$type,$min,$max){
            $flag = true;
            if(isset($arr) && count($arr) != 0){
                foreach ($arr as $key => $value) {
                    if(is_uploaded_file($value['tmp_name'])){
                        if(in_array(pathinfo($value['name'],PATHINFO_EXTENSION),$type)){
                            if($value['size'] > $min*1000 and $value['size'] < $max*1024*1000){
                                continue;
                            }
                            else{
                                $flag = false;
                                $this->JSON_FILE_SIZE();
                                break;
                            }
                        }else{
                            $flag = false;
                            $this->JSON_FILE_FORMAT();
                            break;
                        }   
                    }else{
                        $flag = false;
                        $this->JSON_FILE();
                        break;
                    }
                }    
            }
            else{
                $flag = false;
                $this->JSON_FILE_EMPTY();
            }
            return $flag;
        }

        // Check URI 
        function CheckUrl($uri){
            return filter_var($uri, FILTER_VALIDATE_URL) === FALSE ? false : true;
        }

        // Check Multiple URI
        function CheckMultipleUrl($arr){
            $flag = false;
            //print_r($arr);
            foreach ($arr as $value) {
                if(empty($value)){
                    continue;
                }else{
                    $flag = $this->CheckUrl($value) ? true : false;
                }
                
            }
            return $flag;
        }

        // Generate Unique Sequence From Copareing To The Database
        function FinalGenerateRandomSequence($length,$cmp_feild,$cmp_from_db_table){
            $no = bin2hex(openssl_random_pseudo_bytes($length));
            while (true) {
                if($r = $this->select(Array($cmp_feild),$cmp_from_db_table,"".$cmp_feild." ='".$no."'")){
                    $cnt = mysqli_num_rows($r);
                    if($cnt > 0 || $cnt == 1){
                        $no = bin2hex(openssl_random_pseudo_bytes($length));
                    }
                    else{
                        return $no;
                    }
                }   
            }
        }
    }

?>