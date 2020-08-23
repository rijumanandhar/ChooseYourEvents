<!--Gets all the active users whose role=2 and displays them is tabular format-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}else{
    //Make connection to database
    include ('connection.php');
    //create a query to select records from item table
    $qry="Select * from user where role=2";
    //run query and store the result in a variable called $result
    $result=mysqli_query($connection,$qry);//run the query
    $count=mysqli_num_rows($result); //count the number of results
}
?>
<div id="viewadmintable">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
            <div class="table-scroll">
                <table>
                <?php
                    if ($count>=1){
                    echo'<tr> <th> ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Username </th>
                    <th> Email </th>
                    <th> Profile Pic </th>
                    <th> Status </th> </tr>';
                    while ($row=mysqli_fetch_assoc($result)){
                        $image=$row['profilepic'];//stores image path
                        //displays relevant information in tabular format
                        $status=$row['status'];
                        echo "<tr> <td> ".$row['uid']."</td> <td>".$row['firstname']."</td> <td>".$row['lastname']."</td> <td>".$row['username'];
                        echo  "</td> <td>".$row['email']."</td> ";
                        echo "</td> <td> <img class=\"thumbnail hundred\" src=$image alt=$image/> </td>";
                        echo "<td>";
                        switch ($role) {
                            case 0:
                                echo 'Deactive';
                                break;
                            case 1:
                                echo'Active';
                                break;
                        }
                        echo"</td>";
                        echo "</tr>";
                    }
                    }else{//if there are no users
                        echo '<p> No Users Found </p>';
                    }
                    
                ?>
                </table>
            </div>
		</div>
	</div>
</div>