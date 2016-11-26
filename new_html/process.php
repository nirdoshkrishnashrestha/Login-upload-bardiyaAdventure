<?php
session_start();
include_once("db.php");
if(isset($_POST))
{
	$user = $_POST['user'];	
	$pass = $_POST['pass'];
		if($user == "" or $pass == "")
		{		  	
			header("Location:index.php?empty_val=1");	
			exit;		
		}
		else{
	$sql = "select * from admin where user = '$user' and pass = '$pass'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		header("Location:admin_panel.php");	
		exit;	
	}
	else
	{
		header("Location:index.php?wrong=1");	
		exit;	
	}
		}
}

else
{
	header("Location:index.php");	
	exit;
}

 ?>