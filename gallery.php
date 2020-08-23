<!--Displays all photos for events in the webiste-->
<?php
session_start();
include ('sessions_user.php'); //sessions for users
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Photo Gallery</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation bar-->
	<?php include ('loginform.php');?> <!--login form for additional priviledges-->
    <br/>
    <div class="grid-container" style="padding:20px;">
        <div class="grid-x grid-margin-x">
            <?php include ('galleryviewuser.php');?> <!--fetches and displays the photos-->
        </div>
    </div>
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
	<script src="js/lightbox-plus-jquery.min.js"></script>
</html>