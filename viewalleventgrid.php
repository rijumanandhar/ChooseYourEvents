<!--Displays latest events in list format-->
<?php
$date=date("Y-m-d");//gets date to check upcoming events
//echo $date; 
//Make connection to database
include ('connection.php');
//create a query to select records from item table
$qry="select * from item  where date>'$date' order by date asc limit 4,13"; //selects only events that are happening after the current date , is different from upcoming events
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);//counts the number of results
?>
<div class="grid-container">
    <h4>Events you might like</h4>
    <div class="grid-x grid-margin-x" id="viewalleventgrid">
        <?php 
            if ($count>=1){
                while ($row=mysqli_fetch_assoc($result)){
                    $image=$row['thumbnail'];  //stores the pathway of image
                    //displays the relevant data in grid format with option to add to fav and see detail
                    echo"
                    <div class=\"cell small-4 medium-4 large-4\" >
                        <div class=\"media-object\">
                            <div class=\"media-object-section\">
                                <img class=\"thumbnail hundred\" src=\"$image\">
                            </div>
                                <div class=\"media-object-section\">";
                                if ($session==1){ // if logged in, user can add to favorite
                                    echo "<button type=\"submit\" style=\" float:right;\"><a href=\"fav_add.php?id=".$row['eventID']."\"><i class=\"fi-star fav\"></i></a></button>";
                                }
                           echo" <h5>".$row['title']."</h5>
                                <p>".$row['shortd']."</p>
                                <a href=\"seedetail.php?id=".$row['eventID']."\">See Detail</a>
                            </div>
                        </div>
                    </div>";
                }
            }else{ //f no events found
                echo '<p> No Events Found &nbsp; &nbsp; <br/> </p>';
            }
        ?> 
        <a href="viewwholeeventpage.php">View all events</a>
    </div> 
    
</div>
