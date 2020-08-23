<!--gets the purchase id from url and deletes from purchase table-->
<?php
if (isset($_GET['pid'])){
    $pid=$_GET['pid'];//gets the pid from url
    include ('connection.php');
	$query="delete from purchase where purchaseID=$pid"; //delete query
	$result=mysqli_query($connection,$query);
	if ($result){
			echo "Data updated.";
			header("Location: {$_SERVER['HTTP_REFERER']}"); //refers to refered page
			
	}else {
		echo "<br/> Error Refunding..";
	}
}
?>