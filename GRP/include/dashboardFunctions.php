<?php

//function for top header menu
function top_header()
{
	echo'
	
		<header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo"><b>GRP</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>';
		  
		  
		  
		  
		  //for admin
		  if($_SESSION['priv']==1){
			  
			  echo'<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				 
				  
				  <!-- User Account: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <span class="glyphicon glyphicon-user">
					  <span class="hidden-xs">Admin</span>
					</a>
					<ul class="dropdown-menu" role="menu">
					 
					 <li><a href="login/signout.php">Signout</a></li>
					 
					</ul>
				  </li>
				</ul>
			  </div>
			</nav>
		  </header>
		
		';	
		  }
		  
		  
	
//for authority
	elseif($_SESSION['priv']==2){
		
		
		$authority_id=$_SESSION['login_id'] ;
		//query to select committee member name to display
		
		$query_select = "SELECT `committeeMember_name`, `committeeMember_category_id`, committeeMember_department_id 
						FROM `committeemember`
						WHERE `committeeMember_id` = ".$authority_id."
						";
		$result = mysql_query($query_select);
		$user = mysql_fetch_array($result);
		$name=$user[0];
		
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
		if($category[0]=="Department"){
			$query="SELECT COUNT(`grievance_id`) as total FROM `grievance`
					WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
					AND `grievance_internalFlag`=0
					";
		}
		else{
			$query="SELECT COUNT(`grievance_id`) as total FROM `grievance`
				WHERE `grievance_category_id`=".$categoryID." AND `grievance_internalFlag`=0
				";
		}
		$exec=mysql_query($query);
		$notification=mysql_fetch_array($exec);
		
		 echo'<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				 
				  <!-- Notifications: style can be found in dropdown.less -->
				  <li class="notifications-menu">
					<a href="authority_grievance.php">
					  <i class="fa fa-bell-o"></i>
					  <span class="label label-warning">'.$notification['total'].'</span>
					</a>
				  </li>
				  <!-- User Account: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <span class="glyphicon glyphicon-user">
					  <span class="hidden-xs">'.$name .'</span>
					</a>
					<ul class="dropdown-menu" role="menu">
					 
					 <li><a href="login/signout.php">Signout</a></li>
					 
					</ul>
				  </li>
				</ul>
			  </div>
			</nav>
		  </header>
		
		';	
		
	}
		  
}


//function for sidebar menu
function sidebar(){
	
	
	//for admin
	if($_SESSION['priv']==1){
		echo'
			<!-- Left side column. contains the logo and sidebar -->
		  <aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  
			  <!-- sidebar menu: : style can be found in sidebar.less -->
			  <ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<li id="admin_dashboard" class="treeview">
				  <a href="dashboard.php">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
				  </a>
				</li>
				<li id="admin_authority" class="treeview">
				  <a href="#">
					<i class="fa fa-files-o"></i>
					<span>Manage Authority</span>
					<i class="fa fa-angle-left pull-right"></i>
					</a>
				   	<ul class="treeview-menu">
					<li id="admin_addAuthority"><a href="admin_addAuthority.php">
					<i class="fa fa-circle-o"></i> Add Authority</a></li>
					<li id="admin_editAuthority"><a href="admin_editDeleteAuthority.php">
					<i class="fa fa-circle-o"></i> Edit/Delete Authority</a></li>
				  </ul>
				</li>
				<li id="admin_categories" class="treeview">
				  <a href="#">
					<i class="fa fa-th"></i> <span>Manage Categories</span>
					<i class="fa fa-angle-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
					<li id="admin_addCategories"><a href="admin_addCategories.php">
					<i class="fa fa-circle-o"></i> Add Categories</a></li>
					<li id="admin_editCategories"><a href="admin_editDeleteCategories.php">
					<i class="fa fa-circle-o"></i> Edit/Delete Categories</a></li>
				  </ul>
				</li>


				<li id="admin_sub_categories" class="treeview">
				  <a href="#">
					<i class="fa fa-th"></i> <span>Manage Sub-Categories</span>
					<i class="fa fa-angle-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
					<li id="admin_add_sub_categories"><a href="admin_addSubCategories.php">
					<i class="fa fa-circle-o"></i> Add Sub-Categories</a></li>
					<li id="admin_edit_sub_categories"><a href="admin_editDeleteSubCategories.php">
					<i class="fa fa-circle-o"></i> Edit/Delete Sub-Categories</a></li>
				  </ul>
				</li>
				<li id="admin_letterhead" class="treeview">

				  <a href="admin_createLetterHead.php">
					<i class="fa fa-dashboard"></i> <span>Letter Head</span></i>
				  </a>
				</li>
				<li id="admin_report" class="treeview">
				  <a href="#">
					<i class="fa fa-pie-chart"></i>
					<span>View Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
					<li id="admin_department"><a href="admin_viewReportDepartment.php">
					<i class="fa fa-circle-o"></i> Department Report</a></li>
					<li id="admin_category"><a href="admin_viewReportCategory.php">
					<i class="fa fa-circle-o"></i> Category Report</a></li>
					<li id="admin_yearly"><a href="admin_viewReportYearly.php">
					<i class="fa fa-circle-o"></i> Yearly Report</a></li>
				  </ul>
				</li>
				
			  </ul>
			</section>
			<!-- /.sidebar -->
		  </aside>
		
		';	
	}
	
	
	
	
	
	//for authority
	
	elseif($_SESSION['priv']==2){
		
		echo'
			<!-- Left side column. contains the logo and sidebar -->
		  <aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  
			  <!-- sidebar menu: : style can be found in sidebar.less -->
			  <ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<li id="admin_dashboard" class="treeview">
				  <a href="dashboard.php">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
				  </a>
				</li>
				<li id="authority_grievance" class="treeview">
				  <a href="authority_grievance.php">
					<i class="fa fa-files-o"></i>
					<span>Grievance</span>
					<!--<i class="fa fa-angle-left pull-right"></i>-->
					</a>
				   <!--	<ul class="treeview-menu">
					<li id="admin_addAuthority"><a href="admin_addAuthority.php">
					<i class="fa fa-circle-o"></i> Add Authority</a></li>
					<li id="admin_editAuthority"><a href="admin_editDeleteAuthority.php">
					<i class="fa fa-circle-o"></i> Edit/Delete Authority</a></li>
				  </ul>-->
				</li>
				
				<li id="authority_report" class="treeview">
				  <a href="#">
					<i class="fa fa-pie-chart"></i>
					<span>View Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
					<li id="authority_yearly"><a href="authority_viewReportYearly.php"><i class="fa fa-circle-o"></i>
					 Yearly Report</a></li>
					
				  </ul>
				</li>
				
			  </ul>
			</section>
			<!-- /.sidebar -->
		  </aside>
		
		';	
		
		}
	
}




