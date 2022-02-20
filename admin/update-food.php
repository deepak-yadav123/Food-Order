<?php  include('partials/menu.php')  ;     ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        
        <?php
           if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql2="SELECT * FROM tbl_food where id=$id ";
                $res2 = mysqli_query($conn,$sql2);
                $row=mysqli_fetch_assoc($res2);
                 
                $title=$row['title'];
                $descrition=$row['description'];
                $price=$row['price'];
                $featured = $row['featured'];
                $active=$row['active'];
                $current_image=$row['image_name'];
                $category_name=$row['category_id'];
                

           }
           else{
               header('location:'.SITEURL.'admin/manage-food.php');
           }
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" id="" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Discription:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder=""><?php echo $descrition; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" id="" value="<?php echo $price; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" name="current_image">
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                       <input type="file" name="image" id="" value="<?php  ?>">

                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">

                        <?php
                           
                           $sql="SELECT *FROM tbl_category where active='Yes'";
                           $res=mysqli_query($conn,$sql);
                           $count=mysqli_num_rows($res);
                           if($count>0){
                            //available
                            while($row=mysqli_fetch_assoc($res)){
                                $category_title=$row['title'];
                                $category_id=$row['id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }

                           }
                           else{
                               // not Available
                               echo "<option value='0'> Category Not available </option>";
                           }

                        ?>
     



                            <option value="1">Test Category</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" id="" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" id="" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        
        <?php
        if(isset($_POST['submit'])){
            $id=$_POST['id'];
            $current_image=$_POST['current_image'];
            $title=$_POST['title'];
            $image_name=$_POST['image_name'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];
            $price=$_POST['price'];
            $descrition=$_POST['description'];
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
                        header('location:'.SITEURL.'admin/manage-food.php');
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



            $sql =" UPDATE tbl_food Set
              title = '$title',
              featured = '$featured',
              active = '$active',
              image_name='$image_name',
              description='$descrition',
              price='$price'
              where id=$id
            ";

            $res=mysqli_query($conn,$sql);
            if($res==true){
              $_SESSION['update-food'] ="<div class='success'>Food Updated Successfully</div>";
              header('location:'.SITEURL.'admin/manage-food.php');
            }
            else {
                $_SESSION['update-food'] ="<div class='error'>Failed To Update Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        }
    ?>
    </div>
</div>

<?php  include('partials/footer.php')   ;    ?>