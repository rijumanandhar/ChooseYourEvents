<!--Displays all photos for events in the website for admin role 1-->
<?php
//Make connection to database
include ('connection.php');
    $query="Select * from gallery";
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
if ($count>=1){
    while ($row=mysqli_fetch_assoc($result)){ 
        $image=$row['photourl']; //stores image path
        //displays all image with light box js
        echo "<div class='cell small-6 medium-6 large-3'>
            <a href='$image' data-lightbox=\"gallery\"><img class=\"thumbnail img\" src='$image' alt='$image'/> </a>
            </div>";
    }
}else{
    echo '<p> no events to display </p>';
}
?>
