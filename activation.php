<!--Updates the status of the given user via their user id when the link to this page is clicked and then returns to index page-->
<?php
session_start();
$user=$_GET['id']; //gets id from url
include('connection.php');
$stmt="update user set status=1 where username='$user'"; //updates through user id
$result=mysqli_query($connection,$stmt);
if($result){
    $_SESSION['login_role']=$username;
    header('Location: index.php');//redirects to index
}
?>