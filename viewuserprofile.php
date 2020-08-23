<!--Displays the profile page of user with events booked by the user-->
<?php
session_start();
include ('sessions_user.php'); //sessions for users
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Profile</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation bar-->
	<br/>
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-8 large-8"> 
				<?php include ('viewprofile.php');?> <!--views the user profile, with option to edit it-->
			</div>
			<br/>
			<div class="cell small-12 medium-4 large-4" id="viewpurchase">
				<?php include ('buyrecord.php');?>  <!--views the list of event the user has booked for with the option to see details and seek refund-->
			</div>
		</div>
	</div>
	<br/>
	<footer> <!--footer includes about us and other necessary website details-->
		<?php include ('footer.php');?>
	</footer>
    </body>
	<!--Java Scripts-->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>