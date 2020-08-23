<!--Navigation section for whole website-->
<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
	<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
	<div class="title-bar-title">Menu</div>
</div>
<div class="top-bar" id="responsive-menu">
	<div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu data-magellan>
			<li class="menu-text"><h4>Choose<span>your</span>Events</h4></li>
			<li><a href="index.php">Home</a></li>
			<li><a href="#aboutus">About</a></li>
			<li><a href="categorypage.php">Category</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<?php
				if (isset($_SESSION['login_username'])&&isset($role)==3){ //if session exists, log out is replaced by following menu items
					/**displays the username, profile picture with drop down option including view profile, favorite page,logout */
					
					echo "<li> <p class=\"nav\"><img class=\"dp\"src=\"$profile\"/>  Hello, $uname</p>
					<ul class=\"menu\">";
						echo "<li><a href=\"viewuserprofile.php\">Profile</a></li>";
					echo "<li><a href=\"favoritepage.php\">Favorite</a></li>";
					echo "<li><a href=\"logout.php\">Log Out</a></li>";
					echo "</li> </ul>";
				}else{
					//pop-up login form
					echo "<li><a href=\"#\" onclick=\"document.getElementById('modal-wrapper').style.display='block'\">Login / Sign Up</a></li>";
				}
			?>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="menu"> <!--search bar for open text search-->
			<form method="POST" action="">
				<input type="text" placeholder="Search.." name="search">
				<button type="submit" name="searchbutton"><i class="fi-magnifying-glass large1"></i> &nbsp;</button>
			</form>
		</ul>
	</div>
</div>

<?php
if(isset($_POST['search'])){
	/**keyword is sent via cookie to search.php */
	$keyword=$_POST['search'];
	$cookie_name='keyword';
	$cookie_value=$keyword;
	setcookie($cookie_name, $cookie_value, time() + 3600,"/"); //cookie's scope is 1 hour
	header("Location: search.php");//refer to search page
}
?>