<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
				<?php

include('session.php');
?>

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Edmin </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        
                        <ul class="nav pull-right">
                            
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
		
Welcome <?php 
if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
echo $login_session ;
}
if(!empty($apiuser_name )){
	echo $apiuser_name;
}
  ?>

                                    <li><a href="edit_profile.php">Edit Profile</a></li>
                                    <li><a href="account.php">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
							<li class="active"><a href="#"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                <li><a href="categories.php"><i class="menu-icon icon-bullhorn"></i>Categories </a>
                                </li>
                                <li><a href="post.php"><i class="menu-icon icon-inbox"></i>Post  </a></li>
                                                            
                            <!--/.widget-nav-->
                            
                            
                            <!--/.widget-nav-->
                               
                                <li><a href="#"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>

					