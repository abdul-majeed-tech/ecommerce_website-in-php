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
    <title>Ecommerce Website cart details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img { width: 50px; height: 50px; object-fit: contain; }
        body { overflow-x: hidden; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpeg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa-solid fa-cart-shopping"></i><sup><?php Cart_items(); ?></sup>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php Cart(); ?>

        <nav class="navbar-expand-lg navbar-dark bg-secondary p-2">
            <ul class="navbar-nav m-auto">
                <?php
                if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'><a class='nav-link text-white me-2' href='#'>Welcome Guest</a></li>";
                    echo "<li class='nav-item'><a class='nav-link text-white me-3' href='./users_area/user_login.php'>Login</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link text-white me-3' href='#'>Welcome ".$_SESSION['username']."</a></li>";
                    echo "<li class='nav-item'><a class='nav-link text-white me-3' href='./users_area/logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </nav>

        <div class="bg-light p-3">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communications is the heart of e-commerce and community</p>
        </div>

        <div class="container mt-5">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <?php
                        global $con;
                        $total_price = 0;
                        $user_ip = get_client_ip();
                        $cart_query = "Select * from `cart_details` where ip_address='$user_ip'";
                        $result_query = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        
                        if ($result_count > 0) {
                            echo "<thead>
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Remove</th>
                                        <th colspan='2'>Operations</th>
                                    </tr>
                                  </thead>
                                  <tbody>";

                            while ($row = mysqli_fetch_array($result_query)) {
                                $product_id = $row['product_id'];
                                $db_quantity = $row['quantity']; // Database se purani quantity nikalna
                                
                                $select_products = "Select * from `products` where product_id=$product_id";
                                $result_products = mysqli_query($con, $select_products);
                                
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    
                                    // Total calculation based on quantity
                                    $total_price += ($price_table * $db_quantity);
                                    ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" class="cart_img"></td>
                                        
                                        <td><input type="number" name="qty[<?php echo $product_id; ?>]" value="<?php echo $db_quantity; ?>" class="form-control w-50 m-auto"></td>
                                        
                                        <td><?php echo $price_table ?>/-</td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td>
                                            <input type="submit" name="update_cart" value="Update Cart" class="btn btn-info text-white">
                                            <input type="submit" name="remove_cart" value="Remove Cart" class="btn btn-danger text-white">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    if (isset($_POST['update_cart'])) {
                        foreach ($_POST['qty'] as $id => $quantity) {
                            // XSS aur SQL injection se bachne ke liye integer filter
                            $quantity = (int)$quantity;
                            if($quantity > 0) {
                                $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$user_ip' AND product_id=$id";
                                mysqli_query($con, $update_cart);
                            }
                        }
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                    ?>

                    <div class="d-flex mb-5">
                        <?php
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong class='text-info'>$total_price/-</strong></h4>
                                  <input type='submit' name='continue_shopping' value='Continue Shopping' class='btn btn-info text-white'>
                                  <a href='./users_area/checkout.php' class='btn btn-secondary mx-3 text-white'>Checkout</a>";
                        } else {
                            echo "<input type='submit' name='continue_shopping' value='Continue Shopping' class='btn btn-info text-white'>";
                        }

                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <?php
        function remove_cart_item() {
            global $con;
            if (isset($_POST['remove_cart'])) {
                if(isset($_POST['removeitem'])) {
                    foreach ($_POST['removeitem'] as $remove_id) {
                        $delete_query = "Delete from `cart_details` where product_id=$remove_id";
                        $run_delete = mysqli_query($con, $delete_query);
                        if ($run_delete) {
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }
                }
            }
        }
        remove_cart_item();
        ?>

        <?php include("./includes/footer.php"); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>