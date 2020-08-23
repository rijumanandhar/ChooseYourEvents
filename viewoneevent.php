<!--View individual images in detail with relevant pictures and option to buy tickets-->
<?php
//Make connection to database
include ('connection.php');
include ('buytickets.php'); //to buy tickets
//create a query to select records from item table
$qry="select * from item  where eventID=$eid"; //selects only events that is passed by the url in seedetail.php
//run query and store the result in a variable called $result
$result=mysqli_query($connection,$qry);
$count=mysqli_num_rows($result);
if ($count>=1){
    while ($row=mysqli_fetch_assoc($result)){
        //store datas from the database to variables to display below
        $title=$row['title'];
        $category=$row['category'];
        $date=$row['date'];
        $duration=$row['duration'];
        $thumbnail=$row['thumbnail'];
        $ticket=$row['ticket'];
        $location=$row['location'];
        $detail=$row['detail'];
        $host =$row['host'];
        $contact=$row['contact'];
        $_SESSION['price']=$ticket;//passing the value of ticket price by session for booking
    }
}
$qry2="select * from gallery where eventID=$eid limit 4"; //for images stored in gallery of the same event
$result2=mysqli_query($connection,$qry2);
$count2=mysqli_num_rows($result2);
?>

<div class="grid-container"style="background-color: white; padding:20px; border-radius:25px;">
    <div class="grid-x grid-padding-x">
        <div class="cell small-6 medium-6 large-6">
            <a href=<?php echo $thumbnail;?> data-lightbox="gallery"><img class="thumbnail" src="<?php echo $thumbnail;?>"></a>
            <div class="grid-x grid-padding-x">
                <?php //displays extra images from the gallery, uses light box
                    if ($count2>=1){
                        while ($row2=mysqli_fetch_assoc($result2)){
                            $image2=$row2['photourl'];
                            echo "
                            <div class=\"cell small-3 medium-3 large-3\">
                            <a href='$image2' data-lightbox=\"gallery\">   <img class=\"thumbnail img_detail\" src=\"$image2\"></a>
                            </div>";
                        }
                    }else{
                    }
                ?>
            </div>
        </div>
        <!--displays the events details-->
        <div class="cell small-6 medium-6 large-6">
            <h3><?php echo $title;?></h3>
            <p><?php echo $detail;?></p>
            <p> Category: <?php echo $category;?> </p>
            <p> <i class="fi-calendar locationicon"></i> &nbsp; <?php echo $date;?></p>
            <p> Duration: <?php echo $duration;?></p>
            <p> <span class="ticket"><i class="fi-ticket locationicon"></i> &nbsp; Rs.<?php echo $ticket;?> </span> </p>
            <p> <i class="fi-marker locationicon"></i> &nbsp;<?php echo $location;?></p>
            <p> Organizer: <?php echo $host;?></p>
            <p> <i class="fi-address-book locationicon">&nbsp;</i> <?php echo $contact;?></p>
            <a href="#" onclick="document.getElementById('wrapper').style.display='block'"<?php echo $eid; ?> class="button large expanded purple">Buy Ticket</a>
        </div>
    </div>
</div>