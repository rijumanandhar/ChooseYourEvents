<!--connection to database-->
<?php 
//Set up the database access credentials
$hostname = 'localhost'; 
$username = 'root'; 
$password1 = ''; 
$databaseName = 'rijumana_c7189982'; 
//Open the database connection - exit with error message otherwise 
$connection = mysqli_connect($hostname, $username, $password1, $databaseName) or exit("Unable to connect to database!");
?>