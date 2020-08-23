<?php
$user1=$msg="";
if(isset($_POST['l_submit'])){
	if(isset($_POST['l_username']) && isset($_POST['l_password'])){
		$user1=$_POST['l_username'];
		$l_pass=$_POST['l_password'];
		$l_password=md5($l_pass);
		include('connection.php');
		$query1="select * from user where username='$user1'";
		$result1=mysqli_query($connection,$query1);
		$count1=mysqli_num_rows($result1);
		if($count1==1){
			$stmt="SELECT role,status FROM user WHERE username='$user1' AND password='$l_password'";
			$qry=mysqli_query($connection,$stmt);
			$count=mysqli_num_rows($qry);
			if($count==1){
				while($row=mysqli_fetch_array($qry)){
					$status=$row['status'];
					$role=$row['role'];
					if($status==1){
						$_SESSION['login_username']=$user1;
						$_SESSION['login_password']=$l_pass;
						$_SESSION['login_role']=$role;
						switch($role){
							case 1:
							header('Location: admin_dashboard.php');
							echo "Login in success";
							break;
							case 2:
							header('Location: dashboard.php');
							echo "Login in success";
							break;
							case 3:
							header('Location: index.php');
							echo "Login in success";
							break;
						}
					}else{
						echo 'You have been deactivated';
					}
				}
			}else{
				$msg="Password invalid";	
			}
		}else{
			$msg="Username is not registered. ".$_POST['l_username'];
		}
	}else{
		$msg="Username or password field empty.";
	}
}
?>
<div class="grid-x">
	<div id="modal-wrapper" class="modal">
		<div class="cell small-9 medium-8 large-6">
			<form class="modal-content animate" action="" name="login" method="POST" enctype="multipart/form-data">
				 <div class="imgcontainer">
			      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
				  <img src="image/1.png" alt="Avatar" class="avatar">
			      <h3> Login </h3>
			    </div>
			    <div class="container">
				  <span class="error"><?php echo $msg;?></span>
			      <input type="text" placeholder="Enter Username" name="l_username" value="<?php echo $user1;?>">
			      <input type="password" placeholder="Enter Password" name="l_password">        
			      <button><input type="submit" name="l_submit" value="Login"></button>
			      <input type="checkbox" name="remember" style="margin:26px 0px;"> Remember me      
			      <a href="#" style="text-decoration:none; float:right; margin:26px 0px;">Forgot Password ?</a>
			      <hr/>
			       <button> <a href="signup.php"> Sign Up </a></button>
			    </div>
			</form>
		</div>
	</div>
</div>
<script>
var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

