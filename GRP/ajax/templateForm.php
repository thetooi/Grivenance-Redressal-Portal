<?php
require_once('../include/config.php');
require_once('../include/session.php');

echo'<select class="form-control pull-left" style="width:94%" id="header">
	<option disabled selected>Select one header</option>';
echo $query="SELECT * FROM `printletterhead`";
$exec=mysql_query($query);
while($letterHead = mysql_fetch_array($exec)){
	echo'<option value="'.$letterHead[1].'$'.$letterHead[2].'">Header - '.$letterHead['header'].'&nbsp;&nbsp;&nbsp;&nbsp;Footer - '.$letterHead['footer'].'</option>';
}
echo'</select><button class = "btn btn-success pull-right" onClick="printFinal(\'table\')">Go</button>';	
			
?>
