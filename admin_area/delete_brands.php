<?php
if(isset($_GET['delete_brands'])){
    $delete_brands=$_GET['delete_brands'];
    //echo $delete_brands;

    $delete_query="delete from `brands` where brands_id=$delete_brands";
    $result_query=mysqli_query($con,$delete_query);
    if($result_query){
         echo "<script>alert('successfully has been deleted the brands')</script>";
            echo "<script>window.open('index.php?view_sbrands','_self')</script>";
    }
}


?>