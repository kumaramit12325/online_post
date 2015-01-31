<?php 
$google_client_id = '761119720452-s2dibb0jflei97342bjb80gmm8t9sdsu.apps.googleusercontent.com';
$google_client_secret = 'kL7yXeIVDlUjeKjxu0SYPhwU';
$google_redirect_url = 'http://localhost/edmin/admin/auth.php';
$google_developer_key = 'AIzaSyAGQKBV098Mzelrgt5H9x3Qz8t5QYBwfNE';
###################################################################
include("config.php"); 
//include google api files
require_once 'Google/Client.php';
require_once 'Google/Service/Oauth2.php';

session_start();
$client = new Google_Client();
$client->setScopes(array(
  "https://www.googleapis.com/auth/plus.me",
  "https://www.googleapis.com/auth/userinfo.email"
));
$google_oauthV2 = new Google_Service_Oauth2($client);

$client->setClientId($google_client_id);
$client->setClientSecret($google_client_secret);
$client->setRedirectUri($google_redirect_url);

//If user wish to log out, we just unset Session variable 
if (isset($_REQUEST['code'])) {
	$authCode = $_REQUEST['code'];
	$client->authenticate($authCode);
	$user = $google_oauthV2->userinfo->get();
	$_SESSION['apiuser_id'] = $user->id;	
	$_SESSION['apiuser_name'] = $user->name;
	$_SESSION['email'] = $user->email;
	$_SESSION['profile_pic_url'] = $user->picture;
$_SESSION['profile_url'] = $user->link;
$_SESSION['api_attempt'] = 1;
//$personMarkup = "$email<div><img src='$profile_image_url?sz=50'></div>";
// $_SESSION['token']    = $gClient->getAccessToken();
 
   $result = mysql_query("SELECT id FROM api_users WHERE id=".$user->id);
    
      if(mysql_num_rows($result) == 0)
    {      //echo 'Hello! '.$user_name.', Thanks for Registering!';
        mysql_query("INSERT INTO api_users (id, name, email, link, picture_link , created) VALUES ('".$_SESSION['apiuser_id']."', '".$_SESSION['apiuser_name']."','".$_SESSION['email']."','".$_SESSION['profile_url']."', '".$_SESSION['profile_pic_url']."', now())");
    }


  header('location: index.php');
print_r($_SESSION['apiuser_id']);
}
else
{
	$authUrl = $client->createAuthUrl();
		header("Location: $authUrl");
	
} 
/* 
if (!empty($_SESSION['apiuser_id'])) {
	echo "<span><img src='".$_SESSION['profile_pic_url']."' > </span>";
	echo "<span>Hi ".$_SESSION['apiuser_name']." ( <a href='logout.php' >Log out</a>)</span><br>";
	echo $_SESSION['email'];
}

else {
	if ( isset($_GET['error_code'] ) && $_GET['error_code'] == 1 ) {
	echo "<p>Oops!! Something went wrong. Please try again</p>";
	}
	echo "<a href='oauth2callback.php'><img src='login-with-google.JPG' alt='Sign in with Google'/></a>";
} 
 */

?>