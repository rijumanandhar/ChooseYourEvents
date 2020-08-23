<!--Deletes the user from the given id-->
<?php
include ('userfunctions.php');
if (isset($_GET['id'])){
    $uid=$_GET['id'];
    deleteUser($uid);
    header("Location: {$_SERVER['HTTP_REFERER']}");//returns to the page referred
}
?>