<!--views all the events added by that particular admin-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}
//Make connection to database
include ('connection.php');
//create a query to select records from item table
$qry="Select * from item where userID=$uid;";
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);
?>
<div id="viewevent">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
			<table class="hover">
			<?php
				if ($count>=1){
				 echo'<tr> <th> Title </th>
				 <th> Thumbnail </th>
				 <th> Short Description </th>
				 <th> Date </th>
				 <th> Ticket </th>
				 <th> </th> </tr>';
				 while ($row=mysqli_fetch_assoc($result)){
					 //displays all the relevant data with the option to see details
					 $image=$row['thumbnail'];
					 echo '<tr> <td>'.$row['title'].'</td><td>';
					 echo "<img class=\"thumbnail\" src=$image alt=$image/>";
					 echo '</td><td>'.$row['shortd'].'</td><td>'.$row['date'].'</td><td>'.$row['ticket'].'</td><td>';
					 echo "<a href=\"viewone.php?id=".$row['eventID']."\"> See Details </a>";
					 echo '</td></tr>';

				 }
				}else{//if no results
					echo '<p> No Events Available. Click <a href=addeventpage.php> here </a> to add some. </p><br/>';
				}
				
			?>
			</table>
		</div>
	</div>
</div>