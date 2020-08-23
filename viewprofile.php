<!--view profile through userid-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
 }
	include('userfunctions.php'); //all necessary user activity functions
	include('connection.php');//database connection
	//variables defined to store errors which will be displayed in the form
	$field_er=$pass_er=$cpass_er=$fname_er=$lname_er=$uname_er=$uname_taken=$term_er=$file_er=$img_er=$chk="";
	//variable to store result
	$pro_result="";
	if (isset($_POST['v_submit'])){ //to edit the user profile
		$error=0; //initiating the error count. If $error=0, user can sign up
		if (isset($_POST['v_firstname'],$_POST['v_lastname'],$_POST['v_username'],$_POST['v_password'],$_POST['v_cpassword'],$_POST['v_email'],$_POST['v_agegroup'],$_POST['v_gender'])){
			//retrieving the values from the form
			$fname=mysqli_real_escape_string($connection,$_POST['v_firstname']);
            $lname=mysqli_real_escape_string($connection,$_POST['v_lastname']);
            $uname=mysqli_real_escape_string($connection,$_POST['v_username']);
            $pass=mysqli_real_escape_string($connection,$_POST['v_password']);
            $cpass=mysqli_real_escape_string($connection,$_POST['v_cpassword']);
            $email=mysqli_real_escape_string($connection,$_POST['v_email']);
            $age=$_POST['v_agegroup'];
			$gender=$_POST['v_gender'];

			//patterns for validation
			$pattern_pass='/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/'; //pattern for strong password which should consist of atleast one Upper case, one special character, one numeric chaaracter and should be between 8-20 characters long.
			$pattern_name='/^[a-zA-Z]{1,10}$/'; //pattern for name which should only consist of alphabets and be max 10 characters long
			$pattern_uname='/^[a-zA-Z]{5,}$/';; //only alpha, minimum 5 char, max unlimited
			
			if($pass!=$cpass){ //checks if the password and confirm password matches or not
				$cpass_er='Passwords do not match <br/>';
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
			if (!usernameAvailibityId($uname,$uid)){ //checks for username availibility in the database.
				$uname_taken=$uname.' is not available';
				$error++;
			}
			if ($error==0){ //if no errors found, user is added
				$chk=updateUser($uid,$fname,$lname,$uname,$pass,$email,$gender,$age);
			}
		}else{
			$field_er='Please fill the fieldnames inorder to sign up!';
		}
	}
	if (isset($_POST['img_submit'])){ //to edit the profile picture
		$error1=0;
		$dir="uploaduser";
		$temp=$_FILES['uploadImg']['tmp_name'];
		$name=$_FILES['uploadImg']['name'];
		$size=$_FILES['uploadImg']['size'];
		$type=$_FILES['uploadImg']['type'];
		$uploadfull="$dir/$name";
		if(!file_exists($_FILES['uploadImg']['tmp_name']) || !is_uploaded_file($_FILES['uploadImg']['tmp_name'])){ //TO CHECK IF THE FILE IS UPLOADED OR NOT. Returns false if there is no file
			$pro_result='Please upload a photo <br/>';
			$error1++;	
		}
		if (!imgCheck($size,$type)){ //checks the size and type of image that is being uploaded
			$pro_result='File not supported or too big.';
			$error1++;
		}
		if ($error1==0){ //if there are no errors, picture is updated
			$pro_result=updateProfile($uploadfull,$uid,$temp);
		}
	}
?>
<div class="grid-container">
<div id="viewprofile">
	<div class="grid-x grid-margin-x">
		<div class="cell small-4 medium-4 large-4">
			<p><?php echo $pro_result;?></p> <!--displays result-->
			<img class="thumbnail hundred1" src="<?php echo $profile;?>" style="height:250px; width:250px; border:1px solid white;	"/>
			<br/>
			<p><a data-toggle="panel">Change profile picture</a></p> <!--toggle, only visible after clicked-->
			<div id="panel" class="styleTheToggle hide" data-toggler=".hide">
				<form method="POST" action="" enctype="multipart/form-data"> <!--to upload new picture-->
					<input type="file" name="uploadImg">
					<input type="submit" name="img_submit" value="Upload">
				</form>
			</div>
		</div>
		<div class="cell small-7 medium-7 large-7">
			<div id="view">
				<form class="view" method="POST" action="" enctype="multipart/form-data"> <!--to update the user information-->
					<span class="error"><?php echo $field_er;?></span>
					First Name: <span class="error"><?php echo $fname_er;?></span>
					<input type="text" name="v_firstname" value="<?php echo $fname;?>">
					Last Name: <span class="error"><?php echo $lname_er;?></span>
					<input type="text" name="v_lastname" value="<?php echo $lname;?>" >
					Email:
					<input type="email" name="v_email" value="<?php echo $email;?>" >
					Username: <span class="error"><?php echo $uname_er;?></span> <span class="error"><?php echo $uname_taken;?></span>
					<input type="text" name="v_username" value="<?php echo $uname;?>">
					Password: <span class="error"><?php echo $pass_er;?></span>
					<input type="password" name="v_password" value="<?php echo $pass;?>"data-toggle-focus="form-callout" >
					<div class="secondary callout is-hidden" id="form-callout" data-toggler="is-hidden">
						<p>Password should be strong. A strong password which should consist of atleast one Upper case, one special character, one numeric chaaracter and should be between 8-20 characters long.</p>
					</div>
					Confirm Password: <span class="error"><?php echo $cpass_er;?></span>
					<input type="password" name="v_cpassword" >
					Gender:
					<input type="radio" name="v_gender" value="M"<?php if($gender=='M')echo 'checked'?>> Male
					<input type="radio" name="v_gender" value="F"<?php if($gender=='F')echo 'checked'?>> Female
					<input type="radio" name="v_gender" value="O"<?php if($gender=='O')echo 'checked'?>> Other <br/>
					Age:
					<select name="v_agegroup">
						<optgroup  label="agegroup">
							<option value=">20"<?php if($age=='>20')echo 'selected'?>>Less than 20</option>
							<option value="20-30"<?php if($age=='20-30')echo 'selected'?>>20-30</option>
							<option value="30-40"<?php if($age=='30-40')echo 'selected'?>>30-40</option>
							<option value="40-50"<?php if($age=='40-50')echo 'selected'?>>40-50</option>
							<option value="50+"<?php if($age=='50+')echo 'selected'?>>50 +</option>
						</optgroup>
					</select> <br/>
					<input type="submit" name="v_submit" value="Edit">
				</form>
			</div>
		</div>
	</div>
</div>
</div>