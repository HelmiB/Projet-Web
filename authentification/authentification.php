
<link href="images/logo.png" rel="icon"/>
<?php 
session_start();
if ($_SESSION['user']=="admin"){
   if (isset($_SESSION['user'])) 
header("Refresh:1; url=../admin.php");
}
else{ if (isset($_SESSION['user'])) 
header("Refresh:1; url=../indexPatient.php");}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <!-- Bootstrap -->
       <link href="css/bootstrap.css" rel="stylesheet">

		<link href="css/style.css" rel="stylesheet">
		
    </head>
    <body>
	
	<div class="container-fluid">
		<!--- Header --------------------------->
		<div class="row navbar-fixed-top">
			<nav class="navbar navbar-default header">
			<div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand logo" href="#">
				  <?php
                      if (isset($_SESSION['user'])) 
                     echo '<img alt="Brand" src="images/loading.gif">' ;
				     else echo '<img alt="Brand" src="images/logo.png">';
				  ?>
				  </a>
				  <div class="navbar-text title"><p>Hospital Management System<p></div>
				</div>
			</div>
			</nav>
		</div>
		<!--- Header Ends Here --------------------------->
		
		<div class="row ">
			<div class="col-md-12">
				<div class="panel panel-default login">
					<div class="panel-heading logintitle">Login</div>
					
					<div class="panel-body">
					 <?php if (isset($_GET['message'])) echo '<center><h2> '.$_GET['message'].'</h2></center>' ?>
                                            <form class="form-horizontal center-block" role="form" action="connect.php" method="post">
							
								
                                                                
								<div class="input-group input-group-lg">
								  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
								  <input type="text" class="form-control" name="user" placeholder="username" required aria-describedby="sizing-addon1">
								</div>
								
								<br/>
								<div class="input-group input-group-lg">
								  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
								  <input type="password" name="psswd" class="form-control" placeholder="Password" required aria-describedby="sizing-addon1">
								</div>
								<br/>
								<div class="col-sm-7 col-sm-offset-2">
								  <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
								</div>
						</form>
					</div>
						
				</div>
			</div>				
		</div>
		
		
		<div class="row footer navbar-fixed-bottom">
			<div class="col-md-12">
			</div>
		</div>
		
		
		
	
		
	</div>
		 

    </body>
</html>