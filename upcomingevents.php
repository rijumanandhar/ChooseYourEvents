<!--Display most recent 4 events based on the current system's date--> 
<?php
$date=date("Y-m-d");//gets date to check upcoming events
//echo $date; 
//Make connection to database
include ('connection.php');
//create a query to select records from item table
$qry="select * from item  where date>'$date' order by date asc limit 4"; //selects only events that are happening after the current date in ascending order, limited to 4 datas only
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);
?>
<div class="grid-container">
    <div class="grid-x grid-margin-x">
        <?php
        //displays relevant information in cards with options to add fav and see details 
            if ($count>=1){
                while ($row=mysqli_fetch_assoc($result)){
                    $image=$row['thumbnail'];
                    echo"
                    <div class=\"cell medium-6 large-3 small-6\">
                        <div class=\"card\">
                            <div class=\"card-divider\">
                                <h4>".$row['title']."</h4>
                            </div>
                            <div class=\"card-section\">
                                <img class=\"thumbnail\" src=\"$image\">
                                
                                <p>".$row['shortd']."</p>
                                 <hr>";
                                 if ($session==1){  // if logged in, user can add to favorite
                                     echo "<button type=\"submit\" style=\" float:right;\"><a href=\"fav_add.php?id=".$row['eventID']."\"><i class=\"fi-star fav\"></i></a></button>";
                                 }
                                echo"<p> <span class=\"ticket\"> <i class=\"fi-ticket locationicon\"></i> &nbsp;Rs.".$row['ticket']."</span> <br/><i class=\"fi-calendar locationicon\"></i>
                                &nbsp;".$row['date']."</p>
                                <a href=\"seedetail.php?id=".$row['eventID']."\">See Detail</a>
                            </div>
                        </div>
                    </div>";
                }
            }else{
                echo '<p> No Events </p>';
            }
        ?>   
    </div>
</div>
