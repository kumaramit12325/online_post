<?php
session_start();
session_unset();
session_destroy();

if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
setcookie("cookname", "", time()-60*60*24*100, "/");
setcookie("cookpass", "", time()-60*60*24*100, "/");
setcookie("cookuserid", "", time()-60*60*24*100, "/");
}
header("Location:login.php");
?>