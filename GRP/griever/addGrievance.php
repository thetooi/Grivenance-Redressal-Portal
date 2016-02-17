<?php
require_once('../include/config.php');
require_once('../include/session.php');


date_default_timezone_set("Asia/Kolkata");

$date=date("Y-m-d H:i:s");

$title=$_POST['title'];
$description=$_POST['description'];
$category=$_POST['category'];
echo $subcategory=$_POST['subcategory'];
//check whether category is department or not
//query to get category name
$query="SELECT `category_name` FROM `category`
		WHERE `category_id`=".$category."
		";
$exec=mysql_query($query);
$category_name=mysql_fetch_array($exec);

if(isset($_POST['department']) && $category_name[0]=="Department")
	$department=$_POST['department'];
else
	$department="NULL";


//if anonymous
if(isset($_POST['anonymous'])){
	$anonymous=$_POST['anonymous'];
	$name="Anonymous";
	$usn="NULL";
	$email="NULL";
	$semester=-1;
	$sender_department="NULL";
	$captcha="NULL";
}
else{
	$name=$_POST['name'];	
	$usn=$_POST['usn'];
	$email=$_POST['email'];
	$semester=$_POST['sem'];
	$sender_department=$_POST['sender_department'];
}

$captcha=$_POST['captcha'];
if($captcha!=$_SESSION['captcha_code']){
	//captcha mismatch
	echo"wrong captcha";	
	header('Location: ../home.php?captchaerror');
}

else{
	
	if($_FILES["fileToUpload"]["name"]==NULL)
		$filename="NULL";
	else
		$filename=$_FILES["fileToUpload"]["name"];
	//to upload the image if given
	$target_dir = "../grievances/images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	/*if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}*/
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 900000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";			
			
		} else {
			echo "Sorry, there was an error searching your file.";
		}
	}	
	
	
	
	//query to add the grievance in table grievance
	echo $query="INSERT INTO `grievance`
			(`grievance_title`, `grievance_description`, `grievance_image_name`, `grievance_category_id`,
			 `grievance_department_id`, `grievance_sender_name`, `grievance_sender_USN`, `grievance_sender_email`, 
			 `grievance_sender_sem`, `grievance_sender_department_id`, `grievance_internalFlag`, `grievance_externalFlag`,
			  `grievance_added_timestamp`,`grievance_subcategory_id`)
			  VALUES (
			  '".$title."', '".$description."', '".$filename."', ".$category.",
			  ".$department.", '".$name."', '".$usn."', '".$email."',
			  ".$semester.", ".$sender_department.", 0, 1, '".$date."', ".$subcategory.")";
	 $exec=mysql_query($query);
	if($exec){
		//success
		//query to get the grievance id to display ticket number : RV<grievance_id>GR
		$ticket = mysql_insert_id();
		header('Location: ../home.php?success&ticketno=RV'.$ticket.'GR');
			
	}
	else
		header('Location: ../home.php?error');

}

?>