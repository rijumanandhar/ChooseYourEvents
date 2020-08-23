<!--Displays the list of events user has booked-->
<?php
//Make connection to database
include ('connection.php');
//create a query to select records from item table
$qry="select * from item, purchase where item.eventID=purchase.eventID and purchase.userID=$uid;"; //selects all events 
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);//counts the number of result displayed
echo "<h5> Events you booked</h5>";
if ($count>=1){ //if there are any result
    while ($row=mysqli_fetch_assoc($result)){
        $image=$row['thumbnail'];//stores the pathway for image
        /**Displays all the relevant information in grid format with option to see detail and seek refund */
        echo"
        <div class=\"media-object\">
            <div class=\"media-object-section\">
                <img class=\"thumbnail hundred\" src=\"$image\">
            </div>
                <div class=\"media-object-section\">
                <h5>".$row['title']."</h5>
                <p> <i class=\"fi-calendar locationicon\"></i> &nbsp;".$row['date']."
                <br/> <i class=\"fi-marker locationicon\"></i> &nbsp;".$row['location']."<br/>
                <a href='seedetail.php?id=".$row['eventID']."'>See Detail</a>  &nbsp; &nbsp;
                <a href='refund.php?pid=".$row['purchaseID']."'>Refund</a> </p> <hr>
            </div>
        </div>";
    }
}else{//if no result
    echo "<p> You have booked no events. <br/> Click <a href='viewwholeeventpage.php'>here </a> to view events.</p>";
}
?>
