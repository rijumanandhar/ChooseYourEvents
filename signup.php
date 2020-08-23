<!--sign up page includes a form for user to register into the system--> 
<?php
	include('userfunctions.php');
	include('connection.php');//database connection
	//variables defined to store errors which will be displayed in the form
	$field_er=$email_er=$pass_er=$cpass_er=$fname_er=$lname_er=$uname_er=$uname_taken=$term_er=$file_er=$img_er=$chk="";
	$fname=$lname=$uname=$pass=$cpass=$email=$age=$gender="";
	if (isset($_POST['s_submit'])){
		$error=0; //initiating the error count. If $error=0, user can sign up
		if (isset($_POST['firstname'],$_POST['lastname'],$_POST['s_username'],$_POST['s_password'],$_POST['c_password'],$_POST['email'],$_POST['agegroup'],$_POST['gender'])){
			//retrieving the values from the form
			$fname=mysqli_real_escape_string($connection,$_POST['firstname']);
            $lname=mysqli_real_escape_string($connection,$_POST['lastname']);
            $uname=mysqli_real_escape_string($connection,$_POST['s_username']);
            $pass=mysqli_real_escape_string($connection,$_POST['s_password']);
            $cpass=mysqli_real_escape_string($connection,$_POST['c_password']);
            $email=mysqli_real_escape_string($connection,$_POST['email']);
            $age=$_POST['agegroup'];
			$gender=$_POST['gender'];
			//patterns for validation
			$pattern_pass='/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'; //pattern for strong password which should consist of atleast one Upper case, one special character, one numeric chaaracter and should be between 8-20 characters long.
			$pattern_name='/^[a-zA-Z]{1,10}$/'; //pattern for name which should only consist of alphabets and be max 10 characters long
			$pattern_uname='/^[a-zA-Z]{5,}$/';; //only alpha, minimum 5 char, max unlimited
			//create folder for uploaded images
			$dir="uploaduser";
            if(!file_exists($dir) /*checks file*/ && !is_dir($dir) /*checks directory*/){
                mkdir($dir); //makes directory
            }
            $temp=$_FILES['uploadImg']['tmp_name'];
            $name=$_FILES['uploadImg']['name'];
            $size=$_FILES['uploadImg']['size'];
            $type=$_FILES['uploadImg']['type'];
            $uploadfull="$dir/$name"; //gives the path of image
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {//check if email is valid
				$email_er="$email is not a valid email address";
				$error++;
			} 
			if($pass!=$cpass){ //checks if the password and confirm password matches or not
				$cpass_er='Passwords do not match <br/>';
				$error++;
			}
			if (!isset($_POST['agreement'])){ //checks if the agreements is checked
				$term_er='Please tick to agree the terms and condition <br/>';
				$error++;
			}
			if(!preg_match($pattern_pass,$pass)){ //checks for a strong password
				$pass_er='Choose a strong password <br/>';
				$error++;
			}
			if(!preg_match($pattern_name,$fname)){ //checks if first name has any numeric value or special characters
				$fname_er='First name should only consist of alphabets<br/>';
				$error++;
			}
			if(!preg_match($pattern_name,$lname)){//checks if last name has any numeric value or special characters
				$lname_er= 'Last name should only consist of alphabets<br/>';
				$error++;
			}
			if(!preg_match($pattern_uname,$uname)){//validates username
				$uname_er='Invalid Username <br/>';
				$error++;
			}
			if (!usernameAvailibity($uname)){ //checks for username availibility in the database.
				$uname_taken=$uname.' is not available';
				$error++;
			}
			if(!file_exists($_FILES['uploadImg']['tmp_name']) || !is_uploaded_file($_FILES['uploadImg']['tmp_name'])){ //TO CHECK IF THE FILE IS UPLOADED OR NOT. Returns false if there is no file
				$file_er='Please upload a photo <br/>';
				$error++;	
			}
			if (!imgCheck($size,$type)){ //checks the size and type of image that is being uploaded
				$img_er='File not supported or too big.';
				$error++;
			}
			if ($error==0){ //if no errors found, user is added
				$chk=addUser($fname,$lname,$uname,$pass,$email,$gender,$age,$uploadfull,$temp);
			}
		}else{
			$field_er='Please fill the fieldnames inorder to sign up!';
		}
	 
	}
	
