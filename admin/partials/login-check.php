<?php
   if(!isset($_SESSION['user'])){
      $_SESSION['no-login-msg'] = "<div class='error'>Please Login To access Admin pannel</div>"; 
      header('location:'.SITEURL.'admin/login.php');
   }

?>