<?php
    require_once("Functional.php");
    class ProductCategory extends Assets{
        function __construct(){
            parent :: __construct();
        }

        function CreateCatagoryTable(){
            $this->conn->query("
                    CREATE TABLE IF NOT EXISTS 
                        _ecm_catagory_mstr(
                            rec_id      varchar(10),
                            cat_name    varchar(50),
                            cat_desc    varchar(300),
                            cat_img     mediumblob,
                            p_cat       varchar(20),

                            PRIMARY KEY (rec_id),
                            CONSTRAINT SuperCatagory FOREIGN KEY (p_cat) REFERENCES _ecm_catagory_mstr(rec_id)
                        );

                    CREATE VIEW IF NOT EXISTS V_CAT_MSTR AS
                        SELECT  
                            c.rec_id    as `Record`, 
                            c.cat_name   as `Catagory`, 
                            c.cat_desc  as `CatDesc`, 
                            c.cat_img   as `CatImg`,
                            COALESCE(m.cat_name,c.cat_name) as `SuperCat`        
                        FROM _ecm_catagory_mstr c
                        LEFT OUTER JOIN _ecm_catagory_mstr m ON
                            c.p_cat = m.rec_id ORDER by c.cat_name ASC;
                
                    
                    DELIMITER $$                            
                    CREATE PROCEDURE IF NOT EXISTS AddCatagory (
                        IN  rec_id      varchar(10),
                        IN  cat_name    varchar(50),
                        IN  cat_desc    varchar(300),
                        IN  cat_img     mediumblob,
                        IN  p_cat       varchar(20)
                    )

                    BEGIN
                        INSERT INTO _ecm_catagory_mstr VALUES (rec_id,cat_name,cat_desc,cat_img,p_cat);
                    END$$

                    DELIMITER ;
                    
            ");
        }

        function GenerateCatagoryList(){
            $result = $this->select(Array("`Record`","`Catagory`"),"V_CAT_MSTR");
            ?> 
                <option value="-1" selected="selected">None</option>
            <?php
                while($data = mysqli_fetch_assoc($result)){
                    ?>
                        <option value="<?php printf($data["Record"]) ?>"><?php printf($data["Catagory"]) ?></option>
                    <?php
                }
        }

        function GenerateCatagoryTable($val = null){
            $result = $this->select('',"V_CAT_MSTR");
            if($val['action'] == 'SearchData')
            {
                $result = $this->select('','V_CAT_MSTR',"`Catagory` LIKE '%".mysqli_real_escape_string($this->conn,$val['search'])."%' OR `CatDesc` LIKE '%".mysqli_real_escape_string($this->conn,$val['search'])."%' OR `SuperCat` LIKE '%".mysqli_real_escape_string($this->conn,$val['search'])."%'");
            }
            
            $cnt = 0;
            ?>
                                        <thead>
                                                <tr>
                                                <th>Sr No</th>
                                                <th>Catagoty Name</th>
                                                <th>Image</th>
                                                <th>Parent Category</th>
                                                <th style="text-align:right">Operation</th>
                                            </tr>
                                        </thead>   
            <?php
            while($data = mysqli_fetch_assoc($result))
            {
                ?>
                  <tr>
                        <td>
                            <?php printf($cnt+1); $cnt++; ?>
                        </td>
                        <td>
                            <div class="table-data__info">
                                <h4><?php 
                                            if(strlen($data["Catagory"]) > 20){
                                                printf(substr($data["Catagory"],0,20)."...");    
                                            }else{
                                                printf($data["Catagory"]);
                                            }
                                    ?>
                                </h4>
                                <span>
                                    <h6>
                                        <?php 
                                            if(strlen($data["CatDesc"]) > 25){
                                                printf(substr($data["CatDesc"],0,25)."...");    
                                            }else{
                                                printf($data["CatDesc"]);
                                            }
                                        ?>
                                    </h6>
                                </span>
                            </div>
                        </td>
                        <td>
                            <?php echo("<img class='cat_icon' src='data:image/*;base64,".base64_encode($data['CatImg'])."'>"); ?>
                        </td>
                        <td><?php printf($data["SuperCat"]); ?></td>
                        <td>
                          <div class="table-data-feature">
                            <button class="item" onclick="UpdateData(this)" value="<?php printf($data["Record"]) ?>" data-placement="top" title="More" data-toggle="modal" data-target="#largeModal">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                          </div>
                      </td>
                    </tr>
                <?php
            }
            if($cnt < 1){
                ?>
                <tr>
                    <td colspan=4>
                        <h3>No Data To Show</h3>
                    </td>
                </tr>
                <?php
            }
        }        

        function GetSpecificCatagory($var){
            $rec_id = $var['rec_id'];
            if ($rec_id != ""){
                $result = $this->select(Array("`Catagory`","`CatDesc`"),'V_CAT_MSTR',"`Record`='".$rec_id."'");
                while($data = mysqli_fetch_assoc($result)){
                    printf(json_encode(Array("Catagory"=>html_entity_decode($data['Catagory'],ENT_QUOTES),
                                             "CatDesc"=>html_entity_decode($data['CatDesc'],ENT_QUOTES))));
                }
            }
        }

        function CheckCatagoryExist($cat_name){
            if($r = $this->select(Array("`Catagory`"),"V_CAT_MSTR","`Catagory`='".mysqli_real_escape_string($this->conn,$cat_name)."' AND `SuperCat`='".mysqli_real_escape_string($this->conn,$cat_name)."'")){
                $cnt = mysqli_num_rows($r);
                if($cnt > 0 || $cnt == 1){
                    return false;
                }
            }
            return true;
        }

        function AddCatagory($val,$file){
            try{
                array_pop($val);
                if($this->CheckTextEmpty($val) && !empty($file)){
                    if(strlen($val['cat_name']) < 3 || strlen($val['cat_name']) > 30){
                        $this->JSON_LENGTH();
                        return;
                    }
                    if(strlen($val['cat_desc']) < 3 || strlen($val['cat_desc']) > 250){
                        $this->JSON_LENGTH();
                        return;
                    }
                    if($this->CheckCatagoryExist($val['cat_name'])){
                        if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png','webp'),10,100)){
                            $data = Array(
                                'rec_id' => $this->FinalGenerateRandomSequence(10,'rec_id','_ecm_catagory_mstr'),
                                'cat_name' => $this->PureText($val['cat_name'],true,$this->conn),
                                'cat_desc' => $this->PureText($val['cat_desc'],true,$this->conn),
                                'cat_img' => addslashes(file_get_contents($file['cat_img']['tmp_name']))
                            );
                            if($val['parent_cat'] != -1){
                                $data + Array('p_cat' => $this->PureText($val['parent_cat'],true,$this->conn));
                            }
                            if($this->insert('_ecm_catagory_mstr',$data)){
                                $this->JSON_SAVE();
                            }
                            else{
                                $this->JSON_500();
                            }
                        }
                    }
                    else{
                        $this->JSON_DATA_EXIST();
                    }
                }
                else{
                    $this->JSON_EMPTY();
                }
            }
            
            catch(Exception $e){
                $this->JSON_500();
            }
        }

        function UpdateCatagory($val,$file){
            try{
                array_pop($val);
                if($this->CheckTextEmpty($val)){
                    if(strlen($val['cat_name']) < 3 || strlen($val['cat_name']) > 30){
                        $this->JSON_LENGTH();
                        return;
                    }
                    if(strlen($val['cat_desc']) < 3 || strlen($val['cat_desc']) > 250){
                        $this->JSON_LENGTH();
                        return;
                    }
                    $result_rows = mysqli_num_rows($this->select(Array("`Catagory`"),"V_CAT_MSTR","`Catagory`='".mysqli_real_escape_string($this->conn,$val['cat_name'])."' AND `Record`!='".mysqli_real_escape_string($this->conn,$val['rec_id'])."'"));
                    if($result_rows > 0){
                        printf(json_encode(Array("statusCode"=>"DUPLICATE_PARENT")));
                    }
                    else{
                        $data = Array(
                            'cat_name' => mysqli_real_escape_string($this->conn,$val['cat_name']),
                            'cat_desc' => mysqli_real_escape_string($this->conn,$val['cat_desc']),
                        );

                        if(!empty($file)){
                            if($this->CheckMultipleImage($file,Array('jpg','bmp','jpeg','png'),10,100)){
                                $data += Array('cat_img' => addslashes(file_get_contents($file['cat_img']['tmp_name'])));
                            }
                        }
                        if($this->update('_ecm_catagory_mstr',$data,"rec_id='".mysqli_real_escape_string($this->conn,$val['rec_id'])."'")){
                            printf(json_encode(Array("statusCode"=>"UPDATE")));
                        }
                        else{
                            $this->JSON_500();
                        }  
                    }
                }
                else{
                    $this->JSON_EMPTY();
                }
            }
            
            catch(Exception $e){
                $this->JSON_500();
            }
        }
    }   


    if(isset($_POST['action'])){
        $Catagory = new ProductCategory();
        switch ($_POST['action']) {
            case 'LoadCatagoryList':
                $Catagory->GenerateCatagoryList();
                break;

            case 'LoadCatagoryTable':
                $Catagory->GenerateCatagoryTable();
                break;

            case 'GetSpecificRecord':
                $Catagory->GetSpecificCatagory($_POST);
                break;

            case 'AddCatagory':
                $Catagory->AddCatagory($_POST,$_FILES);
                break;

            case 'UpdateCatagory':
                $Catagory->UpdateCatagory($_POST,$_FILES);
                break;

            case 'SearchData':
                $Catagory->GenerateCatagoryTable($_POST);
                break;
        }
    }
    
?>