<?php

require_once('Auth.php');

class Functional extends Auth{
    function __construct(){
        parent::__construct();
    }
}

class AdminController extends Functional
{
    function __construct(){
       parent::__construct();

        session_start();
        if(!isset($_SESSION['AdminToken'])){
                header('location:login.php');
        }
    }
}

?>