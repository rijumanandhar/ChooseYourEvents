<!--displays similar events on the basis of category--> 
<?php
//Make connection to database
include ('connection.php');
//echo $category;
$query="select * from item where category='$category' and eventID<>$eid limit 4"; //selects the category from items to view events of similar category
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
?>
<div class="grid-container">
    <div class="grid-x grid-margin-x" id="viewalleventgrid">
    <div class="cell medium-12 large-12 small-12 text-center"> <!--aligns the text in center-->
        <h4>Similar Events</h4>
    </div>
        <?php
            if ($count>=1){
                while ($row=mysqli_fetch_assoc($result)){
                    $image=$row['thumbnail']; //stores the image location from db
                    echo "
                    <div class=\"cell medium-4 large-3 small-6\">
                        <img class=\"thumbnail hundred1\" src=\"$image\">";//holds image path
                        if ($session==1){  // if logged in, user can add to favorite
                            echo "<button type=\"submit\" style=\" float:right;\"><a href=\"fav_add.php?id=".$row['eventID']."\"><i class=\"fi-star fav\"></i></a></button>";
                        }
                        //displays all the relevant results
                        echo "<div id=\"title\">
                        <h5>".$row['title']."</h5>
                        </div>
                        <p><span class=\"ticket\"> <i class=\"fi-ticket locationicon\"></i> &nbsp;Rs.".$row['ticket']." </span>
                        <br/><i class=\"fi-marker locationicon\"></i>  &nbsp;".$row['location']." </span>
                        <br/><i class=\"fi-calendar locationicon\"></i> &nbsp;".$row['date']." </span> </p>
                        <a href=\"seedetail.php?id=".$row['eventID']."\" class=\"button small expanded hollow\">See Details</a>
                        </div>";
                }
            }else{
                echo "No Events found.";
            }
        ?>
	</div>
</div>