<?php
    try{
        if(!isset($_POST['action'])){
            header('location:403.php');    
        }
        require_once('SiteMaster.php');
        class SiteDataMaster extends SiteMaster{
            function __construct(){
                parent :: __construct();
            }
            function SaveSiteData($valueArr,$fileArr){
                $flag = false;
                if(isset($valueArr)){
                    array_pop($valueArr);
                    if(!$this->CheckTextEmpty($valueArr)){
                        $this->JSON_EMPTY();
                        return;
                    }
                    if(!$this->CheckStanardDatalength($valueArr,4)){
                        $this->JSON_LENGTH();
                        return;
                    }
                    if(!$this->CheckDate($valueArr['edt'])){
                        $this->JSON_DATE();
                        return;
                    }
                    if(!$this->CheckGST($valueArr['gst'])){
                        $this->JSON_GST();
                        return;
                    }
                    if(!$this->CheckPinCode($valueArr['pin'])){
                        $this->JSON_PINCODE();
                        return;
                    }
                    if(!$this->CheckEmail($valueArr['email'])){
                        $this->JSON_EMAIL();
                        return;
                    }
                    if(!$this->CheckPhoneNumber($valueArr['ph'])){
                        $this->JSON_PHONE();
                        return;
                    }
                    if($this->update('_ecm_site_mstr',$this->PureArray($valueArr,true,$this->conn),"1")){
                        $flag = true;
                    }
                }
                
                if(isset($fileArr)){
                    $t = Array('jpg','jpeg','png');
                    if($this->CheckMultipleImage($fileArr,$t,30,1)){
                        foreach ($fileArr as $key => $value) {
                            //print_r($key);
                            if($this->update('_ecm_site_mstr',Array($key=>addslashes(file_get_contents($value['tmp_name']))),"1")){
                                $flag = true;
                                continue;
                            }
                            else{
                                $this->JSON_500();
                                $flag = false;
                                break;
                            }
                        }
                    }
                    else{
                        $flag = false;
                    }
                }
                if($flag){
                    $this->JSON_SAVE();
                }
            }

            function SaveSocialLinks($arr){
                array_pop($arr);
                if($this->CheckMultipleUrl($arr)){
                    if($this->update('_ecm_site_mstr',$this->PureArray($arr,true,$this->conn),"1")){
                        $this->JSON_SAVE();
                    }
                    else{
                        $this->JSON_500();
                    }
                }
                else{
                    $this->JSON_URL();
                }
            }

            function SaveProfilePicture($file){
                $flag = false;
                $t = Array('jpg','jpeg','png');
                
                if($this->CheckMultipleImage($file,$t,50,1)){
                    
                        foreach ($file as $key => $value) {
                            
                            if($this->update('_ecm_site_mstr',Array($key=>addslashes(file_get_contents($value['tmp_name']))),"1")){
                                $flag = true;
                                continue;
                            }
                            else{
                                $this->JSON_500();
                                $flag = false;
                                break;
                            }
                        }
                    }
                if($flag){
                    $this->JSON_SAVE();
                }
            }

            function SaveAdminData($arr){
                if($this->CheckTextEmpty($arr)){
                    //print_r($arr);
                    if($this->SITE_DATA['PASSWORD'] != NULL){
                        if($this->SITE_DATA['PASSWORD'] == $this->EncryptHash($arr['old_pwd'],$arr['username'])){
                            //print($this->SITE_DATA['PASSWORD']);
                            //print($this->EncryptHash($arr['old_pwd'],$arr['username']));
                            array_pop($arr); 
                        }
                        else{
                            $this->JSON_PASSWORD_MIS();
                            return;
                        }
                    }
                    if($this->CheckPassword($arr['pwd']) && $arr['pwd'] == $arr['confrim_pwd']){
                        array_pop($arr);
                        array_pop($arr);
                        $arr['pwd'] = $this->EncryptHash($arr['pwd'],$arr['username']);
                        if($this->update('_ecm_site_mstr',$this->PureArray($arr,true,$this->conn),"1")){
                            $this->JSON_SAVE();
                        }
                        else{
                            $this->JSON_500();
                        }
                    }else{
                        $this->JSON_PASSWORD();
                    }
                }
                else{
                    $this->JSON_EMPTY();
                }
            }

            function SaveAboutUsPage($valueArr,$fileArr){
                $flag = false;
                if(isset($valueArr)){
                    array_pop($valueArr);
                    if(!$this->CheckTextEmpty($valueArr)){
                        $this->JSON_EMPTY();
                        return;
                    }
                    if(!$this->CheckStanardDatalength($valueArr,4)){
                        $this->JSON_LENGTH();
                        return;
                    }                   
                    
                    if($this->update('_ecm_aboutus_pg_mstr',$this->PureArray($valueArr,true,$this->conn),"1")){
                        $flag = true;
                    }
                }
                
                if(isset($fileArr)){
                    $t = Array('jpg','jpeg','png');
                    if($this->CheckMultipleImage($fileArr,$t,50,1)){
                        foreach ($fileArr as $key => $value) {
                            //print_r($key);
                            if($this->update('_ecm_aboutus_pg_mstr',Array($key=>addslashes(file_get_contents($value['tmp_name']))),"1")){
                                $flag = true;
                                continue;
                            }
                            else{
                                $this->JSON_500();
                                $flag = false;
                                break;
                            }
                        }
                    }
                    else{
                        $flag = false;
                    }
                }
                if($flag){
                    $this->JSON_SAVE();
                }
            }
        }    

        if(isset($_POST['action'])){
            $_s = new SiteDataMaster();
           switch ($_POST['action']) {
                case 'save_admin_data': // save_admin_data                    
                    $_s->SaveAdminData($_POST);
                    break;
                    
                case 'save_profile_pic':
                    $_s->SaveProfilePicture($_FILES);
                    break;
                
                case 'save_company_data':
                    $_s->SaveSiteData($_POST,$_FILES);
                    break;     

                case 'save_social_link':
                    $_s->SaveSocialLinks($_POST);
                    break;
                
                case 'save_aboutus_pg':
                    $_s->SaveAboutUsPage($_POST,$_FILES);
                    break;
                
                default:
                    break;
            }
        }      
        
    }
    catch(Exception $e){

    }
?>