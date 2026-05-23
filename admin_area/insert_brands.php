<?php
include('../includes/connect.php');

if(isset($_POST['insert_brand'])){
    $brands_title=$_POST['brands_title'];

    $select_queury= "select * from `brands` where brands_title='$brands_title'";
    $result_select = mysqli_query($con,$select_queury);
    $number = mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('This brand already exists in the database')</script>";
    }else{

    
    $insert_queuries= "insert into `brands` (brands_title) values('$brands_title')";
    $result = mysqli_query($con,$insert_queuries);
    if($result){
        echo "<script>alert('Brand has been inserted successfully')</script>";
    }

}}

?>

<h2 class="text-center">Insert Brands</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brands_title" placeholder="insert brands" aria-label="Brands"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3 border-0" name="insert_brand" value="Insert Brands">
    </div>
</form>