//function for inside main content
function content(){
	
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>

       <!-- Main content -->
        <section class="content">
          <div class="row">
';
			
			
			//for admin
			if($_SESSION['priv']==1){
				
				
				//query to get the total no. of grievances in the particular year
				$query="SELECT COUNT(*) as total FROM `grievance`
						WHERE `grievance_added_timestamp` LIKE '2015%'
						";
				$exec=mysql_query($query);
				$totalGrievanceCount=mysql_fetch_array($exec);
				$totalGrievanceCount=$totalGrievanceCount['total'];
				
				//query to get the total no. of solved grievances in the particular year
				$query="SELECT COUNT(*) as total FROM `grievance`
						WHERE `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=0
						";
				$exec=mysql_query($query);
				$solvedGrievanceCount=mysql_fetch_array($exec);
				$solvedGrievanceCount=$solvedGrievanceCount['total'];
				
				//query to get the total no. of pending grievances in the particular year
				$query="SELECT COUNT(*) as total FROM `grievance`
						WHERE `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=1
						";
				$exec=mysql_query($query);
				$pendingGrievanceCount=mysql_fetch_array($exec);
				$pendingGrievanceCount=$pendingGrievanceCount['total'];
				
					  	 echo'<!-- DONUT CHART -->
			  <div class="col-lg-12">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Grievance Chart</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
          </div><!-- /.row -->
		  
		  <div class="row">
		  
            
          </div><!-- /.row -->
        </section><!-- /.content -->
			  
		  </div>';
		  
		  
		  
		  echo'
		  <script type="text/javascript">
		  	//DONUT CHART
        var donut = new Morris.Donut({
          element: \'sales-chart\',
          resize: true,
          colors: ["#00c0ef", "#f39c12", "#00a65a"],
          data: [
            {label: "Total Grievance", value: '.$totalGrievanceCount.'},
            {label: "Pending", value: '.$pendingGrievanceCount.'},
            {label: "Solved", value: '.$solvedGrievanceCount.'}
          ],
          hideHover: \'auto\'
        });
		  </script>
		  ';
		  
			} //end if priv 1
			
			
			
				//for authority
			if($_SESSION['priv']==2){
				
				
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
				if($category[0]=="Department"){
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '2015%'
							";
					$exec=mysql_query($query);
					$totalGrievanceCount=mysql_fetch_array($exec);
					$totalGrievanceCount=$totalGrievanceCount['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$solvedGrievanceCount=mysql_fetch_array($exec);
					$solvedGrievanceCount=$solvedGrievanceCount['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID." AND `grievance_department_id`=".$department_id."
							AND `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$pendingGrievanceCount=mysql_fetch_array($exec);
					$pendingGrievanceCount=$pendingGrievanceCount['total'];
				}
				else{
					// count total number of grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '2015%'
							";
					$exec=mysql_query($query);
					$totalGrievanceCount=mysql_fetch_array($exec);
					$totalGrievanceCount=$totalGrievanceCount['total'];
					// count total number of solved grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=0
							";
					$exec=mysql_query($query);
					$solvedGrievanceCount=mysql_fetch_array($exec);
					$solvedGrievanceCount=$solvedGrievanceCount['total'];
					// count total number of pending grievances for the particular year
					$query="SELECT COUNT(*) as total FROM `grievance`
							WHERE `grievance_category_id`=".$categoryID."
							AND `grievance_added_timestamp` LIKE '2015%' AND `grievance_externalFlag`=1
							";
					$exec=mysql_query($query);
					$pendingGrievanceCount=mysql_fetch_array($exec);
					$pendingGrievanceCount=$pendingGrievanceCount['total'];
				}
				
				
				
					  	 echo'<!-- DONUT CHART -->
			  <div class="col-lg-12">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Grievance Chart</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
          </div><!-- /.row -->
		  
		  <div class="row">
		  

			  
		  </div>';
		  
			}//end of if priv 2
		    
        echo'</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	
	';
	
	
	 echo'
		  <script type="text/javascript">
		  	//DONUT CHART
        var donut = new Morris.Donut({
          element: \'sales-chart\',
          resize: true,
          colors: ["#00c0ef", "#f39c12", "#00a65a"],
          data: [
            {label: "Total Grievance", value: '.$totalGrievanceCount.'},
            {label: "Pending", value: '.$pendingGrievanceCount.'},
            {label: "Solved", value: '.$solvedGrievanceCount.'}
          ],
          hideHover: \'auto\'
        });
		  </script>
		  ';

}



//function for footer
function footer(){

	echo'
		<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">RVCE</a>.</strong> All rights reserved.
      </footer>
	
	';
	
}

?>
