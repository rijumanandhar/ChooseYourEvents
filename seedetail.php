<!--Displays all the details of an individual website and show options for booking-->
<?php
session_start();
include('sessions_user.php'); //user sessions
if (isset($_GET['id'])){
    $eid=$_GET['id']; //gets eventid from where other page
}
?>
<!doctype html>
<html lang="en">
	<head>
		<title>See Details</title>
		<?php include ('header.php'); ?>  <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation bar-->
	<?php include ('loginform.php');?> <!--login form for additional priviledges-->
	<br/>
	<?php include ('viewoneevent.php');?> <!--view individual events-->
	<br/>
	<?php include ('similarproducts.php');?> <!--view similar events-->
	<br/>
	<br/>
	<footer>
		<?php include ('footer.php');?> <!--footer includes about us and other necessary website details-->
	</footer>
    </body>
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
	<script src="js/lightbox-plus-jquery.min.js"></script>
</html>