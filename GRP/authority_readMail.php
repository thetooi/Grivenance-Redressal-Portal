<?php
require_once('include/session.php');
require_once('include/config.php');
require_once('include/dashboardFunctions.php');
require_once('include/check.php');
require_once('include/authorityFunctions.php');
logged_in();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GRP| Grievance</title>
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
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style> 
	#panel {
		padding: 5px;
		text-align: center;
		background-color: #e5eecc;
		border: solid 1px #c3c3c3;
		padding: 50px;
		display: none;
	}
</style>    
    

     <script>
    function displaySubcategory(type){
        //alert(type);
        $.ajax({
            method: "POST",
            url: "ajax/displaySubCategory.php",
            data: { 'type': type},
            success: function(result){
            $("#subcategory").html(result);
           
            }
        });
      }
      
      function printthis(id){
		var restore = document.body.innerHTML;
		document.body.innerHTML = document.getElementById(id).innerHTML;
		window.print();
		document.body.innerHTML = restore;
		location.reload();
	}
	
	
    </script>
   
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
		read_grievance();	//function in include/authoritFunctions.php
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
  
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
  
  <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  
    
  
    <!-- Page specific script -->
    <script type="text/javascript">

    	function show_category(){
    	$("#category").slidetoggle;

	}
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
		  
		  function add_reply(id){
			//alert($("textarea#reply").val());
			//alert(id);
			var reply=$("textarea#reply").val();
			
			$.ajax({
				method: "POST",
				url: "ajax/authority_manageReply.php",
				data: { 'id': id,
						'reply': reply
				},
				success: function(result){
					
				 $("#replies").append(result);
				 $("textarea#reply").val("");
				//$("#sec1").append(result);
				//alert(result);
			}});
		
			
		}
		// to change button's color when clicked
		function changeColor(id,griev_id){
			//alert(id+griev_id);
			
			$.ajax({
				method: "POST",
				url: "ajax/authority_manageButton.php",
				data: { 'id': id, 'griev_id': griev_id },
				success: function(result){
					
					//alert(result);
					if(result=="pending")
					$('#'+id).css('background-color',"#00a65a");
					else
					$('#'+id).css('background-color',"#f39c12")
					
					$('#'+result).css('background-color',"transparent");
					
				//alert(result);
			}});
		
			
		}
		
		
     
	  $("#authority_grievance").addClass("active");
	  $("#admin_addAuthority").addClass("active");
	  
	  
	  //function to slidetoggle
	  function slide(){
		  alert('hey');
		  $("#contentDisplay").show();
	  }
    </script>

    
  </body>
</html>
