<?php
if(isset($_GET['delete_product'])){
    $delete_id=$_GET['delete_product'];
    //echo $delete_id;

    $delete_query="delete from products where product_id=$delete_id";
    $result_query=mysqli_query($con,$delete_query);
    if($result_query){
         echo "<script>alert('successfully deleted the products')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
    }
}


?>