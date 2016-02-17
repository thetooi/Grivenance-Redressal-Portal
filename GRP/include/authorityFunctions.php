<?php
//to get outDated grievances
function get_outdated_grievances($timestamp, $flag){
	
	$currYear = date('Y');
	$currMonth = date('m');
	$currDate = date('d');
	
	$currDay = ($currYear*365) + ($currMonth*30) + ($currDate).' ';
	
	
		$timestamp = explode('-', $timestamp);
		$gYear = $timestamp[0];
		$gMonth = $timestamp[1];
		$gDate = explode(' ', $timestamp[2]);
		$gDate = $gDate[0];
		
		$gDay = ($gYear*365) + ($gMonth*30) + ($gDate);
		
		$Difference =  $currDay - $gDay;
		
		if($Difference>30 && $flag == 1)
			return 'OUTDATED';
		else
			return 'NOT'; 
		
}


// to read selected grievance
function read_grievance()
{
	
	
	 $title=$_GET['title'];

	$query_select = "SELECT * FROM grievance
	WHERE `grievance_id` LIKE '$title'
	";
	$result = mysql_query($query_select); 
	$user = mysql_fetch_array($result);
	$internal_flag=$user['grievance_internalFlag'];
	  
	  if($internal_flag==0)
	 {
		//to set internal flags when an authority sees a grievance
		$query_select = "UPDATE grievance SET `grievance_internalFlag`=1
		WHERE `grievance_id` LIKE '$title'
		";
		$result = mysql_query($query_select); 
		
	 }
	
	echo '
		 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" id="sec1">
          <h1>
            Read Mail
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
        
               <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>Solved</a></li>
                    <li><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow"></i> Pending</a></li>
					<li>
					
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>
					
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
               <div id="printGrievance">
                <div class="box-header with-border">
                
                
                
                  <h3 class="box-title">';
				  
				  
		//to read greivance selected
		$query_select = "SELECT * FROM `grievance`
		WHERE `grievance_id` LIKE '$title'
		";
		$result = mysql_query($query_select);

	$user = mysql_fetch_array($result);
	$rows = mysql_num_rows($result);
	if($rows)
	{
		$grie_description=$user['grievance_description'];
		$sender_email=$user['grievance_sender_name'];
		$time=$user['grievance_added_timestamp'];
		$griev_title=$user['grievance_title'];
		$grie_image_name=$user['grievance_image_name'];
	}
				  
				  
				  
				  echo $griev_title.'</h3>
                  <div class="box-tools pull-right">
                    <button onClick="printthis(\'printGrievance\')" class="btn btn-warning">Print Grievance</button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">';
				  
				  			  
		
	
				  
				  
				  
      echo'   
				  
     <h5>From: '.$sender_email.'<span class="mailbox-read-time pull-right">'.$time.'</span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                    <pre style="border:none; font-family:inherit;
								background-color:white;">'.$grie_description.'</pre>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                    ';
		
		// displayin the images attached in the grievances		
		  if($grie_image_name!="NULL")
			{
						
					echo'
							
								<li>
						  <span class="mailbox-attachment-icon has-img">
						  <img src="grievances/images/'.$grie_image_name.'" rel="lightbox" alt="Attachment"/></span>
						  <div class="mailbox-attachment-info">
							<a href="grievances/images/'.$grie_image_name.'" class="mailbox-attachment-name">
							<i class="fa fa-camera"></i> '.$grie_image_name.'</a>
							 
						  </div>
						</li>';
				
			}
	  
	  
	    echo'           
                  </ul>
				 <hr>
				 
				 
			
              	<div>
                <div class="box-header with-border">
				
                  <h3 class="box-title">REPLIES</h3>
                 
                </div><!-- /.box-header -->
                
                
                <div class="box-body no-padding">
				
                  <div class="mailbox-controls with-border">
				  
				  <button class="btn btn-alert" onclick="$(\'#showDepartment\').slideToggle()">Forward</button>
					<div class="form-group" id="showDepartment" style="display:none; margin:1%">
                      <form action="changeCategory.php?title='.$title.'" method="post">
                      <select class="form-control" name="department" style="width:25%" onChange="displaySubcategory(this.value)">
					  	<option value="NULL" disabled selected>Select Department..</option>';
						
						//query to get the department 
						$query="SELECT * FROM `category`";
						$exec=mysql_query($query);
						while($category=mysql_fetch_array($exec)){
						echo'<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
						}
                      echo'

                      </select>
                      <input type="hidden" name="id" value="'.$title.'">
                      <div class="form-group" id="subcategory">
                      </div>
                      <input type="submit">
                      </form>
                    </div>
                    
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message" id="replies">';
				  
				  
				  
		
		
		$query_select = "SELECT * FROM `redressal`
		WHERE `grievance_id` LIKE '$title'
		";
		$result = mysql_query($query_select);
		if($rows = mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				//query to get the name of committeemember who replied
				$query="SELECT `committeemember_name` FROM `committeemember`
						WHERE `committeemember_id`=".$user['redressal_committeeMember_id']."
						";
				$exec=mysql_query($query);
				$authority_name=mysql_fetch_array($exec);
				
					$redressal_description=$user['redressal_description'];
					$timestamp=$user['timestamp'];
					echo'
						<h5>FROM - '.$authority_name[0].' : '.$_SESSION['username'].'<span class="mailbox-read-time pull-right">'.$timestamp.'</span></h5><p>'.$redressal_description.'</p><hr>';
					
					
			}
		}
				  
				  
				  
			echo '	</div>
			
			
			</div><!--print Grievance-->';
			
			
			// to fetch grievance_externalFlag
		 $query_select = "SELECT * FROM grievance WHERE grievance_id = $title;
	";
	$result = mysql_query($query_select); 
	$user = mysql_fetch_array($result);
	$status=$user['grievance_externalFlag'];
	if($status==1)
	{
		echo 'Solved<button id="solved" class="btn btn-block btn-success btn-xs" 
			style="background-color:transparent;width:5%;height: 20px;" 
			onClick="changeColor(this.id,'.$title.');"></button>
		
		Pending<button class="btn btn-block btn-warning btn-xs" id="pending" 
		style="width:5%;height:20px" onClick="changeColor(this.id,'.$title.')"></button>';
		
	}
	else
	{
		echo 'Solved<button id="solved" class="btn btn-block btn-success btn-xs" id="success" 
			style="background-color:#00a65a;width:5%;height: 20px;" 
			onClick="changeColor(this.id,'.$title.');"></button>
		
		Pending<button class="btn btn-block btn-warning btn-xs" id="pending" 
		style="width:5%;height:20px;background-color:transparent" onClick="changeColor(this.id,'.$title.')"></button>';
	}
		
		
		
		
			
	echo'		<br>
					





		
			<form role="form">
				   <div class="form-group">
                      <label>REPLY</label>
				  
			
					  
					  
					  
					  
                      <textarea id="reply" class="form-control" rows="3" name="text1" placeholder="Enter Reply..."></textarea>
                    </div>
				
				</form>
		 				  	
				
                </div><!-- /.box-footer -->
                <div class="box-footer">
                  <div class="pull-right">
                    
				  </div>';
		
				  echo'	<button class="btn btn-default" id="btn1" onClick="add_reply('.$title.')"><i class="fa fa-reply"></i>Send</button>
                  
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
			

			
		
			
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
		
		  
	  ';
	  
	
	
	
}




