<?php
include('../includes/connect.php');

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status ='true';


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
        $product_title == '' or $product_description == '' or $product_keyword == '' or $product_category == '' or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == ''
    ) {
        echo "<script>alert('please fill all the available fields')</script>";
        exit();

    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //insert query
        $insert_products = "insert into `products` (product_title,product_description,product_keyword,category_id,
        brands_id,product_image1,product_image2,product_image3,product_price,date,status) values
        ('$product_title','$product_description','$product_keyword','$product_category','$product_brands',
        '$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";

        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('successfully inserted the products')</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products Adman Dashboard</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- awesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- product title -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Inter product title" autocomplete="off" required="required">
            </div>
            <!-- product description -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control"
                    placeholder="Inter product description" autocomplete="off" required="required">
            </div>
            <!-- product keyword -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keywords</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                    placeholder="Inter product keyword" autocomplete="off" required="required">
            </div>
            <!-- product category -->
            <div class="formoutline mb-4 w-50 m-auto">
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">select a category</option>
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
                    <option value="">select a brand</option>
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
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <!-- product image2 -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>
            <!-- product image3 -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>
            <!-- product price -->
            <div class="formoutline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Inter product price" autocomplete="off" required="required">
            </div>
            <div class="formoutline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="insert product">
            </div>


        </form>
    </div>
</body>

</html>