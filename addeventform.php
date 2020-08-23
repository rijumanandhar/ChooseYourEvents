<!--Form to add event-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}else{
	$resultlabel="";//stores the result after adding data, or error if not able to add data
	$filer_er=$file_er=$file1_er=$num_er=$title_er=$short_er=$duration_er=$ticket_er=$location_er=$host_er=$contact_er=$thumb_er=""; //store error messages
	$title=$date=$short=$category=$duration=$ticket=$location=$host=$contact=$description=""; //stores values and is null at the beginning so displays nothing
	include ('connection.php');//database connection
	include ('eventfunctions.php');//event functions

	if(isset($_POST['addevent'])){
		$error=0; //initiating the error count. If $error=0, user can add event

		  $title=$_POST['title'];
		  $date=$_POST['date'];
		  $short=$_POST['short'];
		  $category=$_POST['category'];
		  $duration=$_POST['duration'];
		  $ticket=$_POST['ticket'];
		  $location=$_POST['location'];
		  $host=$_POST['host'];
		  $contact=$_POST['contact'];
		  $description=addslashes($_POST['description']); //add slashes to store in db
			//checking for special characters
		//counts the number of character
		$c_title=strlen($title);
		$c_short=strlen($short);
		$c_duration=strlen($duration);
		$c_ticket=strlen($ticket);
		$c_location=strlen($location);
		$c_host=strlen($host);
		$c_contact=strlen($contact);
		$dir="uploadevent";
            if(!file_exists($dir) /*checks file*/ && !is_dir($dir) /*checks directory*/){
                mkdir($dir); //makes directory
            }
		$temp=$_FILES['uploadthumb']['tmp_name'];
		$name=$_FILES['uploadthumb']['name'];
		$size=$_FILES['uploadthumb']['size'];
		$type=$_FILES['uploadthumb']['type'];
		$uploadfull="$dir/$name"; //gives the path of image
		if(!is_numeric($ticket)){ //checks if price contains anything but numbers
			$num_er="Ticket can only consists of numbers.";
			$error++;
		}
		//checks if file exits
		if(!file_exists($_FILES['uploadthumb']['tmp_name']) || !is_uploaded_file($_FILES['uploadthumb']['tmp_name'])){ //TO CHECK IF THE FILE IS UPLOADED OR NOT. Returns false if there is no file
			$file1_er='  ***Please upload a thumbnail<br/>';
			$error++;	
		}
		if ($c_title>30){ //checks the character length of title
			$title_er="Title cannot be more than 30 characters long.";
			$error++;
		}
		if($c_short>100){//checks the character length of short description
			$short_er="Short Description cannot be more than 100 characters long.";
			$error++;
		}
		if($c_duration>250){//checks the character length of duration
			$duration_er="Duration cannot be more than 250 characters long.";
			$error++;
		}
		if($c_location>100){//checks the character length of location
			$location_er="Location cannot be more than 100 characters long.";
			$error++;
		}
		if($c_host>100){//checks the character length of oranization
			$host_er="Organizor name cannot be more than 100 characters long.";
			$error++;
		}
		if($c_contact>250){//checks the character length of contact
			$contact_er="Contact Information cannot be more than 250 characters long.";
			$error++;
		}
		if(!thumbCheck($size,$type)){ //checks the size and type of thumbnail
			$thumb_er="File can only be jpg, png or gif and less than 1MB";
			$error++;
		}
		if ($error==0){ //if everything is correct, the data are added to the database
			$resultevent=addevent($title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description,$uploadfull,$temp,$uid);
			if ($resultevent){
				$resultlabel="Data Added";
				$title=$date=$short=$category=$duration=$ticket=$location=$host=$contact=$description=""; //resetting values
			}else{
				$resultlabel="Error Adding Data";
			}
			
		}

		
		
	}
}
?>
<div id="addevent">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
			<h2> Add Event</h2> <br/>
			<?php
			echo $resultlabel;
			?>
			<form method="POST" action="" enctype="multipart/form-data">
				<span class="error"><?php echo $filer_er;?></span> 
				<span class="error"><?php echo $title_er ;?></span>
				<input type="text" placeholder="Enter Title" name="title" value="<?php echo $title;?>" required>
				<input type="date" placeholder="Enter Date" name="date" value="<?php echo $date;?>" required>
				Enter Short Description:
				<span class="error"><?php echo $short_er;?></span>
				<textarea rows="2" cols="50" placeholder="Enter Short Description " name="short" required> <?php echo $short;?></textarea>
				Select category: <br/>
				<input type="radio" name="category" value="Music" <?php if($category=='Music')echo 'checked'?>> Music
				<input type="radio" name="category" value="Art" <?php if($category=='Art')echo 'checked'?>> Art
				<input type="radio" name="category" value="Cooking/Fest" <?php if($category=='Cooking/Fest')echo 'checked'?>> Cooking/ Fest
				<input type="radio" name="category" value="Seminar/Conference"<?php if($category=='Seminar/Conference')echo 'checked'?>> Seminar/ Conference
				<input type="radio" name="category" value="Celebration/Party"<?php if($category=='Celebration/Party')echo 'checked'?>> Celebration/ Party
				<input type="radio" name="category" value="Fundraising"<?php if($category=='Fundraising')echo 'checked'?>> Fundraising
				<input type="radio" name="category" value="Sale" <?php if($category=='Sale')echo 'checked'?>> Sale
				<input type="radio" name="category" value="Educational"<?php if($category=='Educational')echo 'checked'?>> Educational
				<input type="radio" name="category" value="Workshop/Internship" <?php if($category=='Workshop/Internship')echo 'checked'?>> Workshop/ Internship
				<br/>
				<span class="error"><?php echo $duration_er ;?></span>
				<textarea rows="2" cols="50" placeholder="Enter Duration" name="duration" ><?php echo $duration?></textarea>
				<span class="error"><?php echo $ticket_er;?></span> <span class="error"><?php echo $num_er ;?></span>
				<input type="text" placeholder="Enter Ticket Price" name="ticket" value="<?php echo $ticket;?>">
				<span class="error"><?php echo $location_er;?></span>
				<input type="text" placeholder="Enter Location" name="location" value="<?php echo $location;?>" >
				<span class="error"><?php echo $host_er;?></span>
				<input type="text" placeholder="Enter Organization's Name" name="host" value="<?php echo $host;?>" required>
				<span class="error"><?php echo $contact_er;?></span>
				<input type="text" placeholder="Enter Contact Info" name="contact" value="<?php echo $contact;?>"required >
				<textarea rows="4" cols="50" placeholder="Enter Detailed Description" name="description" id="description"><?php echo stripslashes($description);?></textarea>
				<br/>
				Upload Thumbnail <span class="error"><?php echo $file_er;?> <?php echo $thumb_er;?></span><br/>
				<input type="file" name="uploadthumb"> 
				<input type="submit" name="addevent" value="Add Event">
			</form>
		</div>
	</div>
</div>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#description' });</script>
