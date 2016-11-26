<?php
session_start();
include("db.php");
if(isset($_SESSION['user']))
{
  require("header.php");

 //Only for insert values for testing purpose

/*for($i=5;$i<=58;$i++){
$sqle = "insert into gallery(image_title) values('ok$i') ";
mysqli_query($con,$sqle);}*/

?>

 <div id="admin-wrapper">
 <form action="input_gallery.php" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="18%" bgcolor="#FFFFFF">Image Title:</td>
    <td width="82%" bgcolor="#FFFFFF"><input type="text" name="img_title" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Upload Image:</td>
    <td bgcolor="#FFFFFF"><input type="file" name="fileToUpload"></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><input type="submit" name="submit" value="Submit"></td>
    </tr>
</table>
 </form>
 
 <?php

////// Here Msg displayed for fail only


  if(isset($_GET['fail'])){ 
       unset($_SESSION['sucess']);
  ?>
 <br />
<br />
 <script>
$(document).ready(function(){   
        $(".sorry").fadeOut(4000);       
});
</script>
<div style="color:#C00; padding:10px; background:#FF6; border:1px dashed #C00;" class="sorry"><?php
echo $_SESSION['sorry'];
?></div>
<?php }

////// Here Msg displayed for success only

if(isset($_GET['sucess'])){ 
    unset($_SESSION['sorry']);
  ?>
 <br />
<br />
 <script>
$(document).ready(function(){   
        $(".sucess").fadeOut(4000);       
});
</script>
<div style="color:#FFF; padding:10px; background:#7AB957; border:1px dashed #000; font-weight:bold;" class="sucess">Successfully Uploaded!</div>
<?php } ?>

   <?php
 		////////// Pagination Code Starts Here
      $sql_page = "select count(*) from gallery";
  
   $results_page = mysqli_query($con,$sql_page);

   $r = mysqli_fetch_row($results_page);

   $numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$sql_page02 = "SELECT * FROM gallery LIMIT $offset, $rowsperpage";
$results_page02 = mysqli_query($con,$sql_page02);

 	?>
    
    <br />
<br />


<table width="100%" cellpadding="10" cellspacing="1" bgcolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#009999" style="color:#FFF;"><strong>S.N.</strong></td>
    <td width="62%" align="left" bgcolor="#009999" style="color:#FFF;"><strong>Image Title</strong></td>
    <td width="25%" align="center" bgcolor="#009999" style="color:#FFF;"><strong>Image</strong></td>
    <td width="8%" align="center" bgcolor="#009999" style="color:#FFF;"><strong>Delete</strong></td>
  </tr>
  <?php

   $value = ($currentpage-1)*10;
   while ($row = mysqli_fetch_array($results_page02)) 
   { 
     ?>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><?php echo ++$value; ?></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $row[1]; ?></td>
    <td align="center" bgcolor="#FFFFFF"><img src="uploads/<?php echo $row[2]; ?>" height="70" /></td>
    <td align="center" bgcolor="#FFFFFF"><a href="delete_gallery.php?id=<?php echo $row['0']; ?>&img=<?php echo $row[2]; ?>"><img src="images/delete.png" height="20" width="20"></a></td>

   <?php //$value++;
    } ?> 
  </tr>
</table>
<br><br>
<?php


/******  build the pagination links ******/
// range of num links to show
$range = 3;
echo "<div class='center'><ul class='pagination'>";
// if not on page 1, don't show back links

   echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> </li>";
   // get previous page num
   $prevpage = $currentpage - 1;

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " <li><a href='#' class='active' ><b>$x</b></a></li> ";
      // if not current page...
      } else {
         // make it a link
         echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
  // echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a></li>";
} // end if
/****** end build pagination links ******/
?>
</ul>
</div>
<br />
<br />

<?php 
  mysqli_close($con);
?>
 
<div class="clear"></div>
</div>
 
 
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
