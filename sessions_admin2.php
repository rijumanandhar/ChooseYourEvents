<!--checks sessions for login role 2 admins-->
<?php
if(isset($_SESSION['login_username'])&&isset($_SESSION['login_role'])==2){ //checks for the session and if the session doesn't exist, it returns to the landing page
     $usern2=$_SESSION['login_username']; //grabs the username passed by session while logging in
     include ('connection.php');
     $query="select * from user where username='$usern2'";
     $result=mysqli_query($connection,$query); //runs the query
     $count=mysqli_num_rows($result); //checks the number of rows affected by the query
     if ($count>=1){
         while ($row=mysqli_fetch_assoc($result)){ //can fetch the datas from the table
             $uid= $row['uid'];
             $fname=$row['firstname'];
             $lname=$row['lastname'];
             $uname=$row['username'];
             $pass=$_SESSION['login_password'];
             $email=$row['email'];
             $gender=$row['gender'];
             $age=$row['age'];
             $profile=$row['profilepic'];
             $role=$row['role'];
             if ($role==2){ //creating sessions if the role is of admin, else redirect to homepage
                 $_SESSION['uid']=$uid;
                 $_SESSION['fname']=$fname;
                 $_SESSION['lname']=$lname;
                 $_SESSION['email']=$email;
                 $_SESSION['gender']=$gender;
                 $_SESSION['age']=$age;
                 $_SESSION['profile']=$profile;
                 $_SESSION['role']=$role;
             }else{
                 header('Location: index.php'); exit(); //else refer to index page
             }
         }
     }
 } else{
    header('Location: index.php'); exit();
}
?>