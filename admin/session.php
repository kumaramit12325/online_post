<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("articles", $connection);
session_start();// Starting Session


// SQL Query To Fetch Complete Information Of User
if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
$user_check=$_SESSION["user_name"];
$ses_sql=mysql_query("select username from admin where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
//$login_id =$row['id'];
}else{

if(!empty($_SESSION["apiuser_id"]) && $_SESSION['api_attempt']=1 ){

$sql=mysql_query("select * from api_users where id=".$_SESSION["apiuser_id"]);
$rows = mysql_fetch_array($sql);
$apiuser_name =$rows['name'];
//print_r($sql);
}
else{
mysql_close($connection); // Closing Connection
header('Location: login.php'); // Redirecting To Home Page

}
}

//mysql_close($connection); // Closing Connection
//header('Location: login.php'); // Redirecting To Home Page

?>
<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

// SQL Query To Fetch Complete Information Of User




?>