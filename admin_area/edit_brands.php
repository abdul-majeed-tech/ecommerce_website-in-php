<?php
if (isset($_GET['edit_brands'])) {
    $edit_brands = $_GET['edit_brands'];
    //echo $edit_category;
    $get_brands = "select * from `brands` where brands_id=$edit_brands";
    $result = mysqli_query($con, $get_brands);
    $row = mysqli_fetch_assoc($result);
    $brands_title = $row['brands_title'];
   // echo $category_title;

   if(isset($_POST['edit_brands'])){
    $brands_title=$_POST['brands_title'];

    $update_query="update `brands` set brands_title='$brands_title' where brands_id=$edit_brands";
    $result_brands = mysqli_query($con, $update_query);
    if($result_brands){
         echo "<script>alert('successfully updated the brands')</script>";
            echo "<script>window.open('./index.php?view_brands.php','_self')</script>";
    }

   }




}
?>
<div class="container mt-4">
    <h1 class="text-center">Edit Brands</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brands_title" class="formlabel">Brands Title</label>
            <input type="text" name="brands_title" id="brands_title" class="form-control" required="required"
                value="<?php echo $brands_title; ?> ">

        </div>
        <input type="submit" value="Update brands" class="btn btn-info px3 py3" name="edit_brands">
    </form>
</div>