//function to display grievance
function fetch_grievance(){
		
		
		
		//to obtain authority's category_id		
		$username=$_SESSION['username'];
	 	 $query_select_1 = "SELECT `committeeMember_category_id`, committeeMember_department_id FROM `committeemember`
		WHERE `committeeMember_email` LIKE '$username'
		";
		$result_1 = mysql_query($query_select_1);
		$user_1 = mysql_fetch_array($result_1);
		$category_id=$user_1['committeeMember_category_id'];
		$department_id=$user_1['committeeMember_department_id'];
				
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$category_id."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		if($category[0]=="Department"){
			$query="SELECT * FROM `grievance`
					WHERE `grievance_category_id`=".$category_id." AND `grievance_department_id`=".$department_id."
					ORDER BY `grievance_id` DESC";
		}
		else{
			$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id`=".$category_id."
				ORDER BY `grievance_id` DESC";
		}
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
	
	echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>Solved</a></li>
                    <li><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow"></i> Pending</a></li>
					<li>
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>
					
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
             </div><!-- /.col -->
			<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                    <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">';
					
                      
                 echo'     <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="dataTable" class="table table-hover">
                      <tbody>';
			  
		
		if($rows = mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				$griev_title=$user['grievance_title'];
				$griev_id=$user['grievance_id'];
				$timestamp=$user['grievance_added_timestamp'];
				
				$outdated = get_outdated_grievances($timestamp, $user['grievance_externalFlag']);
				
				$sender_name=$user['grievance_sender_name'];
				$image=$user['grievance_image_name'];
				$internal_flag=$user['grievance_internalFlag'];
				$subcategory_id=$user['grievance_subcategory_id'];
				if($subcategory_id == NULL)
					$subcategory_id = -1;

				 $s_query="SELECT * FROM `sub_category`
				WHERE `sub_category`=".$subcategory_id."";
				$s_result = mysql_query($s_query);
				$s_user = mysql_fetch_array($s_result);
				$subcategory_name=$s_user['sub_category_name'];
				
				if($image!="NULL")
				{
					$attach='<i class="fa fa-paperclip"></i>';
					
				}
				else
				{
					$attach="";
				}
				
				//to highlight if the grievance is seen or unseen
				if($internal_flag==0)
				{
					$bgColor = '#ecf0f5';
					
				}
				else
				{	
					$bgColor='';
				}
				//to highlight outdated grievances
				if($outdated == 'OUTDATED'){
					$bgColor = '#DD4B39';
				}
				echo'	<tr style="background-color:'.$bgColor.'">
                  
				  
                    	<td class="mailbox-name">RV'.$griev_id.'GR</td>
					
						<td class="mailbox-name">'.$sender_name.'</td>
						<td class="mailbox-subject"><a href="authority_readMail.php?title='.$griev_id.'">
						'.$griev_title.'</a></td>';

							

				if($subcategory_name==NULL)
				{
					$subcategory_name='';
					
				}
						echo'<td class="mailbox-name">'.$subcategory_name.'</td>
						 <td class="mailbox-attachment">'.$attach.'</td>
		                <td class="mailbox-date">'.$timestamp.'</td>
                  </tr>
				 
				  ';
				  
			}
			
		}
					  
                      
           echo '   
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <span class="btn btn-small bg-red" style="margin-left:2%">
          </span> - OutDated Grievances
          <span class="btn btn-small bg-grey" style="border-color:black; margin-left:2%">
          </span> - Unseen Grievances
          <span class="btn btn-small" style="background-color:white;margin-left:2%">
          </span> - Seen Grievances
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
	';

}

function sent_mail()
{
	echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
            <small>13 new messages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li class="active"><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>Solved</a></li>
                    <li><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow"></i> Pending</a></li>
					<li>
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
             </div><!-- /.col -->
			<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sent</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                    <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">';
					
                      
                 echo'     <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="dataTable" class="table table-hover">
                      <tbody>';
			  
		//to obtain authority's category_id		
		$username=$_SESSION['username'];
	 	 $query_select_1 = "SELECT * FROM `committeemember`
		WHERE `committeeMember_email` LIKE '$username'
		";
		$result_1 = mysql_query($query_select_1);
		$user_1 = mysql_fetch_array($result_1);
		$category_id=$user_1['committeeMember_category_id'];
		$department_id=$user_1['committeeMember_department_id'];
		
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$category_id."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		if($category[0]=="Department"){
			$query="SELECT * FROM `grievance`
					WHERE `grievance_category_id`=".$category_id." AND `grievance_department_id`=".$department_id."
					AND `grievance_internalFlag`=2 ORDER BY `grievance_id DESC`
					";
		}
		else{
			$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id`=".$category_id." AND `grievance_internalFlag`=2
				ORDER BY `grievance_id` DESC";
		}
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				$griev_title=$user['grievance_title'];
				$griev_id=$user['grievance_id'];
				$timestamp=$user['grievance_added_timestamp'];
				$sender_name=$user['grievance_sender_name'];
				$image=$user['grievance_image_name'];
				$internal_flag=$user['grievance_internalFlag'];
				
				if($image!="NULL")
				{
					$attach='<i class="fa fa-paperclip"></i>';
					
				}
				else
				{
					$attach="";
				}
				
				//to highlight if the grievance is seen or unseen
				if($internal_flag==0)
				{
				
					echo '<tr style="background-color:#ecf0f5">';
					
				}
				else
				{
					echo '<tr>';
				}
				echo'
                  
				  
                    	<td class="mailbox-name">RV'.$griev_id.'GR</a></td>
					
						<td class="mailbox-name">'.$sender_name.'</a></td>
						<td class="mailbox-subject"><a href="authority_readMail.php?title='.$griev_id.'">'.$griev_title.'</a></td>
						 <td class="mailbox-attachment">'.$attach.'</td>
		                <td class="mailbox-date">'.$timestamp.'</td>
                  </tr>
				 
				  ';
				  
			}
			
		}
					  
                      
           echo '   
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
	';	
	
}

