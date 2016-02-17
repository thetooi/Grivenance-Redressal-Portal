<?php
require_once('include/session.php');
require_once('include/config.php');
/** Include PHPExcel */
require_once 'excel/Classes/PHPExcel.php';//change if necessary

//array for storing months
		$monthArray=array(
		1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July",
		8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
		);
		
		
		if(isset($_POST['year']))
			$year=$_POST['year'];
		else
			$year=2015;	
			
			
//query to get count of total grievances in this year
		$authority_id=$_SESSION['login_id'] ;
		//query to select committee member name to display
		
		$query_select = "SELECT `committeeMember_name`, `committeeMember_category_id`, committeeMember_department_id 
						FROM `committeemember`
						WHERE `committeeMember_id` = ".$authority_id."
						";
		$result = mysql_query($query_select);
		$user = mysql_fetch_array($result);
		
		$categoryID=$user[1];
		$department_id=$user[2];
		//for getting the new grievances/unseen grievances for notification
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$categoryID."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		$totalGrievanceCount=array();
		$pendingGrievanceCount=array();
		$solvedGrievanceCount=array();
		$month=1;
		while($month<=12){
			//query to count grievances in a particular month
			if($month<10){
				if($category[0]=="Department"){
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%'
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$totalGrievanceCount[$month]=$count['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$solvedGrievanceCount[$month]=$count['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$pendingGrievanceCount[$month]=$count['total'];
				}//end-if department
				else{
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%'
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$totalGrievanceCount[$month]=$count['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$solvedGrievanceCount[$month]=$count['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$pendingGrievanceCount[$month]=$count['total'];
				}//end-else not department
			}//end-if month<10
			
			else{
				if($category[0]=="Department"){
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%'
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$totalGrievanceCount[$month]=$count['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$solvedGrievanceCount[$month]=$count['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$pendingGrievanceCount[$month]=$count['total'];
				}//end-if department
				else{
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%'
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$totalGrievanceCount[$month]=$count['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$solvedGrievanceCount[$month]=$count['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$count=mysql_fetch_array($exec);
					$pendingGrievanceCount[$month]=$count['total'];
				}//end-else not department
			}//end-else month>=10
			$month++;
		}//end-while month<=12
				
				
				

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$F=$objPHPExcel->getActiveSheet();


$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20.2);  //0.33
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(36.2); //12
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.2);    //15.29
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.2);  //11.71
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20.2);  //5.14
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20.2);  //5.14



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'S.no.')
            ->setCellValue('B1', 'Month')
				->setCellValue('D1', 'Total Grievance')
			->setCellValue('C1', 'Solved Grievance')
		
			->setCellValue('E1', 'Pending Grievance')
			
			;
			
			
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
	$Line=3;
	$i=1;
	while($i<=12){
	
	
		  $F->setCellValue('A'.$Line, $i)
			->setCellValue('B'.$Line, $monthArray[$i])
			->setCellValue('D'.$Line, $totalGrievanceCount[$i])
			->setCellValue('C'.$Line, $solvedGrievanceCount[$i])
			->setCellValue('E'.$Line, $pendingGrievanceCount[$i])
			;//write in the sheet
		
$objPHPExcel->getActiveSheet()->getStyle('A'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->getActiveSheet()->getStyle('C'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('F'.$Line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//set new lines

   	   $i++;
	   ++$Line;
	}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=Report.xls');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

