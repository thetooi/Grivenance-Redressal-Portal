<?php
require_once('include/session.php');
require_once('include/config.php');
require_once('include/dashboardFunctions.php');
require_once('include/adminFunctions.php');
require_once('include/check.php');
logged_in();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Authority</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    <!-- fullCalendar 2.2.5-->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <?php
	  	top_header();		//function in include/dashboardFunctions.php
	  ?>
      
      <?php
	  	sidebar();		//function in include/dashboardFunctions.php
	  ?>

		<?php
			editDeleteAuthority();		//function in include/adminFunctions.php
		?>

      <?php
	  	footer();		//function in include/dashboardFunctions.php
	  ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- jQuery UI 1.11.1 -->
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  	<!-- DATA TABES SCRIPT -->
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- Page specific script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });

	  //function for dynamic search
	  function doSearch() {
		var searchText = document.getElementById('searchTerm').value;
		var targetTable = document.getElementById('dataTable');
		var targetTableColCount;
				
		//Loop through table rows
		for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
			var rowData = '';
	
			//Get column count from header row
			if (rowIndex == 0) {
			   targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
			   continue; //do not execute further code for header row.
			}
					
			//Process data rows. (rowIndex >= 1)
			for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
				rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
			}
	
			//If search term is not found in row data
			//then hide the row, else show
			if (rowData.toLowerCase().indexOf(searchText.toLowerCase()) == -1)
				targetTable.rows.item(rowIndex).style.display = 'none';
			else
				targetTable.rows.item(rowIndex).style.display = 'table-row';
		}
	}
	
	function deleteAuthority(authorityID){
		var r = confirm("Are you sure ?");
		if (r == true) {
			window.location="admin/deleteAuthority.php?authorityID="+authorityID;
		} else {
			x = "You pressed Cancel!";
		}
		
	}
	
	
	 $("#admin_authority").addClass("active");
	  $("#admin_editAuthority").addClass("active");
	  
	  
	  
    </script>
    

    
  </body>
</html>