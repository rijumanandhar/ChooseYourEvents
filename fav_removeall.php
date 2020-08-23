<!--removes all events of a particular user from favorite-->
<?php
session_start();
include ('sessions_user.php');//sessions required for user
include ('fav_function.php');//all the favorite functions

removeAll($uid);//removes all fav with user id=$uid
header("Location: {$_SERVER['HTTP_REFERER']}");
?>