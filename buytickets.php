<!--pop up module if the user buys ticket-->
<?php
include('eventfunctions.php'); //to purchase 
if (!isset($_SESSION['login_username'])){
    echo "<p style=\"text-align: center;\"> Please login inorder to book </p>"; //if session doesn't exist
}else {
	$amount=0; //initial amount
	if (isset($_SESSION['price'])){
		$amount=$_SESSION['price']; //gets the price from the session created in seedetail.php
	}
    if (isset($_GET['id'])){
        $eid=$_GET['id']; //gets the eventid from seedetail.php
	}
	if (isset($_POST['quantity'])){
		$quantity=$_POST['quantity']; //gets the quantity form
		$amount=number_format($amount*$quantity); //calculates the amount
		$result=bookTicket($uid,$eid,$amount); //gets uid from session of seedetail.php and books into purchase table
		echo $result;
	}
}
?>
<div class="grid-x">
	<div id="wrapper" class="modal">
		<div class="cell small-9 medium-8 large-6">
			<form class="modal-content animate" action="" name="login" method="POST" enctype="multipart/form-data">
				 <div class="imgcontainer">
			      <h3> Buy Tickets </h3>
			    </div>
			    <div class="container">
                    <input type="number" placeholder="Enter Quanity" name="quantity" min="1" max="5">      
			        <button><input type="submit" name="b_submit" value="Buy"></button>
			    </div>
			</form>
		</div>
	</div>
</div>
<!--JS script-->
<script>
var modal = document.getElementById('wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>