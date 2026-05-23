<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce Website</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- awesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css-->
    <link rel="stylesheet" href="style.css">

    <style>
        body{
        overflow-x: hidden;
    }
    </style>

</head>

<body>

    <!-- navbar-->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpeg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php Cart_items(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data" />
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!-- second child -->
        <nav class="navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav m-auto">
                 <?php
                if(!isset($_SESSION['username'])){
                    echo " <li class='nav-item'>
                    <a class='nav-link me-2' href='#'>Wellcome Guest</a>
                </li>";
                }else{
                    echo " <li class='nav-item'>
                    <a class='nav-link me-3' href='#'>Wellcome ".$_SESSION['username']."</a>
                </li>";
                }


                if(!isset($_SESSION['username'])){
                    echo " <li class='nav-item'>
                    <a class='nav-link me-3' href='./users_area/user_login.php'>Login</a>
                </li>";
                }else{
                    echo " <li class='nav-item'>
                    <a class='nav-link me-3' href='./users_area/logout.php'>Logout</a>
                </li>";
                }
               ?>
            </ul>

        </nav>
        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communications is the heart of e-commerce and community</p>
        </div>
        <!-- fourth child -->
        <div class="row px-1 ">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <!-- fatching products-->
                    <?php
                    //calling funtion
                    get_all_products();
                    get_unique_categories();
                    get_unique_brands();

                    ?>

                </div>
            </div>
            <div class="col-md-2 bg-secondary p-0">
                <!-- brands to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>

                    <?php
                    getbrands();

                    ?>


                </ul>
                <!-- categories to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    getcategories();
                    ?>

                </ul>

            </div>
        </div>




        <!-- last child-->
        <!-- include footer-->
         <?php
         include("./includes/footer.php")

         ?>
        


    </div>





    <!-- bootstrap js link -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>