<?php  include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br> <br>

            <?php
               $id= $_GET['id'];
               $sql = "SELECT *FROM tbl_category where id = $id";
               $res = mysqli_query($conn,$sql);
               if($res==true){
                   $count = mysqli_num_rows($res);
                   if($count==1){
                       $rows = mysqli_fetch_assoc($res);
                       $title=$rows['title'];
                       $current_image=$rows['image_name'];
                       $image_name=$rows['image_name'];
                       $featured=$rows['featured'];
                       $active=$rows['active'];
                   }
               }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" id="" placeholder="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <!-- <img src="<?php echo $current_image; ?>" alt=""> -->
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" name="current_image">
                        </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
                        <td>
                            <input type="file" name="image" id="" placeholder="<?php echo $image_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" id="" value="Yes" check=""> Yes
                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" id="" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" id="" value="Yes"> Yes
                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" id="" value="No"> No
                        </td>
                    </tr>
                
                    
                </table>
            
            
              <!-- <table> -->
                   <tr>
                        <tr colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;   ?>">
                            <input type="hidden" name="id" value="<?php echo $id;  ?>">
                            <input type="submit" value="Update Category" name="submit"  class="btn-secondary">
                        </tr>
                    </tr>
              <!-- </table> -->
           </form>
        </div>
    </div>

    <?php
        if(isset($_POST['submit'])){
            $id=$_POST['id'];
            $current_image=$_POST['current_image'];
            $title=$_POST['title'];
            $image_name=$_POST['image_name'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];
             // upload image HAving something problem in channing it
             if(isset($_FILES['image']['name'])){
                 //image details

                 $image_name=$_FILES['image']['name'];
                 if($image_name!=""){
                     //Image availale
                    //  $image_name = $_FILES['image']['name'];
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                    $upload=move_uploaded_file($source_path,$destination_path);
                    if($upload==false){
                        $_SESSION['upload'] ="<div class='error'>Failed To upload Image.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();
                    }

                    // Remove the current image if availabl
                    // if($current_image!=""){
                    //     $remove_path="../images/category".$current_image;
                    //     $remove_image=unlink($remove_path);
                    //     //check whether the image is removed or not
                    //     if($remove_image==false){
                    //         $_SESSION['failed-remove']="<div class='error'>Failed To Remove Current Image</div>";
                    //         header('location:'.SITEURL.'admin/manage-category.php');
                    //         die();
                    //     }
                    // }
                    
                    
                 }
                 else {
                    $image_name=$current_image;
                }
             }
             else {
                 $image_name=$current_image;
             }



            $sql =" UPDATE tbl_category Set
              title = '$title',
              featured = '$featured',
              active = '$active',
              image_name='$image_name'
            where id=$id
            ";

            $res=mysqli_query($conn,$sql);
            if($res==true){
              $_SESSION['update-category'] ="<div class='success'>Category Updated Successfully</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
            }
            else {
                $_SESSION['update-category'] ="<div class='error'>Failed To Update Category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
    ?>
</body>
</html>

<?php  include('partials/footer.php'); ?>