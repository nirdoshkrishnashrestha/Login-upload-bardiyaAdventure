<?php 

if(!isset($_SESSION['user']))
{
	header("Location:index.php");
}

include("db.php");

$id = $_GET['id'];

$sql = "DELETE FROM `gallery` WHERE `id` = $id";
$img_path = "uploads/".$_GET['img'];
mysqli_query($con,$sql);
//$_SESSION['filess'];
unlink($img_path);
header("Location:gallery.php");
exit();

 ?>