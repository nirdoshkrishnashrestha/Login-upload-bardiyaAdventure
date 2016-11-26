<?php
require("header.php");
session_start();
if(isset($_SESSION['user']))
{
  header("Location:admin_panel.php");
} 
 ?>

  <div class="login-page">
  <div class="form">    
    <form class="login-form" action="process.php" method="post">
      <input type="text" name="user" placeholder="username"/>
      <input type="password" name="pass" placeholder="password"/>
      <button>login</button><br>
      <?php
      if(isset($_GET['empty_val']))
      {
        echo "<p style='color:red;'><br>Username or Password can't be empty</p>";
      }
       if(isset($_GET['wrong']))
      {
        echo "<p style='color:red;'><br>Wrong Username or Password</p>";
      }

      ?>
     
    </form>
  </div>
</div>
  <?php
require("footer.php");  //// contain html footer and include js
?>
