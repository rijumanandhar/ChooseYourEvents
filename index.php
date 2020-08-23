<!--Landing page for the webiste-->
<?php
session_start();
include ('sessions_user.php'); //sessions for users
?>
<!doctype html>
<html lang="en">
	<head>
		<title>ChooseYourEvents</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation bar-->
	<?php include ('loginform.php');?> <!--login form for additional priviledges-->
    <?php include ('orbit.php');?>
    <div class="text-center"> <!--aligns the text in center-->
        <h2>Upcoming Events</h2>
    </div>
    <?php include ('upcomingevents.php');?> <!--displays recent upcoming evends-->
	<?php include ('viewalleventgrid.php');?> <!--displayes rest of the events-->
	<br/>
	<footer>
		<?php include ('footer.php');?> <!--footer includes about us and other necessary website details-->
	</footer>
    </body>
	<!--Java Scripts-->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>