<!--displays the favorites of a particular user-->
<?php
include ('sessions_user.php'); //sessions for user
include ('fav_function.php'); //functions required for fav
$query="select i.* from item i, favorite f where i.eventID=f.eventID and f.userID=$uid";//selects the fav through favourite table and event table
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);//counts the number of result displayed
?>
<div class="grid-container" id="viewalleventgrid">
<a href="fav_removeall.php" class="button small  hollow">Remove all</a> <!--to remove everything in fav -->
    <div class="grid-x grid-margin-x">
        <?php
        if ($count>=1){
            while ($row=mysqli_fetch_assoc($result)){
                //displays relevant information in grid with options to remove fav and see details 
                $image=$row['thumbnail'];//holds the image path
                echo"
                <div class=\"cell small-6 medium-4 large-3\">
                <img class=\"thumbnail hundred1\" src=\"$image\">
                <div id=\"title\">
                <h5>".$row['title']."</h5>
                </div>
                <div id=\"description1\">
                <p>".$row['shortd']."</p>
                </div>
                <p><span class=\"ticket\"> <i class=\"fi-ticket locationicon\"></i> &nbsp;Rs.".$row['ticket']." </span></p>
                <p><a href=\"seedetail.php?id=".$row['eventID']."\" class=\"button small  hollow\">See Details</a>
                <a href=\"fav_remove.php?id=".$row['eventID']."\" class=\"button small  hollow\">Remove</a>
                </p>
                </div>";
            }
        }
        ?>
     </div>
    </div>