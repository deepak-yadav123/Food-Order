<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php $id = $_GET['id'];  ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password </td>
                    <td>
                        <input type="password" name="current_pwd" id="" placeholder="">
                    </td>
                </tr>
                <tr>
                   <td>New Password :</td>
                    <td>
                        <input type="password" name="new_pwd" id="" placeholder="">
                    </td>
                </tr>
                <tr>
                   <td>Confirm Password :</td>
                    <td>
                        <input type="password" name="confirm_pwd" id="" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td> 
                </tr>
            </table>
        </form>
    </div>

</div>

<?php
if(isset($_POST['submit'])){
    // $id = $_POST['id'];
    $current_pwd = md5($_POST['current_pwd']);
    $new_pwd = md5($_POST['new_pwd']);
    $confirm_pwd = md5($_POST['confirm_pwd']);
    
    $sql = "SELECT * FROM tbl_admin WHERE id='$id' and password='$current_pwd'";
    $res = mysqli_query($conn,$sql);
    if($res == true){
        $count=mysqli_num_rows($res);
        if($count==1){
            if($new_pwd==$confirm_pwd){
                // echo "Updated";
                $sql2 = "UPDATE tbl_admin SET
                         password = '$new_pwd'
                         where id= $id
                ";
                $res2 = mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else {
                    $_SESSION['change-pwd']="<div class='error'>Error in changing password</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else {
                $_SESSION['pwd-not-match']="<div class='error'>Password not match</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

            
        }
    }
    else {
        $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>

<?php include('partials/footer.php');?>