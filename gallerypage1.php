<!--Gallery page with option to view uploaded photos for admins with role 1-->
<?php
session_start();
include ('sessions_admin1.php'); //sessions required for admin with role 1
?>
<html>
	<head>
        <title>Superadmin/Gallery</title>
		<?php include ('admin_header.php')?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
        <div class="grid-x">
			<div class="cell small-2 medium-2 large-2">
				<?php include ('nav1.php'); ?>  <!--navigation -->
			</div>
			<div class="cell small-10 medium-10 large-10">
				<?php include ('banner.php'); ?>  <!--banner-->
				<br/>
				<div class="grid-container" style="padding:20px;" >
				<div class="grid-x grid-margin-x">
				<?php include ('galleryadmin.php'); ?>  <!--gallery for admin 1-->
				</div>
				</div>
			</div>
		</div>
	</body>
	<!--JS script-->
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
	<script src="js/lightbox-plus-jquery.min.js"></script>
</html>