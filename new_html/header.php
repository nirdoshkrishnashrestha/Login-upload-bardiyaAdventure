<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/admin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div id="admin-header">

<center>
<img src="images/logo.png" width="100">
</center>

<h1>Bardia Adventure Resort<br>
<span>Admin Panel</span></h1>

<div class="clear"></div>


<?php
 $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 $uri_segments = explode('/', $uri_path);
 	if ($uri_segments[2] != "index.php") { 	
  ?>
<div class="fl icons"><a href="admin_panel.php"><img src="images/home.png" height="20"><br>Home</a></div>

<div class="fr icons"><a href="logout.php"><img src="images/lock.png" height="20"><br>Logout</a></div>
<?php } ?>
<br>
<br>

<div class="clear"></div>
</div>