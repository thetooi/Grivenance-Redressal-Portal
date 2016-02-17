<?php
require_once('../include/config.php');
$type = $_POST['type'];


echo '
<label>Sub Category</label>
              <select class="form-control" name="subcategory" id="subcategory">
              <option value="NULL" disabled selected>Select Sub Category..</option>';
            
            //query to get the department 
          echo  $query="SELECT * FROM `sub_category` WHERE category_id =".$type;
            $exec=mysql_query($query);
            while($department=mysql_fetch_array($exec)){
            echo'<option value="'.$department['sub_category'].'">'.$department['sub_category_name'].'</option>';
            }
echo '</select>';


?>