<!--Necessary functions required to add fav, remove and remove all-->
<?php
include ('connection.php');
/**This function takes the required parameters and add them to favorite table */
function addToFav($uid, $eid){
    global $connection;
    $query="insert into favorite values('',$uid,$eid)";
    $result=mysqli_query($connection,$query);
    if ($result){
        //echo 'Added to Fav';
    }else {
        //echo 'couldn\'t add';
    }
}

/**This function takes the required parameters and remove idividual item from favorite table */
function removeFav($uid,$eid){
    global $connection;
    $query="delete from favorite where eventID=$eid and userID=$uid";
    $result=mysqli_query($connection,$query);
    if ($result){
        //echo 'removed from fav';
    }else{
        //echo 'couldn\'t remove';
    }
}


/**This function takes the required parameters and remove all items from favorite table */
function removeAll($uid){
    global $connection;
    $query="delete from favorite where userID=$uid";
    $result=mysqli_query($connection,$query);
    if ($result){
        //echo 'removed all';
    }else{
        //echo 'couldn\'t delete';
    }
}

/**This function prevents same event from being favourited twice */
function checkfav($uid, $eid){
    global $connection;
    $query="select * from favorite where eventID=$eid and userID=$uid";
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    if ($count>=1){
        return false;
    }else{
        return true; //returns true if no match found
    }
}
?>