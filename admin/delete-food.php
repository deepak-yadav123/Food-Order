<?php
include('../config/config.php');
  $id=$_GET['id'];
  $sql = "DELETE FROM tbl_food where id=$id";
  $res=mysqli_query($conn,$sql);
  if($res==true){
      // deleted
      $_SESSION['delete-food'] = "<div class='success'>Successfully Food Deleted</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
  }
  else{
      $_SESSION['delete-food'] = "<div class='error'>Failed To Delete Food</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
  }


?>