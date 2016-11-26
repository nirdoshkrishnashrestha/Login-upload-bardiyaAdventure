<?php
session_start();
if(isset($_SESSION['user']))
{
require("header.php");
 ?>

 Activities

<?php
require("footer.php");  //// contain html footer and include js
?>

<?php 
	}
	else
{
	header("Location:index.php");
	exit();
}

?>