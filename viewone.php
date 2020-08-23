<?php
session_start();
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
   header('Location: index.php'); exit();
}else{
	include('eventfunctions.php');
	$resultlabel=$pro=$img_er="";//stores the result after adding data, or error if not able to add data
	$file_er=$num_er=$title_er=$short_er=$duration_er=$ticket_er=$location_er=$host_er=$contact_er=$thumb_er=""; //store error messages
	$title=$date=$short=$category=$duration=$ticket=$location=$host=$contact=$description=""; //stores values and is null at the beginning so displays nothing
	if (isset($_GET['id'])){
        $eid=$_GET['id'];
        //Make connection to database
        include ('connection.php');
        //create a query to select records from item table
        $qry="select *, username from item i, user u where i.userID=u.uid and eventID=$eid;";
        //run query and store the result in a variable called $result
        $result=mysqli_query($connection,$qry);
        $count=mysqli_num_rows($result);
        if ($count>=1){
            while ($row=mysqli_fetch_assoc($result)){
				$title=$row['title'];
				$category=$row['category'];
				$date=$row['date'];
				$short=$row['shortd'];
				$duration=$row['duration'];
				$thumbnail=$row['thumbnail'];
				$ticket=$row['ticket'];
				$location=$row['location'];
				$description=$row['detail'];
				$host=$row['host'];
				$contact=$row['contact'];
				$userID=$row['userID'];
				$uname=$row['username'];
            }
		}
		
	}
	if (isset($_POST['img_submit'])){
		$error1=0;
		$result="";
		$dir="uploadevent";
		$eid= $_GET['id'];
		$temp=$_FILES['uploadImg']['tmp_name'];
		$name=$_FILES['uploadImg']['name'];
		$size=$_FILES['uploadImg']['size'];
		$type=$_FILES['uploadImg']['type'];
		$uploadfull="$dir/$name";
		if(!file_exists($_FILES['uploadImg']['tmp_name']) || !is_uploaded_file($_FILES['uploadImg']['tmp_name'])){ //TO CHECK IF THE FILE IS UPLOADED OR NOT. Returns false if there is no file
			$pro='Please upload a photo <br/>';
			$error1++;	
		}
		if (!thumbCheck($size,$type)){ //checks the size and type of image that is being uploaded
			$pro='File not supported or too big.';
			$error1++;
		}
		if ($error1==0){
			$resultm=updateThumb($uploadfull,$eid,$temp);
		}
	}
	if (isset($_POST['editevent'])){
		include ('connection.php');
		$error=0;
		$title=$_POST['title'];
		$date=$_POST['date'];
		$short=$_POST['short'];
		$category=$_POST['category'];
		$duration=$_POST['duration'];
		$ticket=$_POST['ticket'];
		$location=$_POST['location'];
		$host=$_POST['host'];
		$contact=$_POST['contact'];
		$description=addslashes($_POST['description']);
		$id=$_POST['eventID'];
		//counts the number of character
		$c_title=strlen($title);
		$c_short=strlen($short);
		$c_duration=strlen($duration);
		$c_ticket=strlen($ticket);
		$c_location=strlen($location);
		$c_host=strlen($host);
		$c_contact=strlen($contact);
		if (!isset($title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description)){
			$file_er="Please fill all the fields";
			$error++;
		}
		if(!is_numeric($ticket)){
			$num_er="Ticket can only consists of numbers.";
			$error++;
		}
		if ($c_title>30){
			$title_er="Title cannot be more than 30 characters long.";
			$error++;
		}
		if($c_short>100){
			$short_er="Short Description cannot be more than 100 characters long.";
			$error++;
		}
		if($c_duration>250){
			$duration_er="Duration cannot be more than 250 characters long.";
			$error++;
		}
		if($c_ticket>20){
			$ticket_er="Ticket Information cannot be more than 20 characters long.";
			$error++;
		}
		if($c_location>100){
			$location_er="Location cannot be more than 100 characters long.";
			$error++;
		}
		if($c_host>100){
			$host_er="Organizor name cannot be more than 100 characters long.";
			$error++;
		}
		if($c_contact>250){
			$contact_er="Contact Information cannot be more than 250 characters long.";
			$error++;
		}
		if ($error==0){ 
			$resultlabel=updateEvent($title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description,$id);
		}

	}
	if (isset($_POST['deleteevent'])){
		$id=$_POST['eventID'];
		$resultlabel=deleteEvent($id);
	}
	if (isset($_POST['select'])){
		$pic=$_POST['pic'];
		selectThumb($pic, $eid);
	}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin Panel/View Event</title>
		<?php include ('admin_header.php'); ?>
	</head>
	<body>
		<div class="grid-x">
			<div class="cell small-2 medium-2 large-2">
				<?php include ('nav2.php'); ?>
			</div>
			<div class="cell small-10 medium-10 large-10">
				<?php include ('banner.php'); ?>
				<div class="grid-container" >
					<div id="viewone">
						<div class="grid-x">
							<div class="cell small-3 medium-3 large-3">
								<p><?php echo $pro;?></p>
								<img class="thumbnail" src="<?php echo $thumbnail;?>"/>
								<p><a data-toggle="panel">Change thumbnail</a></p>
								<div id="panel" class="styleTheToggle hide" data-toggler=".hide">
									<form action="" method="POST" enctype="multipart/form-data">
										<input type="file" name="uploadImg">
										<span class="error"><?php echo $file_er;?></span> 
										<span class="error"><?php echo $img_er.'<br/>';?></span>
										<input type="submit" name="img_submit" value="Upload">
									</form>
									<hr> <p>Or select from the gallery</p>
									<form method="POST" enctype="multipart/form-data">
										<select name="pic">
											<optgroup  label="pic">
												<?php
												$qry="select * from gallery where eventID=$eid";
												$result=mysqli_query($connection,$qry);
												$count=mysqli_num_rows($result);//count the number of results displayed
												if ($count>=1){
													while ($row=mysqli_fetch_assoc($result)){ //displays all the events posted by that user
														$pic=$row['photourl'];
														echo "<option value=\"$pic\">$pic</option>";
													}
												}else{
													echo "<option> No Events Added</option>";
												}
												?>
											</optgroup>
										</select>
										<input type="submit" value="select" name="select"/>
									</form>
								</div>
							</div>
							<div class="cell small-9 medium-9 large-9">
								<div id="view">
									<?php echo $resultlabel;?>
									<form method="POST" action="" enctype="multipart/form-data">
										<input type="hidden" value="<?php echo $eid ;?>" name="eventID">
										<span class="error"><?php echo $file_er;?></span>
										Title:
										<span class="error"><?php echo $title_er ;?></span>
										<input type="text" value="<?php echo $title;?>" name="title">
										Date:
										<input type="date" value="<?php echo $date;?>" name="date">
										Short Description:
										<span class="error"><?php echo $short_er;?></span>
										<textarea rows="2" cols="50" name="short"><?php echo $short;?></textarea>
										Category <br/>
										<input type="radio" name="category" value="Music"<?php if($category=='Music')echo 'checked'?>> Music
										<input type="radio" name="category" value="Art" <?php if($category=='Art')echo 'checked'?>> Art
										<input type="radio" name="category" value="Cooking/Fest" <?php if($category=='Cooking/Fest')echo 'checked'?>> Cooking/ Fest
										<input type="radio" name="category" value="Seminar/Conference" <?php if($category=='Seminar/Conference')echo 'checked'?>> Seminar/ Conference
										<input type="radio" name="category" value="Celebration/Party" <?php if($category=='Celebration/Party')echo 'checked'?>> Celebration/ Party
										<input type="radio" name="category" value="Fundraising" <?php if($category=='Fundraising')echo 'checked'?>> Fundraising
										<input type="radio" name="category" value="Sale" <?php if($category=='Sale')echo 'checked'?>> Sale
										<input type="radio" name="category" value="Educational" <?php if($category=='Educational')echo 'checked'?>> Educational
										<input type="radio" name="category" value="Workshop/Internship" <?php if($category=='Workshop/Internship')echo 'checked'?>> Workshop/ Internship
										<br/>
										Duration:
										<span class="error"><?php echo $duration_er ;?></span>
										<textarea rows="2" cols="50" name="duration" ><?php echo $duration;?></textarea>
										Ticket:
										<span class="error"><?php echo $ticket_er;?></span> <span class="error"><?php echo $num_er ;?></span>
										<input type="text" value="<?php echo $ticket;?>" name="ticket">
										<span class="error"><?php echo $location_er;?></span>
										Location:
										<input type="text" value="<?php echo $location;?>" name="location">
										Host:
										<span class="error"><?php echo $host_er;?></span>
										<input type="text" value="<?php echo $host;?>" name="host">
										Contact:
										<span class="error"><?php echo $contact_er;?></span>
										<input type="text" value="<?php echo $contact;?>" name="contact">
										Description:
										<textarea rows="4" cols="50" name="description" id="description"><?php echo stripslashes($description);?></textarea> 
										Posted By:
										<input type="text" value="<?php echo $uname;?>" name="username" disabled>
										<input type="submit" name="editevent" value="Edit">
										<input type="submit" name="deleteevent" value="Delete">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'#description' });</script>
</html>