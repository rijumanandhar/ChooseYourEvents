<!--removes one particular event from favorite-->
<?php
session_start();
include ('sessions_user.php'); //sessions required for user
include ('fav_function.php'); //all the favorite functions
if (isset($_GET['id'])){
    $eid=$_GET['id']; //gets id from url
    removeFav($uid,$eid);//removes fav
    header("Location: {$_SERVER['HTTP_REFERER']}");//refers to referred page
}else{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>