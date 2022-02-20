<?php  include('partials/menu.php');   ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Manage Food</h1>

         <br><br>
         <?php 
           if(isset($_SESSION['insert-food'])){
              echo $_SESSION['insert-food'];
              unset($_SESSION['insert-food']);
           }
           if( isset($_SESSION['delete-food'])){
              echo  $_SESSION['delete-food'];
              unset( $_SESSION['delete-food']);
           }
           if(isset($_SESSION['update-food'])){
              echo $_SESSION['update-food'];
              unset($_SESSION['update-food']);
           }
           if(isset($_SESSION['upload'] )){
            echo $_SESSION['upload'] ;
            unset($_SESSION['upload'] );
         }

         ?>
         <br><br>
         <a href="add-food.php" class="btn-primary">Add Food</a> <br><br><br>
          
          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
             </tr>

             <?php
               
                $sql="SELECT *FROM tbl_food";
                $res=mysqli_query($conn,$sql);
                if($res==true){
                    $count=mysqli_num_rows($res);
                    if($count>0){ $a=1;
                      while( $row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                             <tr>
                                 <td><?php echo $a++; ?></td>
                                 <td><?php echo $title; ?></td>
                                 <td><?php echo "$".$price; ?></td>
                                 
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

                                 <td><?php echo $featured; ?></td>
                                 <td><?php echo $active; ?></td>
                                 <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;   ?>" class="btn-secondary" >Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;   ?>" class="btn-danger" >Delete Food</a>
                                 </td>
                              </tr>
                        <?php
                      }

                    }
                    else{
                       // not found
                    }
                }
                else {
                   //error
                }


            ?>

             

          </table>


     </div>
 </div>




<?php  include('partials/footer.php');   ?>