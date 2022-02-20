<?php  include('partials/menu.php');   ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset( $_SESSION['upload'] )){
               echo  $_SESSION['upload'] ;
               unset( $_SESSION['upload'] );
            }
         ?> <br> <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Discription:</td>
                    <td>
                       <textarea name="description" id="" cols="30" rows="5" placeholder="Enter Description of Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                       <input type="number" name="price" id="">
                    </td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td>
                       <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                       <select name="category_id" id="">
                            <?php
                              $sql="SELECT *FROM tbl_category where active='Yes'";
                              $res= mysqli_query($conn,$sql);
                              $count= mysqli_num_rows($res);
                              if($count>0){
                                  //Isme hai
                                  while($row=mysqli_fetch_assoc($res)){
                                      $id=$row['id'];
                                      $title=$row['title'];
                                      ?>
                                           <option value="<?php echo $id ; ?>"><?php  echo $title; ?></option>
                                      <?php
                                  }
                              }
                              else{
                                  ?>
                                <option value="0">Food  Not Found</option>
                                <?php
                              }
                            ?>
                       </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" id="" value="Yes">Yes
                        <input type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" id="" value="Yes">Yes
                        <input type="radio" name="active" id="" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                       <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <?php
              // Inserting Foods Into database
               //1. Take data from form 
               if(isset($_POST['submit'])){
                   echo "clicked";
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category_id=$_POST['category_id'];
                    // $featured=$_POST['featured'];
                    // $active=$_POST['active'];
                    if(isset($_POST['featured'])){
                        $featured=$_POST['featured'];
                    }
                    else{
                        $featured="No";
                    }
                    if(isset($_POST['active'])){
                        $active=$_POST['active'];
                    }
                    else{
                        $active="No";
                    }
                    if(isset($_FILES['image']['name'])){
                       $image_name=$_FILES['image']['name'];
                       if($image_name!=""){
                         // manjhe image ahe
                         $ext = end(explode('.',$image_name));
                         $image_name = "Food_Category_".rand(000,999).'.'.$ext;
     
                         $source_path = $_FILES['image']['tmp_name'];
                         $destination_path = "../images/category/".$image_name;
                         $upload=move_uploaded_file($source_path,$destination_path);
                         if($upload==false){
                             $_SESSION['upload'] ="<div class='error'>Failed To upload Image.</div>";
                             header('location:'.SITEURL.'admin/add-food.php');
                             die();
                         }
                       }
                       else{
                        $image_name="";
                       }
                    }
                    else{
                       $image_name="";
                    }

               // 2. Write sql to insert data in databse
                  $sql2="INSERT INTO tbl_food SET
                         title = '$title',
                         description='$description',
                         price='$price',
                         category_id=$category_id,
                         image_name='$image_name',
                         featured='$featured',
                         active='$active'
                  ";
                  $res2=mysqli_query($conn,$sql2);
               // 3. give msg of inserted on manage-food.php file
               if($res2==true){
                   $_SESSION['insert-food']="<div class='success'>Food Inserted Successfully</div>";
                   header('location:'.SITEURL.'admin/manage-food.php');
               }
               else{
                $_SESSION['insert-food']="<div class='error'>Failed To Add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
               }
            }

        ?>

       
    </div>
</div>

<?php  include('partials/footer.php');   ?>