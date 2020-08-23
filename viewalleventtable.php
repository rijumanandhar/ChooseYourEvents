<!--Views all the existing events for admin role 1 page-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}else{
    //Make connection to database
    include ('connection.php');
    //create a query to select records from item table
    $qry="Select i.*,u.username from item i, user u where u.uid=i.userID";
    //run query and store the result in a variable called $result
    $result=mysqli_query($connection,$qry);
    $count=mysqli_num_rows($result);//count the number of results displayed
}
?>
<div id="viewalleventtable">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
            <div class="table-scroll">
                <table>
                <?php
                    if ($count>=1){ //if there are more than one records, displays the table
                    echo'<tr> <th> ID </th>
                    <th> Title </th>
                    <th> Category </th>
                    <th> Date </th>
                    <th width="200"> Short Description </th>
                    <th> Duration </th>
                    <th> Thumbnail </th>
                    <th> Ticket </th> 
                    <th> Location</th>
                    <th width="400"> Detail</th>
                    <th> Host</th>
                    <th> Contact</th>
                    <th> Posted By</th></tr>';
                    while ($row=mysqli_fetch_assoc($result)){ //fetch the datas from db in array form
                        $image=$row['thumbnail']; //stores the path of image from db
                        echo "<tr> <td> ".$row['eventID']."</td> <td>".$row['title']."</td> <td>".$row['category']."</td> <td>".$row['date'];
                        echo  "</td> <td >".$row['shortd']."</td> <td>".$row['duration'];
                        echo "</td> <td> <img class=\"thumbnail\" src=$image alt=$image/> </td>";
                        echo "</td> <td>".$row['ticket']."</td> <td>".$row['location']."</td> <td>".$row['detail']."</td> <td>".$row['host']."</td> <td>".$row['contact']."</td> <td>".$row['username'];
                        echo"</td>";
                        echo "</tr>";
                    }
                    }else{
                        echo '<p> No Events Found </p>';
                    }
                    
                ?>
                </table>
            </div>
		</div>
	</div>
</div>