<?php
    require_once('Functional.php');
    $a = new Assets();
    //$a->CommonRedirect();
    class ProductUnit extends Assets{

        function __construct(){
            parent :: __construct();
        }

        // Generate The HTML Drop Down
        function GenerateProductUnitDropDown(){
            /* Fatch Category And Assign To Drop Down */ 
            $result = $this->select('',"v_product_unit");
            ?> 
                <option value='-1' selected='selected'>None</option>
            <?php
                while($data = mysqli_fetch_assoc($result)){
                    ?>
                        <option value='<?php printf($data['REC_ID']) ?>'><?php printf(strtoupper($data['UNIT'])." | ".$data['ABV']); ?></option>
                    <?php
                }
        }
    }

    $pu = new ProductUnit();
    if(isset($_POST['action'])){
        switch ($_POST['action']) {
            case 'get_product_unit':
                $pu->GenerateProductUnitDropDown();
                break;
            default:
                $pu->JSON_403();
                break;
        }
    }
    else{
        $pu->JSON_403();
    }
?>