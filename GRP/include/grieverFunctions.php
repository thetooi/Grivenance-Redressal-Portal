<?php

//function to dispaly all grievances 
function viewGrievances()
{

	echo'
	
		<!-- Content Wrapper. Contains page content -->
				  <div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<section class="content-header">
					  <h1>
						Grievances
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Tables</a></li>
						<li class="active">Grievances</li>
					  </ol>
					</section>
			
					<!-- Main content -->
					<section class="content">
					  <div class="row">
						<div class="col-xs-12">
						<div class="box">
						<div class="box-header">
						  <h3 class="box-title">List of all Grievances</h3>
						  
						</div><!-- /.box-header -->
						<div class="box-body">
						  <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
							
						 <table id="grievanceTable" class="table table-bordered table-striped">
							<thead>
							  <tr>
							  <th>Ticket Number</th>
							  <th>User</th>
							  <th>Date</th>
							  <th>Category</th>
							  <th>Status</th>
							  <th>Title</th>
							</tr>
							</thead>
						  <tbody>';
						  
						  	//query to fetch grievances from the table grievance
							$query="SELECT * FROM `grievance` ORDER BY `grievance_id` DESC";
							$exec=mysql_query($query);
							
							while($grievance=mysql_fetch_array($exec)){
								
								//query to get the category name
								$querycategory="SELECT * FROM `category`
										WHERE `category_id`=".$grievance['grievance_category_id']."
										";
								$execcategory=mysql_query($querycategory);
								$category=mysql_fetch_array($execcategory);
												 
						  echo'<tr onclick="slide('.$grievance['grievance_id'].')">
								<td class="">RV'.$grievance['grievance_id'].'GR</td>
								<td class=" ">'.$grievance['grievance_sender_name'].'</td>
								<td class=" ">'.$grievance['grievance_added_timestamp'].'</td>
								<td>'.$category['category_name'].'</td> ';
								
								//to display pending/solved
								switch($grievance['grievance_externalFlag']){
									case 0:	$status="solved&nbsp;";$label="label label-success";break;
									case 1:	$status="pending";$label="label label-warning";break;
								}
								
								//to display seen/unseen/replied
								switch($grievance['grievance_internalFlag']){
									case 0:	$flag="not seen";break;
									case 1:	$flag="seen";break;
									case 2:	$flag="replied";break;
								}
								
								echo'<td class=" "><span class="'.$label.'">'.$status.'</span></td>
									<td class=" ">'.$grievance['grievance_title'].'
									<div style="font-size:x-small; float:right">'.$flag.'</div></td>
							  </tr>
							  
							  <!--tr to display full description of the grievance-->
							  
							  <tr>
								<td style="display:none" class="" id="displayme'.$grievance['grievance_id'].'" colspan="6" >
								<h4>'.$grievance['grievance_title'].'</h4>
								<hr>
								<pre style="border:none; font-family:inherit;
								background-color:white;">'.$grievance['grievance_description'].'</pre>';
								//if image is uploaded
								if($grievance['grievance_image_name']!="NULL"){
									echo'<a href="grievances/images/'.$grievance['grievance_image_name'].'">
										<img height="200px" width="200px" 
										src="grievances/images/'.$grievance['grievance_image_name'].'"/></a>';
								}
								
								//query to get the reply for the grievance
								$queryReply="SELECT * FROM `redressal`
											WHERE `grievance_id`=".$grievance['grievance_id']."
											";
								$execute=mysql_query($queryReply);
								//if reply is there
								if(mysql_num_rows($execute)){
									echo'<hr>
											<h4>Replies</h4>';
									while($redressal=mysql_fetch_array($execute)){
										
										//query to get committee member details
										$queryAuthority="SELECT * FROM `committeemember`
													WHERE `committeeMember_id`=".$redressal['redressal_committeeMember_id']."
													";
										$execAuthoriy=mysql_query($queryAuthority);
										$authority=mysql_fetch_array($execAuthoriy);
									
									   echo'By - '.$authority['committeeMember_name'].' : '.$authority['committeeMember_email'].'
										<br>On - '.$redressal['timestamp'].'
										<pre style="border:none; font-family:inherit;
												background-color:white;">'.$redressal['redressal_description'].'
										</pre>
												';
									}
								}
								//if no reply
								else
									echo'<hr><h4>No Replies</h4>';
								echo'</td>
								<td style="display:none" class=" "></td>
								<td style="display:none" class=" "></td>
								<td style="display:none" class=" "></td>
								<td style="display:none" class=" "></td>
							  </tr>';
							  
							}
							 
							 echo' </tbody>
							  </table>
							 
							  </div>
						</div><!-- /.box-body -->
					  </div>
					
					
					  </div><!-- /.box -->
					</div><!--col-->
					</div>   <!-- /.row -->
				</section><!-- /.content -->
			  </div><!-- /.content-wrapper -->
			
	';
}





