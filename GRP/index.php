<?php
require_once('include/session.php');
require_once('include/check.php');
logged_in_login_page();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GRP | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script>
	function displayLogin(userType){
		//alert(userType);
	$.ajax({
		method: "POST",
		url: "ajax/displayUserLogin.php",
		data: { 'userType': userType},
		success: function(result){
        $("#login-content").html(result);
		//alert(result);
    }});
	
	}
	</script>
  

  <script>
function loadDoc() {
  //alert("hello");
  var xhttp, xmlDoc, txt, x, i;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (xhttp.readyState == 4 && xhttp.status == 200) {
    //alert("hello");
    xmlDoc = xhttp.responseXML;
    txt = "";

    x = xmlDoc.getElementsByTagName("CONTENT");
    for (i = 0; i < x.length; i++) {
      txt = txt + x[i].childNodes[0].nodeValue;
    }
    txt = txt + "The Owner of this Portal are "
    x = xmlDoc.getElementsByTagName("OWNER");
    for (i = 0; i < x.length; i++) {
      txt = txt + x[i].childNodes[0].nodeValue;
    }
    //document.getElementById("demo").innerHTML = txt;
    alert(txt);
    }
  }
  xhttp.open("GET", "cd_catalog.xml", true);
  xhttp.send();
}
</script>
    
    
  </head>
  <body class="login-page">
  
  <header class="main-header" style="background-color:#3c8dbc">
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a style="color:#FFF" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          </nav>
    </header>
          
          
  <aside class="main-sidebar" style="background-color:#333">
        <!-- sidebar: style can be found in sidebar.less -->
        <div style="padding-top:10%" align="center"><img height="100px" width="100px" src="images/RVlogo.gif"/></div>
        <section class="sidebar" style="padding-top:25%">
         	
         
          <ul class="sidebar-menu">
                    <li class="treeview">
                      
                        <button class="btn btn-block btn-warning btn-lg" onClick="displayLogin('admin')">
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Admin</button>
                     
                    </li>
                    
                    <li class="treeview">
                      
                        <button class="btn btn-block btn-warning btn-lg" onClick="displayLogin('griever')">
                        <span class="glyphicon glyphicon-bullhorn"></span>&nbsp;Griever</button>
                     
                    </li>
                    
                    <li class="treeview">
                      
                       <button class="btn btn-block btn-warning btn-lg" onClick="displayLogin('authority')">
                       <span class="glyphicon glyphicon-user"></span>&nbsp; Authority</button>
                      
                    </li>
                    <li class="treeview">
                      
                       <button class="btn btn-block btn-warning btn-lg" onClick="loadDoc()">
                       <span class="glyphicon glyphicon-user"></span>&nbsp; About Us</button>
                      
                    </li>

            </ul>
        </section>
	</aside>
    
    <div class="content-wrapper" style="padding:20px">
    	
        <div class="login-box">
        	
          <div class="login-logo">
            <b>Grievance Redressal Portal</b>
          </div><!-- /.login-logo -->
          <div class="login-box-body" id="login-content" style="position:relative">
            <!-- here different login methods for different users will be displayed -->    
               
            <h1 align="center">Welcome!</h1>
           <?php
            if(isset($_GET['error']))
                echo'<div class="alert alert-warning alert-dismissable">
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        Invalid username or password
                      </div>';
            ?>
            
    
          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </div>
   

   <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    
     <footer class="main-footer" style="bottom:0; position:relative; width:100%">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">RVCE</a>.</strong> All rights reserved.
      </footer>
  </body>
</html>