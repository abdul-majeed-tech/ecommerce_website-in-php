<?php

if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    //echo $edit_id;
    $get_data = "select * from `products` where product_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    // echo $product_title;
    $product_description = $row['product_description'];
    $product_keyword = $row['product_keyword'];
    $category_id = $row['category_id'];
    $brands_id = $row['brands_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];


    $select_category = "select * from `categories` where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row = mysqli_fetch_assoc($result_category);
    $category_title = $row['category_title'];
    //echo $category_title;
echo $product_title;


    // get barnds query
    $select_brands = "select * from `brands` where brands_id=$brands_id";
    $result_brands = mysqli_query($con, $select_brands);
    $row = mysqli_fetch_assoc($result_brands);
    $brands_title = $row['brands_title'];
    // echo $brands_title;

}

?>

<div class="container mt-3">
    <h1 class="text-center">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- product title -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>
            <input type="text" name="product_title" value="<?php echo $product_title ?>" id="product_title"
                class="form-control" placeholder="Inter product title" autocomplete="off" required="required">
        </div>
        <!-- product description -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" value="<?php echo $product_description ?>"
                id="product_description" class="form-control" placeholder="Inter product description" autocomplete="off"
                required="required">
        </div>
        <!-- product keyword -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_keyword" class="form-label">Product Keywords</label>
            <input type="text" name="product_keyword" value="<?php echo $product_keyword ?>" id="product_keyword"
                class="form-control" placeholder="Inter product keyword" autocomplete="off" required="required">
        </div>
        <!-- product category -->
        <div class="formoutline mb-4 w-50 m-auto">
            <select name="product_category" id="product_category" class="form-select">
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                <?php
                $select_query = "select * from `categories`";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<option value='$category_id'> $category_title</option>";
                }

                ?>

            </select>
        </div>
        <!-- product category -->
        <div class="formoutline mb-4 w-50 m-auto">
            <select name="product_brands" id="product_brands" class="form-select">
                <option value="<?php echo $brands_title ?>"><?php echo $brands_title ?></option>
                <?php
                $select_query = "select * from `brands`";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $brands_title = $row['brands_title'];
                    $brands_id = $row['brands_id'];
                    echo "<option value='$brands_id'> $brands_title</option>";
                }

                ?>

            </select>
        </div>
        <!-- product image1 -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" name="product_image1" id="product_image1" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product image2 -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" name="product_image2" id="product_image2" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product image3 -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" name="product_image3" id="product_image3" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product price -->
        <div class="formoutline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" value="<?php echo $product_price ?>" id="product_price"
                class="form-control" placeholder="Inter product price" autocomplete="off" required="required">
        </div>
        <div class="formoutline mb-4 w-50 m-auto">
            <input type="submit" name="edit_product" class="btn btn-info mb-3 px-3" value="Update product">
        </div>


    </form>
</div>


<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];


    // accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];


    // accessing images temp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];



    // checking empty condition
    if (
        $product_title == '' or $product_description == '' or $product_keyword == '' or $product_category == ''
        or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == ''
        or $product_image3 == ''
    ) {
        echo "<script>alert('please fill all the available fields and continue to the process')</script>";
        exit();

    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //insert query
        $update_products = "update `products` set product_title='$product_title',product_description='$product_description',
        product_keyword='$product_keyword',category_id='$product_category',
        brands_id='$product_brands',product_image1='$product_image1',product_image2='$product_image2',
        product_image3='$product_image3',product_price='$product_price',date=NOW() where product_id=$edit_id";

        $result_query = mysqli_query($con, $update_products);
        if ($result_query) {
            echo "<script>alert('successfully updated the products')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }

}

?>