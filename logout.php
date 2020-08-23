<!--destroys session-->
<?php
session_start();
if (isset($_SESSION['login_username'])){ //if session exits destroys it
    session_destroy();
    header('Location: index.php');//redirects to index page
}else{
    echo 'error';
    header('Location: index.php');
}
?>