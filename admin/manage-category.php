<?php  include('partials/menu.php');   ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Manage Category</h1>

         <br><br> 
         <?php
            if(isset($_SESSION['add-category'])){
               echo $_SESSION['add-category'];
               unset($_SESSION['add-category']);
            }

            if(isset( $_SESSION['delete'])){
               echo  $_SESSION['delete'];
               unset( $_SESSION['delete']);
            }
            if(isset( $_SESSION['update-category'] )){
               echo  $_SESSION['update-category'] ;
               unset( $_SESSION['update-category'] );
            }
            if(isset($_SESSION['upload'])){
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
            }
            if(isset( $_SESSION['failed-remove'])){
               echo  $_SESSION['failed-remove'];
               unset( $_SESSION['failed-remove']);
            }
         ?>
         <br><br>

         <a href="add-category.php" class="btn-primary">Add Category</a> <br><br><br>
          
          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image </th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
             </tr>
              <?php
                 $sql ="SELECT *FROM tbl_category ";
                 $res = mysqli_query($conn,$sql);
                 if($res==true){
                    $count= mysqli_num_rows($res);
                    if($count>0){
                            $a=1;
                        while( $rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            $destination_path = "../images/category/".$image_name;
                            ?>
                                <tr>   
                                    <td><?php  echo $a++;  ?></td>
                                    <td><?php echo $title;   ?></td>
                                    <!-- 1st methode to show image  -->
                                    <td>
                                       <?php
                                          if($image_name!=""){
                                             // display image
                                             ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px">
                                             <?php
                                          }
                                          else{
                                             echo "<div class='error'>Image Not Added</div>";
                                          }
                                       ?>
                                    </td>
                                    <!-- 2 My methode to show image -->
                                    <!-- <td><?php// echo  "<img src='$destination_path' width='100px'>";  ?></td> -->
                                    <td><?php echo $featured;  ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                       <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Category</a>
                                       <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                 </tr>



                          <?php
                        }
                    }
                 }


             ?>
             

             

             


          </table>
     </div>
 </div>




<?php  include('partials/footer.php');   ?>