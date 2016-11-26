
<?php
session_start();
include("db.php");
//mysqli_select_db($con,"gallery");
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$_SESSION['filess'] = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$img_name = $_FILES["fileToUpload"]["name"];
$img_title = $_POST['img_title'];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image 
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $_SESSION['sucess'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $_SESSION['sorry'] = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION['sorry'] = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $_SESSION['sorry'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "JPEG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  if($imageFileType == NULL) $_SESSION['sorry'] = "Please Select Photo";
  else $_SESSION['sorry'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $_SESSION['sorry2'] = "Sorry, your file was not uploaded.";
     header("Location:gallery.php?fail=2");exit();
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql1 = "insert into gallery(image_title,image_name) values('{$img_title}','{$img_name}')";
        mysqli_query($con,$sql1);
        $_SESSION['sucess'] .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
         header("Location:gallery.php?sucess=1");exit();
    } else {
        $_SESSION['sorry2'] = "Sorry, there was an error uploading your file.";
        header("Location:gallery.php?fail=1");exit();
    }
}
?>
