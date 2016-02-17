<?php

//function for top header menu
function top_header()
{
	echo'
	
		<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo"><b>GRP</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
		  
			</nav>
		  </header>
		
		';	

		  
		  

		  
}


//function for sidebar menu
function sidebar(){
	
	
	
		echo'
			<!-- Left side column. contains the logo and sidebar -->
		  <aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  
			  <!-- sidebar menu: : style can be found in sidebar.less -->
			  <ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<li id="home" class="treeview">
				  <a href="home.php">
					<i class="fa fa-files-o"></i> <span>Form</span></i>
				  </a>
				</li>
				<li id="grievances" class="treeview">
				  <a href="griever_viewGrievances.php">
					<span class="glyphicon glyphicon-list-alt"></span>
					<span>Grievances</span>
					</a>
				</li>
				<li id="search" class="treeview">
				  <a href="#">
					<span class="glyphicon glyphicon-search"></span><span>Search</span>
					<i class="fa fa-angle-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
					<li id="search_date"><a href="griever_searchGrievances.php?date">
					<i class="fa fa-circle-o"></i> by Date</a></li>
					<li id="search_category"><a href="griever_searchGrievances.php?category">
					<i class="fa fa-circle-o"></i> by Category</a></li>
					<li id="search_status"><a href="griever_searchGrievances.php?status">
					<i class="fa fa-circle-o"></i> by Status</a></li>
					<li id="search_ticketno"><a href="griever_searchGrievances.php?ticketno">
					<i class="fa fa-circle-o"></i> by Ticket Number</a></li>
				  </ul>
				</li>
				
				
			  </ul>
			</section>
			<!-- /.sidebar -->
		  </aside>
		
		';	
	
	
}




//function for inside main content
function content(){
	
	
	echo'
	
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Grievance Form
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Grievance Successfully Registered!</h4>
					<h5>It will be solved soon.<br>Your Ticket Number is '.$_GET['ticketno'].'</h5>
                  </div>';
		  elseif(isset($_GET['error']))
		  echo'<div class="alert alert-danger alert-dismissable" style="width:280px; float:left">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="icon fa fa-ban"></i> Error!</h4>
				</div>';
		elseif(isset($_GET['captchaerror']))
		  echo'<div class="alert alert-danger alert-dismissable" style="width:280px; float:left">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="icon fa fa-ban"></i> Captcha Mismatch!</h4>
				</div>';	
				
		 
				  
		  echo'
        
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Fill Grievance Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="griever/addGrievance.php" enctype="multipart/form-data">
                  <div class="box-body" style="width:50%">
				  
				  <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="category" id="category" onChange="displaySubcategory(this.value)">
					  	<option value="NULL" disabled selected>Select Category..</option>';
						
						//query to get categories
						$query="SELECT * FROM `category`";
						$exec=mysql_query($query);
						while($category=mysql_fetch_array($exec)){
						echo'<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
						}
					  echo'</select>	
                    </div>
					
					
                    <div class="form-group" id="subcategory" style="width:100%">

                    </div>

				  
                    <div class="form-group">
                      <label>Subject/Title</label>
                      <input required="required" type="text" name="title" class="form-control" 
					  id="exampleInputEmail1" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea required="required" class="form-control" name="description" rows="3" 
					  placeholder="Enter description ..."></textarea>
                    </div>
					<div class="form-group">
                      <label>Image</label>
                      <input type="file" name="fileToUpload" class="form-control" id="exampleInputEmail1">
                    </div>
					

					<div class="box-header" style="padding-top:20px; padding-bottom:20px">
					  <h3 class="box-title">Fill Sender Details</h3>
					</div><!-- /.box-header -->
					
					<!-- checkbox -->
					  <div class="form-group">
						<label>
						  <input id="anonymous" name="anonymous" type="checkbox" checked="checked"/>
						  Anonymous
						</label>
					  </div>
					  
					  
				  <div id="senderDetails" style="display:none">
                    <div class="form-group">
                      <label>Name</label>
                      <input onkeypress="return Alphabets(event);" type="text" id="name" name="name" class="form-control" placeholder="Enter name"/>
                    </div>
					<div class="form-group">
                      <label>UniqueID(USN/SSN)</label>
                      <input type="text" id="usn" name="usn" class="form-control" id="exampleInputEmail1" placeholder="Enter USN">
                    </div>
					<div class="form-group">
                      <label>Email</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter email"/>
                    </div>
					
					<div class="form-group" id="showDepartment">
                      <label>Semester* (optional)</label>
                      <input onkeyup="this.value = minmax(this.value)" type="text" id="sem" name="sem" class="form-control"/>
                    </div>
					
					  <div class="form-group" id="showDepartment">
                      <label>Department</label>
                      <select class="form-control" name="sender_department">
					  	<option value="NULL" disabled selected>Select Department..</option>';
						
						//query to get the department 
						$query="SELECT * FROM `department`";
						$exec=mysql_query($query);
						while($department=mysql_fetch_array($exec)){
						echo'<option value="'.$department['department_id'].'">'.$department['department_name'].'</option>';
						}
                      echo'
                      </select>
                    </div>
                  </div>
				  
				  <div class="form-group">
                      <label>Captcha</label></br>
					  <img src="include/captcha.php?rand=<?php echo rand();" />
					  can\'t read?<a href="home.php">click here</a> to refresh
                      <input type="text" name="captcha" class="form-control"/>
					  
                    </div>
				
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
			</div><!--col-->
			</div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

	
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
