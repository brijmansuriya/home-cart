<?php

    require_once('Auth.php');

    class Functional extends Auth
    {
        function __construct(){
           parent :: __construct();
        }
    }

    class Assets extends Functional{

        var $user_id;

        function __construct(){

            parent :: __construct();
            
            session_start();

            if(!isset($_SESSION['AccessToken'])){
                if(!isset($_SESSION['PublicKey'])){
                    $_SESSION['PublicKey'] = $this->PublicAccessToken();                   
                }
            }
            else{
                unset($_SESSION['PublicKey']);
            }

            $this->user_id = $this->GetClientIdByAccessTocken();
        }
    }    
    
?>