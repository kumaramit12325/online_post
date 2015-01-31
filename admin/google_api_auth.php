<?php 
$google_client_id = '761119720452-s2dibb0jflei97342bjb80gmm8t9sdsu.apps.googleusercontent.com';
$google_client_secret = 'kL7yXeIVDlUjeKjxu0SYPhwU';
$google_redirect_url = 'http://localhost/edmin/admin/google_api_auth.php';
$google_developer_key = 'AIzaSyAGQKBV098Mzelrgt5H9x3Qz8t5QYBwfNE';
###################################################################
//include("config.php"); 
//include google api files
require_once './api/Google_Client.php';
require_once './api/contrib/Google_Oauth2Service.php';

$gClient = new Google_Client();
$gClient->setApplicationName('Login to discussdesk.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);
 
//If user wish to log out, we just unset Session variable 
  
if (isset($_GET['code']))
{
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
    return;
}
 
 
if (isset($_SESSION['token']))
{
        $gClient->setAccessToken($_SESSION['token']);
}
  
 if ($gClient->getAccessToken())
{
//Get user details if user is logged in
$user = $google_oauthV2->userinfo->get();
$_SESSION['apiuser_id'] = $user['id'];
$_SESSION['apiuser_name'] = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
$_SESSION['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
$_SESSION['profile_url'] = filter_var($user['link'], FILTER_VALIDATE_URL);
$_SESSION['profile_pic_url'] = filter_var($user['picture'], FILTER_VALIDATE_URL);
//$personMarkup = "$email<div><img src='$profile_image_url?sz=50'></div>";
 $_SESSION['token']    = $gClient->getAccessToken();
 
if(!empty($_SESSION['apiuser_id'])){
   $result = mysql_query("SELECT id FROM api_users WHERE id=".$_SESSION['apiuser_id']);
    
      if(mysql_num_rows($result) == 0)
    {      //echo 'Hello! '.$user_name.', Thanks for Registering!';
        mysql_query("INSERT INTO api_users (id, name, email, link, picture_link , created) VALUES ('".$_SESSION['apiuser_id']."', '".$_SESSION['apiuser_name']."','".$_SESSION['email']."','".$_SESSION['profile_url']."', '".$_SESSION['profile_pic_url']."', now())");
    }


    header('Location: index.php');
}
}
else
{
//get google login url
$authUrl = $gClient->createAuthUrl();
	header("Location: $authUrl");
} 

?>