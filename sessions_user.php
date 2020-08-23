<!--checks sessions for login users-->
<?php
$session=0;
if (isset($_SESSION['login_username'])&&isset($_SESSION['login_role'])){
	$login_role=$_SESSION['login_role']; //session recieved while
	$admin=0;
	if($login_role==3){
		$session=1; //if session exits, fav is displayed
    $usern2=$_SESSION['login_username']; //grabs the username passed by session while logging in
	include ('connection.php');
	$query="select * from user where username='$usern2'";
	$result=mysqli_query($connection,$query); //runs the query
	$count=mysqli_num_rows($result); //checks the number of rows affected by the query
	if ($count>=1){
		while ($row=mysqli_fetch_assoc($result)){ //can fetch the datas from the table
			$uid= $row['uid'];
			$fname=$row['firstname'];
			$lname=$row['lastname'];
			$uname=$row['username'];
			$pass=$_SESSION['login_password'];
			$email=$row['email'];
			$gender=$row['gender'];
			$age=$row['age'];
			$profile=$row['profilepic'];
			$role=$row['role'];
        }
	}
}

}else{
	$session=0;
}
?>