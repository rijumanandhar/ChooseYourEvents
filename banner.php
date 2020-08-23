<!--banner for admin dashboards--> 
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
  header('Location: index.php'); exit();
}
?>
<div id="banner">
<ul class="menu align-right">
  <li><h3> Welcome <?php echo $_SESSION['login_username'];?></h3></li> <!--Displays the login name from session-->
  <li><img class="thumbnail" src="<?php echo $_SESSION['profile'];?>"></li><!--Displays the profile picture from session-->
</ul>
<hr/>
</div>
