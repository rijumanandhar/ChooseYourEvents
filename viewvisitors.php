<!--view how many people bought ticket for which event and posted by who-->
<?php
//Make connection to database
include ('connection.php');
if ($role==2){ //if role is 2, only events added by that user is taken into consideration
    $query="select count(p.userID) as 'Number', e.title,u.username from purchase p, item e, user u where p.eventID=e.eventID and p.userID=u.uid and e.userID=$uid group by e.title";
}else if ($role==1){//if role is 1, only all events are taken into consideration
    $query="select count(p.userID) as 'Number', e.title,u.username from purchase p, item e, user u where p.eventID=e.eventID and p.userID=u.uid group by e.title";
}
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
?>
<div id="viewusertable">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
            <div class="table-scroll">
                <table>
                <?php
                    if ($count>=1){
                        //display relevant datas
                    echo'<tr> <th>Event Name </th>
                    <th> Number of Visitors </th>
                    <th> Posted By </th>
                    </tr>';
                    while ($row=mysqli_fetch_assoc($result)){
                       echo "<tr> <td>".$row['title']."</td> <td>".$row['Number']."</td> <td>".$row['username']."</td> </tr>";
                        
                    }
                    }else{
                        echo '<p> No Data Found </p>';
                    }  
                ?>
                </table>
            </div>
		</div>
	</div>
</div>