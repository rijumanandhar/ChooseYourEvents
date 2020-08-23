<!--Dashboard for admins with role 2-->
<?php
session_start();
include ('sessions_admin2.php'); //sessions required for admin with role2
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin Panel</title>
		<?php include ('admin_header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
		<div class="grid-x">
			<div class="cell small-2 medium-2 large-2">
				<?php include ('nav2.php'); ?>  <!--navigation -->
			</div>
			<div class="cell small-10 medium-10 large-10">
				<?php include ('banner.php'); ?>  <!--banner-->
				<br/>
				<div class="grid-container" >
					<?php include ('viewprofile.php');?>
				</div>
			</div>
		</div>
	</body>
	<!--JS script-->
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>