<!--grabs the keyword from cookie and search in the database for all criterias. sort by is chosen and then result is displayed organized by user's option--> 
<?php
session_start();
include ('sessions_user.php'); //sessions required for admin with role1
$option=0; //by default the option is 0
?>
<!doctype html>
<html lang="en">
	<head>
		<title>ChooseYourEvents</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?> <!--navigation -->
	<?php include ('loginform.php');?> <!--login form -->
    <br/>
    <div class="grid-container" id="viewalleventgrid">
        <form method="POST">
            Sort By:
            <select name="sort"> <!--value of option is based on sort -->
                <optgroup  label="sort">
                    <option value="0" <?php if($option=='0')echo 'selected'?>>---</option>
                    <option value="1" <?php if($option=='1')echo 'selected'?>>Date (New to Old)</option>
                    <option value="2" <?php if($option=='2')echo 'selected'?>>Date (Old to New)</option>
                    <option value="3" <?php if($option=='3')echo 'selected'?>>Price (Highest to lowest)</option>
                    <option value="4" <?php if($option=='4')echo 'selected'?>>Price (Lowest to Highest)</option>
                    <option value="5" <?php if($option=='5')echo 'selected'?>>Title (Alphabetical)</option>
                    <option value="6" <?php if($option=='6')echo 'selected'?>>Category (Alphabetical)</option>
                </optgroup>
            </select>
            <input type="submit" name="sortsubmit" value="Sort">
        </form>
        <div class="grid-x grid-margin-x"> <!--Display the results in grid format with relevant information -->
<?php
    if (isset($_COOKIE['keyword'])){
        $keyword=$_COOKIE['keyword'];//gets keyword by cookie

    //echo $keyword;
    include('connection.php'); //database connectionS
    if(isset($_POST['sortsubmit'])){  
        $option=$_POST['sort'];//changes the value of option according to user's choice
    }
    if ($option==0){ //by default sorting isn't done
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%'";
    }else if($option==1){//sort by date descending
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%' order by date desc";
    }else if($option==2){//sort by date ascending
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%' order by date asc";
    }else if($option==3){//sort by price descending
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%' order by ticket desc";
    }else if($option==4){//sort by price ascending
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%'order by ticket asc";
    }else if($option==5){//sort by alphabetical order of title
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%' order by title asc";
    }else if($option==6){//sort by alphabetical order of category
        $query="select * from item 
        where title like '%$keyword%' OR category like '%$keyword%' OR date like '%$keyword%' OR 
        shortd like '%$keyword%' OR duration like '%$keyword%' OR  location like '%$keyword%' OR  
        detail like '%$keyword%' OR  host like '%$keyword%' OR  contact like '%$keyword%' order by category asc";
    }
    $result=mysqli_query($connection,$query);//runs query
    $count=mysqli_num_rows($result);//finds the number of result
//     header("Location: {$_SERVER['HTTP_REFERER']}");
    if ($count>=1){
        while ($row=mysqli_fetch_assoc($result)){
            $image=$row['thumbnail'];  
            echo"
            <div class=\"cell small-6 medium-4 large-4\" >
                <div class=\"media-object\">
                    <div class=\"media-object-section\">
                        <img class=\"thumbnail hundred\" src=\"$image\">
                    </div>
                        <div class=\"media-object-section\">
                        <button type=\"submit\" style=\" float:right;\"><i class=\"fi-star fav\"></i></button>
                        <div id=\"title\">
                        <h5>".$row['title']."</h5>
                        </div>
                        <div id=\"description1\">
                        <p>".$row['shortd']."</p>
                        </div>
                        <p> <span class=\"ticket\"> <i class=\"fi-ticket locationicon\"></i> &nbsp;Rs.".$row['ticket']."</span> <br/><i class=\"fi-calendar locationicon\"></i>
                        &nbsp;".$row['date']."</p>
                        <a href=\"seedetail.php?id=".$row['eventID']."\">See Detail</a>
                    </div>
                </div>
            </div>";
        }
    }else{
        echo "<p style=\"text-align: center;\"> No match found</p>";
        //echo $query;
    }
}else{
    echo'Type something';
}
?>
        </div>
    </div>
    <br/>
	<footer>
		<?php include ('footer.php');?> <!--footer -->
	</footer>
    </body>
    <!--JS -->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>