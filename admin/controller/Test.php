<?php

    require_once('Functional.php');
    
    class Test extends Functional{
        function __construct(){
            echo __FILE__;
        }
    }

    $t = new Test();

?>