function solved_grievance()
{
	echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
            <small>13 new messages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li class="active"><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>
					 Solved</a></li>
                    <li><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow"></i> Pending</a></li>
					<li>
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>
                   
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
             </div><!-- /.col -->
			<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Solved</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                    <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">';
					
                      
                 echo'     <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="dataTable" class="table table-hover">
                      <tbody>';
			  
		//to obtain authority's category_id		
		$username=$_SESSION['username'];
	 	 $query_select_1 = "SELECT * FROM `committeemember`
		WHERE `committeeMember_email` LIKE '$username'
		";
		$result_1 = mysql_query($query_select_1);
		$user_1 = mysql_fetch_array($result_1);
		$category_id=$user_1['committeeMember_category_id'];
		$department_id=$user_1['committeeMember_department_id'];
		
		//to display the grievance corresponding to the authority logged in....
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$category_id."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		if($category[0]=="Department"){
			$query="SELECT * FROM `grievance`
					WHERE `grievance_category_id`=".$category_id." AND `grievance_department_id`=".$department_id."
					AND `grievance_externalFlag`=0 ORDER BY `grievance_id` DESC
					";
		}
		else{
			$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id`=".$category_id." AND `grievance_externalFlag`=0
				ORDER BY `grievance_id` DESC";
		}
		$result = mysql_query($query);
		if($rows = mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				$griev_title=$user['grievance_title'];
				$griev_id=$user['grievance_id'];
				$timestamp=$user['grievance_added_timestamp'];
				$sender_name=$user['grievance_sender_name'];
				$image=$user['grievance_image_name'];
				$internal_flag=$user['grievance_internalFlag'];
				
				if($image!="NULL")
				{
					$attach='<i class="fa fa-paperclip"></i>';
					
				}
				else
				{
					$attach="";
				}
				
				//to highlight if the grievance is seen or unseen
				if($internal_flag==0)
				{
				
					echo '<tr style="background-color:#ecf0f5">';
					
				}
				else
				{
					echo '<tr>';
				}
				echo'
                  
				  
                    	<td class="mailbox-name">RV'.$griev_id.'GR</a></td>
					
						<td class="mailbox-name">'.$sender_name.'</a></td>
						<td class="mailbox-subject"><a href="authority_readMail.php?title='.$griev_id.'">'.$griev_title.'</a></td>
						 <td class="mailbox-attachment">'.$attach.'</td>
		                <td class="mailbox-date">'.$timestamp.'</td>
                  </tr>
				 
				  ';
				  
			}
			
		}
					  
                      
           echo '   
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
	';	
	
}


function pending_grievance()
{
	echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>Solved</a></li>
                    <li class="active"><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow">
					</i> Pending</a></li>
					<li>
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>                   
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
             </div><!-- /.col -->
			<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Pending</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                    <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">';
					
                      
                 echo'     <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="dataTable" class="table table-hover">
                      <tbody>';
			  
		//to obtain authority's category_id		
		$username=$_SESSION['username'];
	 	 $query_select_1 = "SELECT * FROM `committeemember`
		WHERE `committeeMember_email` LIKE '$username'
		";
		$result_1 = mysql_query($query_select_1);
		$user_1 = mysql_fetch_array($result_1);
		$category_id=$user_1['committeeMember_category_id'];
		$department_id=$user_1['committeeMember_department_id'];
		
		//to display the grievance corresponding to the authority logged in....
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$category_id."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		if($category[0]=="Department"){
			$query="SELECT * FROM `grievance`
					WHERE `grievance_category_id`=".$category_id." AND `grievance_department_id`=".$department_id."
					AND `grievance_externalFlag`=1 ORDER BY `grievance_id` DESC
					";
		}
		else{
			$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id`=".$category_id." AND `grievance_externalFlag`=1
				ORDER BY `grievance_id` DESC";
		}
		$result = mysql_query($query);
		if($rows = mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				$griev_title=$user['grievance_title'];
				$griev_id=$user['grievance_id'];
				$timestamp=$user['grievance_added_timestamp'];
				$sender_name=$user['grievance_sender_name'];
				$image=$user['grievance_image_name'];
				$internal_flag=$user['grievance_internalFlag'];
				
				if($image!="NULL")
				{
					$attach='<i class="fa fa-paperclip"></i>';
					
				}
				else
				{
					$attach="";
				}
				
				//to highlight if the grievance is seen or unseen
				if($internal_flag==0)
				{
				
					echo '<tr style="background-color:#ecf0f5">';
					
				}
				else
				{
					echo '<tr>';
				}
				echo'
                  
				  
                    	<td class="mailbox-name">RV'.$griev_id.'GR</a></td>
					
						<td class="mailbox-name">'.$sender_name.'</a></td>
						<td class="mailbox-subject"><a href="authority_readMail.php?title='.$griev_id.'">'.$griev_title.'</a></td>
						 <td class="mailbox-attachment">'.$attach.'</td>
		                <td class="mailbox-date">'.$timestamp.'</td>
                  </tr>
				 
				  ';
				  
			}
			
		}
					  
                      
           echo '   
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
	';	
	
}




