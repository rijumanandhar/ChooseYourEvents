<!--All the functions related to user activity-->
<?php
    include('connection.php');
    
   /*This function checks if the username is available or not. It checks for the username given in the database and returns
   false if a match is found. It is used when a new user registers and is searching for new username. */  
   function usernameAvailibity($uname){
        global $connection ;
        $query="select * from user where username='$uname'";
        $result=mysqli_query($connection,$query);
        $count=mysqli_num_rows($result);
        if ($count>=1){
            return false;
        }else{
            return true;
        }
    }

    /*This function checks if the username is available or not while ignoring the current username of the given user id.
    It is used when an existing user wants to update their username.*/  
    function usernameAvailibityId($uname,$uid){
        global $connection ;
        $query="select * from user where username='$uname' and uid!=$uid";
        $result=mysqli_query($connection,$query);
        $count=mysqli_num_rows($result);
        if ($count>=1){
            return false;
        }else{
            return true;
        }
    }

    /*This function checks the size and type of the uploaded profile picture and if they are valid, returns true else false */
    function imgCheck($size,$type){
        if($size<=1048576){ //restrict the file size >1MB upload (the sizes are in bytes)
            if($type=='image/jpeg' OR $type=='image/jpg' OR $type=='image/png' OR $type=='image/gif'){
                return true;  //valid types are jpeg, jpg, png and gif
            }else{
                return false;
            }
        }else{
            return false;;
        }

    }

    /**This function takes the parameters required to fill the data in user table and inserts data to them */
    function addUser($fname,$lname,$uname,$pass,$email,$gender,$age,$uploadfull,$temp){
        global $connection ;
        $password=md5($pass);
        $query="insert into user values ('','$fname','$lname','$uname','$password','$email','$gender','$age','$uploadfull',3,0)";
        $result=mysqli_query($connection,$query);
        if ($result){
            move_uploaded_file($temp,$uploadfull);//if insertion is complete, the uploaded profile pic will be moved to the upload folder
            $account=sendActivation($uname,$email); //sends the activation code to the user to turn the status on 
            return $account; 
        }else {
            echo "<br/> Error Adding Data";
        }
    }

    /**This function takes the required parameters to update the exisiting datas in user table by their user ID */
    function updateUser($uid,$fname,$lname,$uname,$pass,$email,$gender,$age){
        global $connection ;
        $password=md5($pass);
        $query="update user set firstname='$fname',lastname='$lname',username='$uname',password='$password',email='$email',gender='$gender',age='$age' where uid=$uid ";
        $result=mysqli_query($connection,$query);
        if ($result){
            $_SESSION['login_username']=$uname;
            $_SESSION['login_password']=$pass;
            //return "Update success";
            header("Location: {$_SERVER['HTTP_REFERER']}"); //returns to the page referred
        }else {
            return "<br/> Error Updating Data";
        }
    }

    /**This function takes the required parameters to update the existing profile picture of a user */
    function updateProfile($uploadfull,$uid,$temp){
        global $connection ;
        $query="update user set profilepic='$uploadfull' where uid=$uid";
        $result=mysqli_query($connection,$query);
        if ($result){
            if (move_uploaded_file($temp,$uploadfull)){
                //return "Profile pic updated.";
                header("Location: {$_SERVER['HTTP_REFERER']}");//returns to the page referred
            }else{
                return "Image can't be moved.";
            }
            
        }else {
            return "<br/> Error Updating Profile pic.";
        }
    }

    /**This function sends an email to the user to activate their status */
    function sendActivation($uname,$email){
        $code="activation.php?id=".$uname;
        $msg="Hello $uname, <br/> <br/> Thanks for joining our website. Click <a href='$code'> Here </a> to 
        activate your account. <br/> <br/> ChooseyourEvent.com <br/>";
        echo $msg;
        // if (mail($email,"Account Activation",$msg)){
        //     return "Check your email to activate your account.";
        // }else{
        //     return "Cannot add user account.";
        // }

    }
     /**This function gets the user id and delete it from user table */
    function deleteUser($uid){
        global $connection;
        $query="delete from user where uid=$uid";
        $result=mysqli_query($connection,$query);
        if ($result){
            header("Location: {$_SERVER['HTTP_REFERER']}");//returns to the page referred
        }else{
            echo'error';
        }
    }
    
?>