<?php
session_start();
if(isset($_SESSION['user']))
{
require("header.php");

 ?>

<div id="admin-wrapper">

<a href="gallery.php"><div class="admin-col fl">Photo Gallery</div></a>

<a href="activities.php"><div class="admin-col fr">Activities</div></a>

<div class="clear"></div>

</div>

<div class="clear"></div>
<br>
<br>

<center>
<a href="logout.php" class="logout-btn">Log Out</a>
</center>

<?php
require("footer.php");  //// contain html footer and include js
?>

<?php 

}
else
{
	header("Location:index.php");
}

?>