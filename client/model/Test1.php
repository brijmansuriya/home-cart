<?php
    require_once('../../admin/controller/Functional.php');

    $a = new Assets();

    if(isset($_POST['action'])){
        $r = $a->select('','test',"1 LIMIT ".$_POST['from'].",".$_POST['to']."");

        while ($d = $a->fetch_assoc($r)){
            ?>
                <tr>
                    <td><?php print($d['EmpID']) ?></td>
                    <td><?php print($d['FirstName']) ?></td>
                    <td><?php print($d['EMail']) ?></td>
                </tr>
            <?php
        }
    }

?>