<!--Displays all the events in the database-->
<?php
session_start();
include ('sessions_user.php'); //user sessions 
?>
<!doctype html>
<html lang="en">
	<head>
		<title>View All Events</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation bar-->
	<?php include ('loginform.php');?> <!--login form for additional priviledges-->
	<br/>
    <?php include ('viewallevent.php')?>
    <br/>
	<footer>
		<?php include ('footer.php');?> <!--footer includes about us and other necessary website details-->
	</footer>
    </body>
	<!--JS script-->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>