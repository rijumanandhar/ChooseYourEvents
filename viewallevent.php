<!--views all events in the database in grid format wit the option to see details and add to fav-->
<?php
//Make connection to database
include ('connection.php');
//create a query to select records from item table
$qry="select * from item "; //selects all events 
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);
?>
<div class="grid-container">
<div class="grid-x grid-margin-x" id="viewalleventgrid">
    <?php 
        if ($count>=1){
            while ($row=mysqli_fetch_assoc($result)){
                $image=$row['thumbnail'];
                //displays relevant information in grid format with option to add to fav and see details
                echo"
                <div class=\"cell small-6 medium-4 large-3\">
                <img class=\"thumbnail hundred1\" src=\"$image\">";
                if ($session==1){  // if logged in, user can add to favorite
                    echo "<button type=\"submit\" style=\" float:right;\"><a href=\"fav_add.php?id=".$row['eventID']."\"><i class=\"fi-star fav\"></i></a></button>";
                }
                echo "<div id=\"title\">
                <h5>".$row['title']."</h5>
                </div>
                <div id=\"description1\">
                <p>".$row['shortd']."</p>
                </div>
                <p><span class=\"ticket\"> <i class=\"fi-ticket locationicon\"></i> &nbsp;Rs.".$row['ticket']." </span></p>
                <a href=\"seedetail.php?id=".$row['eventID']."\" class=\"button small expanded hollow\">See Details</a>
                </div>";
            }
        }
    ?>
</div>

</div>
