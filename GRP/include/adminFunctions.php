<?php

//function to add authority
function addAuthority(){
	
	
	echo'
		
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Add Authority
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Authority Added Successfully!</h4>
                  </div>';
		  elseif(isset($_GET['error']))
		  echo'<div class="alert alert-danger alert-dismissable" style="width:280px; float:left">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="icon fa fa-ban"></i> Error In Adding Authority!</h4>
				</div>';
		  elseif(isset($_GET['passNotMatch']))
			echo'<div class="alert alert-warning alert-dismissable" style="width:280px; float:left">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> Password doesnot match!</h4>
				  </div>';
				  
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Authority</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Authority Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="admin/addAuthority.php">
                  <div class="box-body" style="width:50%">
				  
                    <div class="form-group">
                      <label>Authority Name</label>
                      <input onkeypress="return Alphabets(event);" required="required" type="text" name="name" class="form-control" 
					  id="exampleInputEmail1" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label>Authority E-mail</label>
                      <div class="input-group">
						<span class="input-group-addon">@</span>
						<input required="required" type="email" name="email" class="form-control" placeholder="Email">
					  </div>
                    </div>
					<div class="form-group">
                      <label>Authority Password</label>
                      <input required="required" type="password" name="password" class="form-control" id="exampleInputEmail1" 
					  placeholder="Enter password">
                    </div>
					<div class="form-group">
                      <label>Confirm Password</label>
                      <input required="required" type="password" name="repassword" class="form-control" id="exampleInputEmail1" 
					  placeholder="ReEnter password">
                    </div>
					<div class="form-group">
                      <label>Authority Category</label>
                      <select class="form-control" name="category">
					  	
					  	<option value="NULL" disabled selected>Select Category..</option>';
					  
					  //query to get categories from table category
					$query="SELECT * FROM `category`";
					$exec=mysql_query($query);
					while($category=mysql_fetch_array($exec)){
					echo'
                        <option value="'.$category['category_id'].'">'.$category['category_name'].'</option>
                        ';
					}
						
					echo'
                      </select>
                    </div>
					<div class="form-group">
                      <label>Authority Department</label>
                      <select class="form-control" name="department">
                        <option value="NULL" disabled selected>Select Department..</option>';
						
						
						//query to get departments from table department
						$query="SELECT * FROM `department`";
						$exec=mysql_query($query);
						while($department=mysql_fetch_array($exec)){
						echo'
                        <option value="'.$department['department_id'].'">'.$department['department_name'].'</option>
                        ';
						
						}
                      echo'
					  </select>
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





//function to edit or delete authority
function editDeleteAuthority(){
	
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding-right:25%; padding-bottom:20px; float:left">
            Authorities
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Authority Successfully Deleted!</h4>
                  </div>';
		  elseif(isset($_GET['error']))
		  	echo'<div class="alert alert-warning alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error In Deleting Authority!</h4>
                  </div>';
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">authorities</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Authorities</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Category</th>
                        <th>Department</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					';
					
					
					//query to retrieve all the authorities information from table committeemember
					$query="SELECT * FROM `committeemember`";
					$execauthority=mysql_query($query);
					
					while($authority=mysql_fetch_array($execauthority)){
						
						//query to get department name from id
						$query="SELECT `department_name` FROM `department`
								WHERE `department_id` = ".$authority['committeeMember_department_id']."
								";
						$exec=mysql_query($query);
						$department=mysql_fetch_array($exec);
						$department=$department[0];
						
						//query to get category name from id
						$query="SELECT `category_name` FROM `category`
								WHERE `category_id` = ".$authority['committeeMember_category_id']."
								";
						$exec=mysql_query($query);
						$category=mysql_fetch_array($exec);
						$category=$category[0];
						
						echo'
						<tr>
							<td>'.$authority['committeeMember_id'].'</td>
							<td>'.$authority['committeeMember_name'].'</td>
							<td>'.$authority['committeeMember_email'].'</td>
							<td>'.$category.'</td>
							<td>'.$department.'</td>
							<td><button onClick="deleteAuthority('.$authority['committeeMember_id'].')" type="button" 
							class="btn btn-danger">
							<span class="glyphicon glyphicon-trash"></span></button>
							<a href="admin_editAuthority.php?authorityID='.$authority['committeeMember_id'].'">
							<button type="button" class="btn btn-default">
							<span class="glyphicon glyphicon-pencil"></span></button></a>
							</td>
						  </tr>';
					}
					  echo'</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	
	';
}








//function to edit Authority
function editAuthority(){
	
	
	//query to get details of the authority to edit
	$query="SELECT * FROM `committeemember`
			WHERE `committeeMember_id`=".$_GET['authorityID']."
			";
			
	$exec=mysql_query($query);
	$authority=mysql_fetch_array($exec);


	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Edit Authority
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Added Successfully!</h4>
                  </div>';
		  elseif(isset($_GET['error']))
		  echo'<div class="alert alert-danger alert-dismissable" style="width:280px; float:left">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="icon fa fa-ban"></i> Error!</h4>
				</div>';
		  elseif(isset($_GET['passNotMatch']))
			echo'<div class="alert alert-warning alert-dismissable" style="width:280px; float:left">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> Password not match!</h4>
				  </div>';
				  
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Authority</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Authority Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" 
				action="admin/editAuthority.php?authorityID='.$authority['committeeMember_id'].'">
                  <div class="box-body" style="width:50%">
				  
                    <div class="form-group">
                      <label>Authority Name</label>
                      <input required="required" type="text" name="name" class="form-control" 
					  id="exampleInputEmail1" placeholder="Enter name" value="'.$authority['committeeMember_name'].'">
                    </div>
                    <div class="form-group">
                      <label>Authority E-mail</label>
                      <div class="input-group">
						<span class="input-group-addon">@</span>
						<input required="required" type="email" name="email" class="form-control" placeholder="Email"
						value="'.$authority['committeeMember_email'].'">
					  </div>
                    </div>
					<div class="form-group">
                      <label>Authority Password</label>
                      <input required="required" type="password" name="password" class="form-control" id="exampleInputEmail1" 
					  placeholder="Enter password">
                    </div>
					<div class="form-group">
                      <label>Confirm Password</label>
                      <input required="required" type="password" name="repassword" class="form-control" id="exampleInputEmail1" 
					  placeholder="ReEnter password">
                    </div>
					<div class="form-group">
                      <label>Authority Category</label>
                      <select class="form-control" name="category">
					  	
					  	<option value="NULL" disabled selected>Select Category..</option>';
					  
					  //query to get categories from table category
					$query="SELECT * FROM `category`";
					$exec=mysql_query($query);
					while($category=mysql_fetch_array($exec)){
					echo'
                        <option value="'.$category['category_id'].'">'.$category['category_name'].'</option>
                        ';
					}
						
					echo'
                      </select>
                    </div>
					<div class="form-group">
                      <label>Authority Department</label>
                      <select class="form-control" name="department">
                        <option value="NULL" disabled selected>Select Department..</option>';
						
						
						//query to get departments from table department
						$query="SELECT * FROM `department`";
						$exec=mysql_query($query);
						while($department=mysql_fetch_array($exec)){
						echo'
                        <option value="'.$department['department_id'].'">'.$department['department_name'].'</option>
                        ';
						
						}
                      echo'
					  </select>
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








//function to addcategories
function addCategories(){
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Add Category
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Category Added Successfully!</h4>
                  </div>';
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Category Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="asp/xmlform.php">
                  <div class="box-body" style="width:50%">
                    <div class="form-group">
                      <label>Category Name</label>
                      <input required="required" type="text" name="name" class="form-control" 
					  id="exampleInputEmail1" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label>Category Description</label>
                      <textarea required="required" class="form-control" name="description" rows="3" 
					  placeholder="Enter description ..."></textarea>
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



function addSubCategories(){
  
  echo'
  
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Add Sub-Category
          </h1>
      ';
      if(isset($_GET['success']))
        echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Sub-Category Added Successfully!</h4>
                  </div>';
      echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Sub-Category Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="admin/addSubCategory.php">
                


                  <div class="box-body" style="width:50%">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="category" id="category">
              <option value="NULL" disabled selected>Select Parent Category..</option>';
            
            //query to get categories
            $query="SELECT * FROM `category`";
            $exec=mysql_query($query);
            while($category=mysql_fetch_array($exec)){
            echo'<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
            }
            echo'</select>  
                    </div>

                    <div class="form-group" id="showDepartment" style="display:none">
                      <label>Department</label>
                      <select class="form-control" name="department">
              <option value="NULL" disabled selected>Select Department..</option>';
            
            //query to get the department 
            $query="SELECT * FROM `department`";
            $exec=mysql_query($query);
            while($department=mysql_fetch_array($exec)){
            echo'<option value="'.$department['department_id'].'">'.$department['department_name'].'</option>';
            }
                      echo'</select>
                    </div>

                      <div class="form-group">
                      <label>Sub-Category Name</label>
                      <input required="required" type="text" name="name" class="form-control" 
            id="exampleInputEmail1" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                      <label>Sub-Category Description</label>
                      <textarea required="required" class="form-control" name="description" rows="3" 
            placeholder="Enter description ..."></textarea>
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






//function to edit/delete categories
function editDeleteCategory(){
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding-right:25%; padding-bottom:20px; float:left">
            Categories
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Successfully Done!</h4>
                  </div>';
		  elseif(isset($_GET['error']))
		  	echo'<div class="alert alert-warning alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                  </div>';
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Categories</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<span class="glyphicon glyphicon-search"></span>
					<input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  	<th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					';
					
					
					//query to retrieve all the categories information from table category
					$query="SELECT * FROM `category`";
					$exec=mysql_query($query);
					
					while($category=mysql_fetch_array($exec)){
						
						
						echo'
						<tr>
							<td>'.$category['category_id'].'</td>
							<td>'.$category['category_name'].'</td>
							<td>'.$category['category_description'].'</td>
							<td><button onClick="deleteCategory('.$category['category_id'].')" type="button" 
							class="btn btn-danger">
							<span class="glyphicon glyphicon-trash"></span></button>
							<a href="admin_editCategory.php?categoryID='.$category['category_id'].'">
							<button type="button" class="btn btn-default">
							<span class="glyphicon glyphicon-pencil"></span></button></a>
							</td>
						  </tr>';
					}
					  echo'</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	
	
	';
	
}


function editDeleteSubCategory(){
  
  echo'
  
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding-right:25%; padding-bottom:20px; float:left">
            Categories
          </h1>
      ';
      if(isset($_GET['success']))
        echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Successfully Done!</h4>
                  </div>';
      elseif(isset($_GET['error']))
        echo'<div class="alert alert-warning alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                  </div>';
      echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
      <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Sub Categories</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
          <span class="glyphicon glyphicon-search"></span>
          <input type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
              <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
            <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
          ';
          
          
          //query to retrieve all the categories information from table category
          $query="SELECT * FROM `sub_category`";
          $exec=mysql_query($query);
          
          while($category=mysql_fetch_array($exec)){
            
            
            echo'
            <tr>
              <td>'.$category['sub_category'].'</td>
              <td>'.$category['sub_category_name'].'</td>
              <td>'.$category['sub_category_description'].'</td>
              <td><button onClick="deleteSubCategory('.$category['sub_category'].')" type="button" 
              class="btn btn-danger">
              <span class="glyphicon glyphicon-trash"></span></button>
              <a href="admin_editSubCategory.php?categoryID='.$category['sub_category'].'">
              <button type="button" class="btn btn-default">
              <span class="glyphicon glyphicon-pencil"></span></button></a>
              </td>
              </tr>';
          }
            echo'</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
  
  ';
  
}






//function to edit Category
function editCategory(){
	
	$categoryID=$_GET['categoryID'];
	//query to get category details
	$query="SELECT * FROM `category`
			WHERE `category_id`=".$categoryID."
			";
	$exec=mysql_query($query);
	$category=mysql_fetch_array($exec);
	
	
	
	echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Edit Category
          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Added Successfully!</h4>
                  </div>';
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Category Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="admin/editCategory.php?categoryID='.$categoryID.'">
                  <div class="box-body" style="width:50%">
                    <div class="form-group">
                      <label>Category Name</label>
                      <input required="required" type="text" name="name" class="form-control" 
					  id="exampleInputEmail1" placeholder="Enter name" value="'.$category['category_name'].'">
                    </div>
                    <div class="form-group">
                      <label>Category Description</label>
                      <textarea required="required" class="form-control" name="description" rows="3" 
					  placeholder="Enter description ...">'.$category['category_description'].'</textarea>
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


function editSubCategory(){
  
  $categoryID=$_GET['categoryID'];
  //query to get category details
  $query="SELECT * FROM `sub_category`
      WHERE `sub_category`=".$categoryID."
      ";
  $exec=mysql_query($query);
  $category=mysql_fetch_array($exec);
  
  
  
  echo'
  
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Edit Category
          </h1>
      ';
      if(isset($_GET['success']))
        echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Added Successfully!</h4>
                  </div>';
      echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Category Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="admin/editSubCategory.php?categoryID='.$categoryID.'">
                  <div class="box-body" style="width:50%">
                    <div class="form-group">
                      <label>Category Name</label>
                      <input required="required" type="text" name="name" class="form-control" 
            id="exampleInputEmail1" placeholder="Enter name" value="'.$category['sub_category_name'].'">
                    </div>
                    <div class="form-group">
                      <label>Category Description</label>
                      <textarea required="required" class="form-control" name="description" rows="3" 
            placeholder="Enter description ...">'.$category['sub_category_description'].'</textarea>
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



//function to view monthly report
function admin_yearlyReport(){
	
		
		
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
					<input type="submit" class="btn btn-info btn-flat" type="button">Go!</button>
				  </span>
				</div> 
				</form>';
				
				
				
			
		//query to get count of total grievances in this year
		$totalGrievanceCount=array();
		$month=1;
		while($month<=12){
			//query to count grievances in a particular month
			if($month<10)
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-0".$month."%'
					";
			else
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-".$month."%'
					";
			$exec=mysql_query($query);
			$count=mysql_fetch_array($exec);
			$totalGrievanceCount[$month] = $count['monthTotal'];
			$month++;
			//echo $count['monthTotal'];
		}
		
		
		//query to get count of solved grievances in this year
		$solvedGrievanceCount=array();
		$month=1;
		while($month<=12){
			//query to count solved grievances in a particular month
			if($month<10)
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=0
					";
			else
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=0
					";
			$exec=mysql_query($query);
			$count=mysql_fetch_array($exec);
			$solvedGrievanceCount[$month] = $count['monthTotal'];
			$month++;
			//echo $count['monthTotal'];
		}
		
		
		//query to get count of pending grievances in this year
		$pendingGrievanceCount=array();
		$month=1;
		while($month<=12){
			//query to count pending grievances in a particular month
			if($month<10)
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-0".$month."%' AND `grievance_externalFlag`=1
					";
			else
			$query="SELECT COUNT(*) as monthTotal FROM `grievance`
					WHERE `grievance_added_timestamp` LIKE '".$year."-".$month."%' AND `grievance_externalFlag`=1
					";
			$exec=mysql_query($query);
			$count=mysql_fetch_array($exec);
			$pendingGrievanceCount[$month] = $count['monthTotal'];
			$month++;
			//echo $count['monthTotal'];
		}
		
		
		/*print_r($totalGrievanceCount);
		echo'<br />';
		print_r($solvedGrievanceCount);
		echo'<br />';
		print_r($pendingGrievanceCount);*/
		
		
						
					echo'
					<input class="pull-right" type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
					<span class="glyphicon glyphicon-search pull-right"></span>
				  <button class="btn btn-block btn-primary" onclick="printthis(\'table\')">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
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
				</div><!--table-->

                  
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
              <div class="box box-success" id="graph">
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



//function to view report department-wise
function admin_departmentReport(){
	
		
		
		
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
				<form class="pull-left" style="width:20%" method="post" action="admin_viewReportDepartment.php">
				<div class="input-group margin" style="width:100%">
				 <select class="form-control" name="year">
					<option disabled="disabled" selected="selected" value="NULL">Select Year</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
				</select>
				  <span class="input-group-btn">
					<input type="submit" class="btn btn-info btn-flat" type="button">Go!</button>
				  </span>
				</div> 
				</form>';
				
				
				
		$i=0;	
		
		
		$totalGrievanceCount=array();
		//query to run through all the categories
		$query="SELECT * FROM `department`";
		$exec=mysql_query($query);
		while($department=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular dept
			
			$query="SELECT COUNT(*) as departmentTotal FROM `grievance`
					WHERE `grievance_department_id` = ".$department['department_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%'
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$totalGrievanceCount[$i++] = $count['departmentTotal'];
	
		}
		
		$i=0;	
		//query to get count of solved grievances
		$query="SELECT * FROM `department`";
		$exec=mysql_query($query);
		$solvedGrievanceCount=array();
		while($department=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular dept
			
			$query="SELECT COUNT(*) as departmentTotal FROM `grievance`
					WHERE `grievance_department_id` = ".$department['department_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%' AND `grievance_externalFlag`=0
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$solvedGrievanceCount[$i++] = $count['departmentTotal'];
		}
		
		
		$i=0;	
		//query to get count of pending grievances
		$pendingGrievanceCount=array();
		$query="SELECT * FROM `department`";
		$exec=mysql_query($query);
		while($department=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular dept
			
			$query="SELECT COUNT(*) as departmentTotal FROM `grievance`
					WHERE `grievance_department_id` = ".$department['department_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%' AND `grievance_externalFlag`=1
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$pendingGrievanceCount[$i++] = $count['departmentTotal'];
		}
		
		
		/*print_r($totalGrievanceCount);
		echo'<br />';
		print_r($solvedGrievanceCount);
		echo'<br />';
		print_r($pendingGrievanceCount);*/
		
		
						
					echo'
					<input class="pull-right" type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
					<span class="glyphicon glyphicon-search pull-right"></span>
					<button class="btn btn-block btn-primary" onclick="printthis(\'table\')">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
				  <div id="table">
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  	<th>ID</th>
                        <th>Department</th>
                        <th>#Total Grievances</th>
						<th>#Solved Grievances</th>
						<th>#Pending Grievances</th>
                      </tr>
                    </thead>
                    <tbody>';
					$i=1;
					$query="SELECT * FROM `department`";
					$exec=mysql_query($query);
					while($department=mysql_fetch_array($exec)){
						echo'<tr>
								<td align="center">'.$i.'</td>
								<td align="center">'.$department['department_name'].'</td>
								<td align="center">'.$totalGrievanceCount[$i-1].'</td>
								<td align="center">'.$solvedGrievanceCount[$i-1].'</td>
								<td align="center">'.$pendingGrievanceCount[$i-1].'</td>
							</tr>';
							$i++;
					}
					echo'</tbody>
                  </table>
				  </div>
                </div><!-- /.box-body -->

                  
                </form>
              </div><!-- /.box -->
			</div><!--col-->
			</div>   <!-- /.row -->
			
			
			<div class="row">
            <div class="col-lg-10">
			 <!-- BAR CHART -->
			 <button class="btn btn-block btn-primary" onclick="printthis(\'graph\')">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
              <div class="box box-success" id="graph">
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
		  $query="SELECT * FROM `department`";
		  $exec=mysql_query($query);
		  while($department=mysql_fetch_array($exec)){
				echo"{y: '".$department['department_name']."', a: ".$totalGrievanceCount[$i-1].", b: ".$solvedGrievanceCount[$i-1].", c: ".$pendingGrievanceCount[$i-1]."},
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





//function to view report category-wise
function admin_categoryReport(){
	
	
			
		
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
				<form class="pull-left" style="width:20%" method="post" action="admin_viewReportCategory.php">
				<div class="input-group margin" style="width:100%">
				 <select class="form-control" name="year">
					<option disabled="disabled" selected="selected" value="NULL">Select Year</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
				</select>
				  <span class="input-group-btn">
					<input type="submit" class="btn btn-info btn-flat" type="button">Go!</button>
				  </span>
				</div> 
				</form>';
				
				
				
		$i=0;	
		
		
		$totalGrievanceCount=array();
		//query to run through all the categories
		$query="SELECT * FROM `category`";
		$exec=mysql_query($query);
		while($category=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular category
			
			$query="SELECT COUNT(*) as categoryTotal FROM `grievance`
					WHERE `grievance_category_id` = ".$category['category_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%'
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$totalGrievanceCount[$i++] = $count['categoryTotal'];
	
		}
		
		$i=0;	
		//query to get count of solved grievances
		$query="SELECT * FROM `category`";
		$exec=mysql_query($query);
		$solvedGrievanceCount=array();
		while($category=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular category
			
			$query="SELECT COUNT(*) as categoryTotal FROM `grievance`
					WHERE `grievance_category_id` = ".$category['category_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%' AND `grievance_externalFlag`=0
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$solvedGrievanceCount[$i++] = $count['categoryTotal'];
		}
		
		
		$i=0;	
		//query to get count of pending grievances
		$pendingGrievanceCount=array();
		$query="SELECT * FROM `category`";
		$exec=mysql_query($query);
		while($category=mysql_fetch_array($exec)){
	
			//query to count grievances in a particular category
			
			$query="SELECT COUNT(*) as categoryTotal FROM `grievance`
					WHERE `grievance_category_id` = ".$category['category_id']."
					AND `grievance_added_timestamp` LIKE '".$year."%' AND `grievance_externalFlag`=1
					";
			
			$execute=mysql_query($query);
			$count=mysql_fetch_array($execute);
			$pendingGrievanceCount[$i++] = $count['categoryTotal'];
		}
		
		
		/*print_r($totalGrievanceCount);
		echo'<br />';
		print_r($solvedGrievanceCount);
		echo'<br />';
		print_r($pendingGrievanceCount);*/
		
		
						
					echo'
					<input class="pull-right" type="text" id="searchTerm" class="search_box" onkeyup="doSearch()" />
					<span class="glyphicon glyphicon-search pull-right"></span>
					<button class="btn btn-block btn-primary" onclick="printthis(\'table\')">
				  <span class="glyphicon glyphicon-print"></span>Print
				  </button>
				  <div id="table">
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  	<th>ID</th>
                        <th>Category</th>
                        <th>#Total Grievances</th>
						<th>#Solved Grievances</th>
						<th>#Pending Grievances</th>
                      </tr>
                    </thead>
                    <tbody>';
					$i=1;
					$query="SELECT * FROM `category`";
					$exec=mysql_query($query);
					while($category=mysql_fetch_array($exec)){
						echo'<tr>
								<td align="center">'.$i.'</td>
								<td align="center">'.$category['category_name'].'</td>
								<td align="center">'.$totalGrievanceCount[$i-1].'</td>
								<td align="center">'.$solvedGrievanceCount[$i-1].'</td>
								<td align="center">'.$pendingGrievanceCount[$i-1].'</td>
							</tr>';
							$i++;
					}
					echo'</tbody>
                  </table>
				  </div>
                </div><!-- /.box-body -->

                  
                </form>
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
		  $query="SELECT * FROM `category`";
		  $exec=mysql_query($query);
		  while($category=mysql_fetch_array($exec)){
				echo"{y: '".$category['category_name']."', a: ".$totalGrievanceCount[$i-1].", b: ".$solvedGrievanceCount[$i-1].", c: ".$pendingGrievanceCount[$i-1]."},
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



//method to create letter head by admin
function createLetterHead(){

echo'
	
		<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="padding-right:25%; padding-bottom:20px; float:left">
           Add Category

          </h1>
		  ';
		  if(isset($_GET['success']))
		  	echo'<div class="alert alert-success alert-dismissable" style="width:280px; float:left">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <h4><i class="icon fa fa-check"></i> Letter Head Added Successfully!</h4>

                  </div>';
		  echo'
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Letter Head</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Letter Head Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="admin/createLetterHead.php">
                  <div class="box-body" style="width:50%">
                    <div class="form-group">
                      <label>Header</label>
                      <textarea required="required" type="text" name="header" class="form-control" rows="3"
					  id="exampleInputEmail1" placeholder="Enter header..."></textarea>
                    </div>
                    <div class="form-group">
                      <label>Footer</label>
                      <input required="required" class="form-control" name="footer"
					  placeholder="Enter footer ...">
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

?>
