<!--views all the users in the database with option for superadmin to change their role and status-->
<?php
if(!isset($_SESSION['login_username'])){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}else{
    $msg="";
    //Make connection to database
    include ('connection.php');
    //create a query to select records from item table
    $qry="Select * from user";
    //run query and store the result in a variable called $result
    $result=mysqli_query($connection,$qry);
    $count=mysqli_num_rows($result);
    if (isset($_POST['u_submit'])){
        $role=$_POST['role'];//gets new role from the form
        $status=$_POST['status'];//gets status from the form
        $uid=$_POST['userID'];//gets uid 
        $query1="update user set role=$role, status=$status where uid=$uid";//updates the role and status
        $result1=mysqli_query($connection,$query1);
        if($result1){
            $msg="Data Updated";
        }else {
            $msg="Error";
        }
    }
}

?>
<div id="viewusertable">
	<div class="grid-x">
		<div class="cell small-12 medium-12 large-12">
            <div class="table-scroll">
             <form method="POST">
             <span class="error"><?php echo $msg;?></span>
             <table>
                <?php
                    if ($count>=1){ //if more than one user
                    echo'<tr> <th> ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Username </th>
                    <th> Password </th>
                    <th> Email </th>
                    <th> Gender </th>
                    <th> Age Group</th>
                    <th> Profile Pic </th>
                    <th> Admin Role </th>
                    <th> Status </th>
                    <th> Delete </th> </tr>';
                    while ($row=mysqli_fetch_assoc($result)){
                        $image=$row['profilepic'];
                        $role=$row['role'];
                        $status=$row['status'];
                        $userID=$row['uid'];
                        echo "<tr> <td> ".$row['uid']."</td> <td>".$row['firstname']."</td> <td>".$row['lastname']."</td> <td>".$row['username'];
                        echo  "</td> <td>".$row['password']."</td> <td>".$row['email']."</td> <td>".$row['gender']."</td> <td>".$row['age'];
                        echo "</td> <td> <img class=\"thumbnail\" src=$image alt=$image/> </td>";
                        //form to change the role and status
                        echo "<td>
                        <select name=\"role\">
                            <optgroup  label=\"role\">
                                <option value='1' ";
                                if($role==1)echo 'selected';
                        echo">SuperAdmin</option>
                                <option value='2'";
                                if($role==2)echo 'selected';
                        echo">Admin</option>
                                <option value='3'";
                                if($role==3)echo 'selected';
                        echo">User</option>
                            </optgroup>
					    </select>";
                        echo"</td> <td> <select name=\"status\">
                        <optgroup  label=\"status\">
                            <option value='0' ";
                            if ($status==0) echo 'selected';
                        echo">Deactive</option>
                            <option value='1'";
                            if($status==1)echo 'selected';
                        echo">Active</option>
                        </optgroup>
					    </select>";
                        echo "</td>";
                        echo "<td> <a href='deleteuser.php?id=".$row['uid']."'> Delete User </a> </td>";
                        echo "</tr>";
                    }
                    }else{
                        echo '<p> No Users Found </p>';
                    }
                    
                ?>
                </table>
                <input type="hidden" name="userID" value="<?php echo $userID;?>"/>
                <input type="submit" name="u_submit" value="Save"/>
                </form> 
            </div>
		</div>
	</div>
</div>