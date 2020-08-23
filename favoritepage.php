<!--views the selected favourite events by the user-->
<?php
session_start();
include ('sessions_user.php'); //sessions for users
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Favorite</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?><!--navigation bar-->
	<br/>
    <?php include ('fav_display.php')?> <!--displays the favorites-->
    <br/>
    </body>
	<!--Java Scripts-->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>