//function to display grievances according to date searched
function date_grievance(){
	
	
	//get the date searched
	$date=$_POST['date'];
	
	
		echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="authority_grievance.php"><i class="fa fa-inbox"></i> Inbox </a></li>
                    <li><a href="authority_sentMail.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
			  
			  <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">SEARCH</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                     <li><a href="authority_solvedGrievance.php"><i class="fa fa-circle-o text-light-blue"></i>Solved</a></li>
                    <li class="active"><a href="authority_pendingGrievance.php"><i class="fa fa-circle-o text-yellow">
					</i> Pending</a></li>
					<li>
					<form method="post" action="authority_dateGrievance.php">
						<div class="input-group margin" style="width:25%">
						<input name="date" type="date" class="form-control" id="searchDate" />
						<span class="input-group-btn">
						  <input type="submit" class="btn btn-info btn-flat" type="button">Go!
						</span>
						</div>
					</form>
					</li>                   
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
             </div><!-- /.col -->
			<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Pending</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                    <button class="btn btn-default btn-sm" onclick="location.reload()"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">';
					
                      
                 echo'     <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="dataTable" class="table table-hover">
                      <tbody>';
			  
		//to obtain authority's category_id		
		$username=$_SESSION['username'];
	 	 $query_select_1 = "SELECT * FROM `committeemember`
		WHERE `committeeMember_email` LIKE '$username'
		";
		$result_1 = mysql_query($query_select_1);
		$user_1 = mysql_fetch_array($result_1);
		$category_id=$user_1['committeeMember_category_id'];
		$department_id=$user_1['committeeMember_department_id'];
		
		//to display the grievance corresponding to the authority logged in....
		//query to get the category name
		$query="SELECT `category_name` FROM `category`
				WHERE `category_id`=".$category_id."
				";
		$exec=mysql_query($query);
		$category=mysql_fetch_array($exec);
		//if category is department
		if($category[0]=="Department"){
			$query="SELECT * FROM `grievance`
					WHERE `grievance_category_id`=".$category_id." AND `grievance_department_id`=".$department_id."
					AND `grievance_added_timestamp` LIKE '".$date."%' ORDER BY `grievance_id` DESC
					";
		}
		else{
			$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id`=".$category_id."
				AND `grievance_added_timestamp` LIKE '".$date."%' ORDER BY `grievance_id` DESC";
		}
		$result = mysql_query($query);
		if($rows = mysql_num_rows($result)>0)
		{
			while($user = mysql_fetch_array($result))
			{
				
				$griev_title=$user['grievance_title'];
				$griev_id=$user['grievance_id'];
				$timestamp=$user['grievance_added_timestamp'];
				$sender_name=$user['grievance_sender_name'];
				$image=$user['grievance_image_name'];
				$internal_flag=$user['grievance_internalFlag'];
				
				if($image!="NULL")
				{
					$attach='<i class="fa fa-paperclip"></i>';
					
				}
				else
				{
					$attach="";
				}
				
				//to highlight if the grievance is seen or unseen
				if($internal_flag==0)
				{
				
					echo '<tr style="background-color:#ecf0f5">';
					
				}
				else
				{
					echo '<tr>';
				}
				echo'
                  
				  
                    	<td class="mailbox-name">RV'.$griev_id.'GR</a></td>
					
						<td class="mailbox-name">'.$sender_name.'</a></td>
						<td class="mailbox-subject"><a href="authority_readMail.php?title='.$griev_id.'">'.$griev_title.'</a></td>
						 <td class="mailbox-attachment">'.$attach.'</td>
		                <td class="mailbox-date">'.$timestamp.'</td>
                  </tr>
				 
				  ';
				  
			}
			
		}
					  
                      
           echo '   
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
	';	
	
	
}



//function to display yearly report for authority
function authority_yearlyReport(){

	//array for storing months
		$monthArray=array(
		1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July",
		8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
		);
		
		
		if(isset($_POST['year']))
			$year=$_POST['year'];
		else
			$year=2015;	
		
		
		echo'
		
		
			<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Report
          </h1>
		  ';
		  

		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Yearly Report '.$year.'</h3>
                </div><!-- /.box-header -->
				
				
				
                <div class="box-body">
					<form class="pull-left" style="width:20%" method="post" action="admin_viewReportYearly.php">
						<div class="input-group margin" style="width:100%">
							 <select class="form-control" name="year">
								<option disabled="disabled" selected="selected" value="NULL">Select Year</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
							  </select>
							  <span class="input-group-btn">
								<input type="submit" class="btn btn-info btn-flat" type="button">Go!</input>
							  </span>
							  					  
						</div>
						
					</form>';
				
				
				
			
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
				
				
		
		
		
		/*print_r($totalGrievanceCount);
		echo'<br />';
		print_r($solvedGrievanceCount);
		echo'<br />';
		print_r($pendingGrievanceCount);*/
		
		
						
					echo'
					<button class="btn btn-success pull-right">
						<a style="color:white" href="./download_excel_authority_yearly_report.php" target="_blank">
						Download EXCEL</a>
					</button>
					<input class="pull-right" type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
					<span class="glyphicon glyphicon-search pull-right"></span>
					<button class="btn btn-block btn-primary" onclick="printthis()">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
				  <div style="width:100%" id="selectTemplate"></div>
				  <div id="table">
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  	<th>ID</th>
                        <th>Month</th>
                        <th>#Total Grievances</th>
						<th>#Solved Grievances</th>
						<th>#Pending Grievances</th>
                      </tr>
                    </thead>
                    <tbody>';
					$i=1;
					while($i<=12){
						echo'<tr>
								<td align="center">'.$i.'</td>
								<td align="center">'.$monthArray[$i].'</td>
								<td align="center">'.$totalGrievanceCount[$i].'</td>
								<td align="center">'.$solvedGrievanceCount[$i].'</td>
								<td align="center">'.$pendingGrievanceCount[$i].'</td>
							</tr>';
							
							
							
							$i++;
					}
					echo'</tbody>
                  </table>
                 
				</div>

                  
                </form>
				</div>
              </div><!-- /.box -->
			</div><!--col-->
			</div>   <!-- /.row -->
		
			
			
			<div class="row">
            <div class="col-lg-10">
			 <!-- BAR CHART -->
			 <button class="btn btn-block btn-primary" onclick="printthis(\'graph\')">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
              <div id="graph" class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Bar Chart</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  </div><!--col-->
			  
			  
			  
			</div>   <!-- /.row -->
			
			
         </div><!-- /.box-body -->
				
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
		
		';
		
		
		//for bar chart
		
		echo"<script type='text/javascript'>
		//BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [";
		  
		  $i=1;
			while($i<=12){
				echo"{y: '".$monthArray[$i]."', a: ".$totalGrievanceCount[$i].", b: ".$solvedGrievanceCount[$i].", c: ".$pendingGrievanceCount[$i]."},
				";
				$i++;
			}
         echo" ],
          barColors: ['#00c0ef', '#00a65a','#f39c12'],
          xkey: 'y',
          ykeys: ['a', 'b', 'c'],
          labels: ['Total', 'Solved', 'Pending'],
          hideHover: 'auto'
        });
				</script>";

	
}




?>
