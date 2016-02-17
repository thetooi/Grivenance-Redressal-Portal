<?php

$userType = $_POST['userType'];

if($userType=="admin"){
echo'<p class="login-box-msg">Admin</p>
        <form action="login/checkLogin.php?utype='.$userType.'" method="post">
          <div class="form-group has-feedback">
            <input required="required" type="text" name="username" class="form-control" placeholder="Username"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input required type="password" name="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>';
}

elseif($userType=="griever"){
echo'<a href="home.php"><button class="btn btn-block btn-primary btn-lg">Enter Portal</button></a>';
}


elseif($userType=="authority"){
echo'<p class="login-box-msg">Authority</p>
        <form action="login/checkLogin.php?utype='.$userType.'" method="post">
          <div class="form-group has-feedback">
            <input type="email" name="username" class="form-control" placeholder="Email" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>';
}

?>