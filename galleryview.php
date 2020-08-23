<!--Fetches the photo path from database and displays it for role=2-->
<?php
    //Make connection to database
    include ('connection.php');
    if (isset($role)==2){//if role of the user is 2, then only photos uploaded by that user is displayes
        $qry="Select * from gallery where userID=$uid";
    }
    //run query and store the result in a variable called $result
    $result=mysqli_query($connection,$qry);
    $count=mysqli_num_rows($result);//count the number of results displayed
    if ($count>=1){ // if there is one or more photos
        while ($row=mysqli_fetch_assoc($result)){ 
            $image=$row['photourl']; //holds the place for image
            /**Displays the relevant photos in grid format. On clicked, it is displayed in a light box */
            echo "<div class='cell small-6 medium-6 large-3'>
            <a href='$image' data-lightbox=\"gallery\"><img class=\"thumbnail img\" src='$image' alt='$image'/> </a>
            </div>";
        }
    }else{ //if there are no photos
        echo '<p> No photos to display. </p>';
    }
?>

