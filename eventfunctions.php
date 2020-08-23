<!--All the necessary event related functions-->
<?php
include ('connection.php'); 
/**This function takes the required parameters of an event and adds them to database */
function addEvent($title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description,$uploadfull,$temp,$uid){
	global $connection ;
	$query="insert into item (eventID,title,date,shortd,category,duration,ticket,location,host,contact,detail,thumbnail,userID) values ('','$title','$date','$short','$category','$duration',$ticket,'$location','$host','$contact','$description','$uploadfull','$uid')";
	$result=mysqli_query($connection,$query);
	if ($result){
		move_uploaded_file($temp,$uploadfull);
		return true;
	}else {
		return false;
	}
}

/**This function checks the size and type of thumbnail */
function thumbCheck($size,$type){ 
	if($size<=1048576){ //restrict the file size >1MB upload (the sizes are in bytes)
		if($type=='image/jpeg' OR $type=='image/jpg' OR $type=='image/png' OR $type=='image/gif'){
			return true;  
		}else{
			return false;
		}
	}else{
		return false;;
	}

}

/**This functions takes the required parameters and update the thumbnail of any event */
function updateThumb($uploadfull,$eid,$temp){
	global $connection ;
	$query="update item set thumbnail='$uploadfull' where eventID=$eid";
	$result=mysqli_query($connection,$query);
    if ($result){
		if (move_uploaded_file($temp,$uploadfull)){
			//return "Thumbnail updated.";
			header("Location: {$_SERVER['HTTP_REFERER']}");
			
		}else{
			return "Image can't be moved.";
		}
	}else {
		return "<br/> Error Updating Thumbnail.";
	}
}

/**This functions takes the required parameters and delete the given event */
function deleteEvent($id){
	global $connection ;
	$query="delete from item where eventID=$id";
	$result=mysqli_query($connection,$query);
	if ($result){
		return 'Event Deleted';
		header("Location: viewevent.php");
	}else {
		return "<br/> Error Deleting Data";
	}
}

/**This functions takes the required parameters and update the given event */
function updateEvent($title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description,$id){
	global $connection ;
	$query="update item set title='$title',date='$date',shortd='$short',category='$category',duration='$duration',ticket=$ticket,location='$location',host='$host',contact='$contact',detail='$description' where eventID=$id";
	$result=mysqli_query($connection,$query);
	if ($result){
			return "Data updated.";
			//header("Location: {$_SERVER['HTTP_REFERER']}");
			
	}else {
		echo "$title,$date,$short,$category,$duration,$ticket,$location,$host,$contact,$description,$id";
		return "<br/> Error Updating Data.";
	}
}

/**This function takes the required parameters and book events on the basis of eid and uid and stored them in purchase table */
function bookTicket($uid,$eid,$amount){
	global $connection;
	$query="insert into purchase values ('',$uid,$eid,$amount)";
	$result=mysqli_query($connection,$query);
	if ($result){
		return "<h3><span class='green'><i class='fi-burst'></i> Ticket Booked </span> </h3>";
	}else{
		return 'Booking Failed';
	}
}

function selectThumb($pic, $eid){
	global $connection ;
	$query="update item set thumbnail='$pic' where eventID=$eid";
	$result=mysqli_query($connection,$query);
    if ($result){
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}else {
		return "<br/> Error Updating Thumbnail.";
	}

}
?>