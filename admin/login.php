<?php  include('../config/config.php');    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/mycss.css">
   
    
</head>
<body>
    <div class="login">
        <h1 class="text-center" >Login</h1> <br>
    
        <?php
             if(isset($_SESSION['login'])){
               echo $_SESSION['login'];
               unset($_SESSION['login']);
             }
             if(isset($_SESSION['no-login-msg'])){
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
              }

          ?>
          <br>
        <form action="" method="post" class="text-center">
           Username : <br>
        <input type="text" name="username" placeholder="Enter Username"> <br><br>
        
        Password : <br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        <input type="submit" value="Login" name="submit" class="btn-primary">
        <br><br>
           
        </form>
        <p class="text-center">Created By- Deepak Yadav</p>
    </div>
</body>
</html>

<?php
  
  if(isset($_POST['submit'])){
      // Took Username and password from a form
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      
      // Sql query to 
      $sql = "SELECT *FROM tbl_admin Where username = '$username' and  password='$password'";

      $res= mysqli_query($conn,$sql);
      $count = mysqli_num_rows($res);
      if($count==1){
         $_SESSION['login'] ="<div class='success'>Login Successfully</div>";
         $_SESSION['user'] = $username;
        header('location:'.SITEURL.'admin/');
      }
      else {
        $_SESSION['login'] ="<div class='error'>Username and password does not match</div>";
        header('location:'.SITEURL.'admin/login.php');
      }

  }



?>