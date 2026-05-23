<?php
include('../includes/connect.php');

if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    $select_queury= "select * from `categories` where category_title='$category_title'";
    $result_select = mysqli_query($con,$select_queury);
    $number = mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert(' this Category is present inside the database')</script>";
    }else{

    
    $insert_queuries= "insert into `categories` (category_title) values('$category_title')";
    $result = mysqli_query($con,$insert_queuries);
    if($result){
        echo "<script>alert('Category has been inserted successfully')</script>";
    }

}}
?>
<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="insert categories" aria-label="Username"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3 border-0" name="insert_cat" value="Insert Categories">
    </div>
</form>