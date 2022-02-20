<?php
   include('../config/config.php');
  // Take Id from database 
   $id = $_GET['id'];
   // Sql Query for deleteing data from database tbl_admin;
   $sql = "DELETE FROM tbl_admin WHERE id=$id";
   // Executing query 
   $res = mysqli_query($conn,$sql);

   if($res==true){
       $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfull</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else {
    $_SESSION['delete'] = "<div class = 'error'>Error in deleting Admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
   }


?>