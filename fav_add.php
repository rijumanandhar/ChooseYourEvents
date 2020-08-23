<!--gets the id from url and adds it to favorite table-->
<?php
session_start();
include ('sessions_user.php'); //sessions required for user
include ('fav_function.php'); //all the favorite functions
if (isset($_GET['id'])){
    $eid=$_GET['id']; //gets id from url
    if (checkfav($uid, $eid)){ //checks if the fav already exits with same uid and eid
        addToFav($uid, $eid);//adds to fav table
        header("Location: {$_SERVER['HTTP_REFERER']}");//refers to referred page
    }else{
        //echo 'already exists in fav';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
?>