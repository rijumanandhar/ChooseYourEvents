<!--Views all the events in tabular format-->
<?php
session_start();
include ('sessions_admin1.php'); //checks sessions for admin role 1 else returns to index
?>
<html>
	<head>
        <title>Superadmin/View All Events</title>
		<?php include ('admin_header.php')?>
	</head>
	<body>
        <div class="grid-x">
			<div class="cell small-2 medium-2 large-2"> <!--header includes all the necessary meta tags and links-->
				<?php include ('nav1.php'); ?>  <!--navigation -->
			</div>
			<div class="cell small-10 medium-10 large-10">
				<?php include ('banner.php'); ?> <!--banner-->
				<br/>
				<div class="grid-container" >
				<?php include ('viewalleventtable.php');?>	<!--view all events in tabular format-->
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