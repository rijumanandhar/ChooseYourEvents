<!--Allow admin role 2 to upload multiple photos for gallery-->
<?php
if(!isset($_SESSION['login_username'])&&!isset($_SESSION['login_role'])==2){ //checks for the session and if the session doesn't exist, it returns to the landing page
	header('Location: index.php'); exit();
}else{
    //Make connection to database
    include ('connection.php');
    $error=0;
    $photo=0;
    /**Displays the array in organized way */
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    /**This array stores all the errors in a an array to display error messages later */
    $fileuploaderrors=array(
        0=>'No errors, file upload success',
        1=>'Exceeds the max limit from php.ini directory',
        2=>'Exceeds the max limi as indicated in html form',
        3=>'File only partially uploaded',
        4=>'No files were uploaded',
        6=>'Missing a temporary folder',
        7=>'Failed to write file on the disk',
        8=>'PHP extension invalid'
    );

    /**This function re arranges the array's keys and values for our convinient */
    function reArrayFiles ($file_post){
        $file_ary=array();
        $file_count=count($file_post['name']);
        $file_keys=array_keys($file_post);
    
        for ($i=0;$i<$file_count;$i++){
            foreach ($file_keys as $key){
                $file_ary[$i][$key]=$file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    if (isset($_POST['i_submit'])){ //after its uploaded
        if(isset($_POST['event'])){//selects event to add photos to
            $eid=$_POST['event'];//sets the value for event id
            if (isset($_FILES['userfile'])){//if file exits
                //pre_r($_FILES['userfile']);
                $file_array=reArrayFiles($_FILES['userfile']);//rearrange the keys and values of the array
                //pre_r($file_array) ;
                for ($i=0;$i<count($file_array);$i++){
                    if ($file_array[$i]['error']){//checks for any errors
                        echo $file_array[$i]['name'].$fileuploaderrors[$file_array[$i]['error']];
                        $error++;
                    }else{//checks for valid extensions
                        $extensions=array('jpg','jpeg','png','gif'); //all the extensions allowed during upload
                        $file_ext=explode('.',$file_array[$i]['name']); //use . as delimeter to separate the string
                        $file_ext= end($file_ext);//stores the end of the string i.e. the extensions after delimeter
                        if (!in_array($file_ext,$extensions)){ //if the extensions stored in $file_ext aren't in $extensions
                            echo $file_array[$i]['name']."Invalid file extension";
                            $error++;
                        }
                    }
                    if ($error==0){ //if uploaded photos has no errors
        
                        //create folder for uploaded images
                        $dir="uploadevent";
                        if(!file_exists($dir) /*checks file*/ && !is_dir($dir) /*checks directory*/){
                            mkdir($dir); //makes directory
                        }
        
                        $uploadfull="$dir/".$file_array[$i]['name']; //gives the path of image
                        $temp=$file_array[$i]['tmp_name'];
        
                        //create a query to select records from item table
                        $query="insert into gallery values ('','$uploadfull',$uid,$eid)";
                        //run query and store the result in a variable called $result
                        $result=mysqli_query($connection,$query);
                        if ($result){
                            move_uploaded_file($temp,$uploadfull);//moves the file
                            $photo++;
                        }else {
                           echo "<br/> Error Adding Data";
                        }
                    }
                }
                if ($photo>0){
                    echo 'Photo(s) added.';//display result
                }
            } 

        }else{
            echo 'Select an event';
        }
    }
}
?>
<form method="POST" enctype="multipart/form-data" action="uploadphotos.php">
    Choose upto four pictures:
    <input type="file" name="userfile[]" multiple=""/>
    <input type="submit" value="upload" name="i_submit"/>
</form>