?>
<!doctype html>
<html lang="en">
	<head>
		<title>ChooseYourEvents</title>
		<?php include ('header.php'); ?>
	</head>
	<body>
	<?php include ('nav.php'); ?>
	<?php include ('loginform.php');?>
	<br/>
	<div class="grid-x">
		<div class="cell small-9 medium-9 large-9">
			<div id="container1">
				<form action="" name="signup" method="POST" enctype="multipart/form-data">
					<div class="imgcontainer">
					<img src="image/1.png" alt="Avatar" class="avatar">
					<h3> Sign Up </h3>
					</div>
					<span class="error"><?php echo $chk;?></span>
					<span class="error"><?php echo $field_er;?></span> 
					<input type="text" placeholder="First Name" name="firstname" value="<?php echo $fname; ?>" >
					<span class="error"><?php echo $fname_er;?></span>
					<input type="text" placeholder="Last Name" name="lastname" value="<?php echo $lname; ?>"  >
					<span class="error"><?php echo $lname_er;?></span>
					<input type="text" placeholder="Username" name="s_username" value="<?php echo $uname; ?>"  >
					<span class="error"><?php echo $uname_er;?></span> <span class="error"><?php echo $uname_taken;?></span>
					<input type="password" placeholder="Password" name="s_password" value="<?php echo $pass; ?>" data-toggle-focus="form-callout" >
					<span class="error"><?php echo $pass_er;?></span>
					<!--only visible when password field is in focus-->
					<div class="secondary callout is-hidden" id="form-callout" data-toggler="is-hidden">
						<p>Password should be strong. A strong password which should consist of atleast one Upper case, one special character, one numeric chaaracter and should be between 8-20 characters long.</p>
					</div>
					<input type="password" placeholder="Confirm Password" name="c_password"  >
					<span class="error"><?php echo $cpass_er;?></span>
					<input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" >
					<span class="error"><?php echo $email_er.'<br/>';?></span>
					Gender:
					<input type="radio" name="gender" value="M" <?php if($gender=='M')echo 'checked'?>> Male
					<input type="radio" name="gender" value="F" <?php if($gender=='F')echo 'checked'?>> Female
					<input type="radio" name="gender" value="O" <?php if($gender=='O')echo 'checked'?>> Other
					<br/>
					Age: 
					<select name="agegroup">
						<optgroup  label="agegroup">
							<option value=">20" <?php if($age=='>20')echo 'selected'?>>Less than 20</option>
							<option value="20-30" <?php if($age=='20-30')echo 'selected'?>>20-30</option>
							<option value="30-40" <?php if($age=='30-40')echo 'selected'?>>30-40</option>
							<option value="40-50" <?php if($age=='40-50')echo 'selected'?>>40-50</option>
							<option value="50+" <?php if($age=='50+')echo 'selected'?>>50 +</option>
						</optgroup>
					</select>
					<br/>
					Choose Profile Pic: 
					<input type="file" name="uploadImg"> 
					<span class="error"><?php echo $file_er;?></span> 
					<span class="error"><?php echo $img_er.'<br/>';?></span> 
					<input type="checkbox" name="agreement" <?php if (isset($_POST['agreement'])){ echo 'checked';}?>> I agree with all the <a href="#">Terms and Condition</a> of service
					<span class="error"><?php echo $term_er;?></span> 
					<input type="submit" name="s_submit" value="Sign Up">
				</form>
			</div>
		</div>
	</div>
		<!--JS script-->
		<script src="js/vendor/jquery.js"></script>
		<script src="js/vendor/what-input.js"></script>
		<script src="js/vendor/foundation.js"></script>
		<script src="js/app.js"></script>
	</body>
</html>