//function to search grievances
function searchGrievances(){
	
	
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
				  <div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<section class="content-header">
					  <h1>
						Search
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Tables</a></li>
						<li class="active">Search Grievances</li>
					  </ol>
					</section>
			
					<!-- Main content -->
					<section class="content">
					  <div class="row">
						<div class="col-xs-12">
						<div class="box">
						<div class="box-header">
						  <h3 class="box-title">Search for Grievances</h3>
						  
						</div><!-- /.box-header -->
						<div class="box-body">
	
	';
	
	
	
	if(isset($_GET['date'])){
	//search by date
	
		echo'Enter Search Date
		<div class="input-group margin" style="width:25%">
		  <input id="searchDate" class="form-control" type="date">
		  <span class="input-group-btn">
			<button onclick="searchGrievance(\'searchDate\');" class="btn btn-info btn-flat" type="button">Go!</button>
		  </span>
		</div> 
		
		';	
	}
	
	elseif(isset($_GET['category'])){
	//search by category
	
		echo'Enter Search Category 
		<div class="input-group margin" style="width:25%">
                    
			<select class="form-control" id="searchCategory">
			<option disabled="disabled" selected="selected" value="NULL">Select Category</option>
		';
		
		//query to get the categories from category table
		$query="SELECT * FROM `category`";
		$exec=mysql_query($query);
		
		while($category=mysql_fetch_array($exec)){
			echo'
			<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
		}
		echo'</select>
		<span class="input-group-btn">
                      <button onclick="searchGrievance(\'searchCategory\');" class="btn btn-info btn-flat" type="button">
					  Go!</button>
                    </span>
                  </div> 
		
		';	
	}
	
	if(isset($_GET['status'])){
	//search by status
	
		echo'Enter Search Status 
		<div class="input-group margin" style="width:25%">
		 <select class="form-control" id="searchStatus">
			<option disabled="disabled" selected="selected" value="NULL">Select Status</option>
			<option value="0">Solved</option>
			<option value="1">Pending</option>
		</select>
		  <span class="input-group-btn">
			<button onclick="searchGrievance(\'searchStatus\');" class="btn btn-info btn-flat" type="button">Go!</button>
		  </span>
		</div> 
		
		';	
	}
	
	if(isset($_GET['ticketno'])){
	//search by ticketno
	
		echo'Enter Search Ticket No.
		<div class="input-group margin" style="width:25%">
		  <input id="searchTicketno" class="form-control" type="text">
		  <span class="input-group-btn">
			<button onclick="searchGrievance(\'searchTicketno\');" class="btn btn-info btn-flat" type="button">Go!</button>
		  </span>
		</div> 
		
		';	
	}
	
	echo'
	
	
								<div id="displayResult">
								
								</div>
	
								</div><!-- /.box-body -->
							</div>
					
					
					  </div><!-- /.box -->
					</div><!--col-->
					</div>   <!-- /.row -->
				</section><!-- /.content -->
			  </div><!-- /.content-wrapper -->
	
	';
	
}
?>