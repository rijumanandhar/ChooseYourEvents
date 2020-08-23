<!---Views the events according to their catagory->
<?php

/**This function takes a category as a parameter and displays all the event of that category */
function getCategory($category){
    global $session;
    //connection to the database
    include('connection.php');
    $query="select * from item where category='$category' limit 9";
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);//counts the number of rows affected by the query
    echo"<div class=\"grid-container\">
    <div class=\"grid-x grid-margin-x\" id=\"viewgrid\">";
    if ($count>=1){ //if one or more than one result
        while ($row=mysqli_fetch_assoc($result)){
            $image=$row['thumbnail']; //stores the path of image from the database
            //displays the relevant information in grid format 
            echo"
            <div class=\"cell small-6 medium-4 large-3\">
            <img class=\"thumbnail hundred1\" src=\"$image\"> ";
            if ($session==1){  // if logged in, user can add to favorite
                echo "<button type=\"submit\" style=\" float:right;\"><a href=\"fav_add.php?id=".$row['eventID']."\"><i class=\"fi-star fav\"></i></a></button>";
            }
            echo "<div id=\"title1\">
            <h5>".$row['title']."</h5>
            </div>";
            echo "
            <div id=\"description1\">
            <p>".$row['shortd']."</p>
            </div>
            <p><i class=\"fi-ticket locationicon\"></i><span class=\"ticket\"> Rs.".$row['ticket']." </span></p>
            <a href=\"seedetail.php?id=".$row['eventID']."\" class=\"button small expanded hollow\">See Details</a>
            </div>";
        }
    }else{// if no event exits
        echo "<p style=\"text-align: center;\"> No Events to display</p>";
    }
    echo"</div> </div>";
}
?>