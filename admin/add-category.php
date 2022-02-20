<?php  include('partials/menu.php');  ?>
 
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <form action="" method="post" class="text-center" enctype="multipart/form-data"> 
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="Enter Title">
                    </td>
                </tr>

                <tr>
                    <td>Upload Image:</td>
                    <td>
                        <input type="file" name="image" id="" >
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
                         <input type="submit" value="Add Category" name="submit" class="btn-secondary">
                     </td>
                 </tr>
            </table>
        </form>

        <?php
           // check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                // take values from form 
                $title = $_POST['title'];

                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else 
                {
                    $feature="No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else 
                {
                    $active="No";
                }

                // print_r($_FILES['image']);

                // die();
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                    $upload=move_uploaded_file($source_path,$destination_path);
                    if($upload==false){
                        $_SESSION['upload'] ="<div class='error'>Failed To upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                    }
                }
                else{
                    $image_name="";
                }

                // vaues took from form
                // now write sql to insert  values into database
                $sql="INSERT INTO tbl_category SET
                      title='$title',
                      image_name ='$image_name',
                      featured='$featured',
                      active='$active'   
                ";
                $res=mysqli_query($conn,$sql);
                if($res==true){
                    $_SESSION['add-category']="<div class='success'>Category Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }


       ?>
    </div>
</div>

<?php  include('partials/footer.php');  ?>