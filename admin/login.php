<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edmin</title>
	<link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="../css/theme.css" rel="stylesheet">
	<link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="#">
			  		Edmin
			  	</a>
<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a href="google_api_auth.php">
							Login with Google
						</a></li>

						

						<li><a href="#">
							Forgot your password?
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->

							</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->

<?php
session_start();
$message="";

if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'] )){
$_SESSION['user_name'] = $_COOKIE['cookname'];
$_SESSION['password'] = $_COOKIE['cookpass'];
$_SESSION['user_id']= $_COOKIE['cookuserid'];

/* Validating username and password from the database */
include("config.php");
$username=$_SESSION['user_name'];
$password=$_SESSION['password'];
$ress=mysql_query("select * from admin where username='$username'") or die(mysql_error());
$rows=mysql_fetch_array($ress);
if(($rows["username"]==$username)&&($rows["password"]==$password)) 
{
header('Location:index.php');
}
else {
 header('Location:login.php'); 
 }
/* Validating username and password from the database */
}

if(isset($_POST['submit'])){


$username=$_POST["username"];
$password=$_POST["password"];
 if(empty($_POST["username"]) || empty($_POST["password"])) 
        { $message="Please enter a username and password."; } 
 
$conn = mysql_connect("localhost","root","");
mysql_select_db("articles",$conn);
if(!empty($_POST["username"]) || !empty($_POST["password"])) {
$result = mysql_query("SELECT * FROM admin WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
$row  = mysql_fetch_array($result);

if(($row["username"]==$username)&&($row["password"]==$password)){
$_SESSION["user_id"] = $row['id'];
$_SESSION["user_name"] = $username;
$_SESSION["password"] = $password;
$_SESSION['login_attempt'] = 1;


if(isset($_POST['remember'])){
setcookie("cookname", $_SESSION['user_name'], time()+60*60*24*100, "/");
setcookie("cookpass", $_SESSION['password'], time()+60*60*24*100, "/");
setcookie("cookuserid", $_SESSION['user_id'], time()+60*60*24*100, "/");
} 
header('Location:index.php');
}
else {
// header('Location:login.php'); 
 $message="invalid user name and password.";
 }
}
else{
$message="Please enter a username and password";
} 
  
mysql_close($conn); 
}
if(isset($_SESSION["user_name"])) {
header('Location:index.php');
}
?>
	<div class="wrapper">
		<div class="container">
			<div class="row">
			<?php if($message!="") { ?>
			<div class="alert">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo $message; } ?>

									</div>
				
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post"action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" name="username" id="inputEmail" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" name="password" id="inputPassword" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" name="submit" class="btn btn-primary pull-right">Login</button>
									<label class="checkbox">
										<input type="checkbox" name="remember" > Remember me
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<?php echo include('footer.php');?>