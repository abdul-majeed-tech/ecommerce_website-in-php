<?php
//include('./includes/connect.php');


// get products
function getproducts()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brands'])) {

            $select_query = "Select * from `products` order by rand() LIMIT 0,9";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brands_id = $row['brands_id'];
                echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }


}

// getting all products
function get_all_products()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brands'])) {

            $select_query = "Select * from `products` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brands_id = $row['brands_id'];
                echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

function get_unique_categories()
{
    global $con;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        $select_query = "Select * from `products` where category_id=$category_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No category found</h2>";

        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>";
        }
    }



}



///end
// getting uniqe categories
function get_unique_brands()
{
    global $con;

    if (isset($_GET['brands'])) {
        $brands_id = $_GET['brands'];

        $select_query = "Select * from `products` where brands_id=$brands_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this brand</h2>";

        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}

//display brands in sidenav
function getbrands()
{
    global $con;

    $select_brands = "select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brands_title = $row_data['brands_title'];
        $brands_id = $row_data['brands_id'];
        echo "<li class='nav-item'>
                        <a href='index.php?brands=$brands_id' class='nav-link text-light'>$brands_title</a>
                    </li>";
    }
}

// display categories in sidenav
function getcategories()
{
    global $con;
    $select_category = "select * from `categories`";
    $result_category = mysqli_query($con, $select_category);
    while ($row_data = mysqli_fetch_assoc($result_category)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'>
                        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                    </li>";
    }
}

//searching product function
function search_product()
{
    global $con;

    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "Select * from `products` where product_keyword like '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No results match. No productson this category </h2>";

        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brands_id = $row['brands_id'];
            echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}
///add to cart

// view details functions
function view_details()
{
    global $con;
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brands'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";

                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brands_id = $row['brands_id'];
                    echo "<div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>price:$product_price/-</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>Veiw more</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class='col-md-8'>
                     <div class='row'>
                        <div class='col-md-12'>
                            <h4 class='text-center text-info mb-5'>Related Products</h4>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title' class='card-img-top' alt='$product_title'>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title' alt='$product_title'>
                        </div>
                     </div>


                </div>";
                }
            }
        }
    }
}

//add to cart function

function get_client_ip()
{
    $cookie_name = "user_unique_id";

    // 1. Check karein ke browser mein ID pehle se hai?
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    }

    // 2. Agar nahi hai, toh ek Unique ID banayein
    // Hum session_id() ya uniqid() use kar sakte hain
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // uniqid() ek random unique string generate karta hai
    $unique_id = uniqid('user_', true);

    // 3. Is Unique ID ko cookie mein save karein (30 din ke liye)
    setcookie($cookie_name, $unique_id, time() + (86400 * 30), "/");

    return $unique_id;
}
function Cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $user_ip = get_client_ip();
        $get_product_id = $_GET['add_to_cart'];

        // 1. Check if item already exists for THIS SPECIFIC USER/IP
        $select_query = "Select * from `cart_details` where ip_address = '$user_ip' and product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already inside the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>"; // Fixed spelling: window
        } else {
            // 2. Insert with quantity 1 (0 nahi rakhni chahiye)
            $insert_query = "insert into `cart_details` (product_id, ip_address, quantity) values ($get_product_id, '$user_ip', 1)";
            $result_query = mysqli_query($con, $insert_query);

            if ($result_query) {
                echo "<script>alert('This item is added to cart')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                // Agar ab bhi error aaye, to database structure check karein
                echo "Error: " . mysqli_error($con);
            }
        }
    }
}

// function to get cart item numbers
function Cart_items()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $user_ip = get_client_ip();
        $select_query = "Select * from `cart_details` where ip_address = '$user_ip'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $user_ip = get_client_ip();
        $select_query = "Select * from `cart_details` where ip_address = '$user_ip'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;

}


//total price function
function total_cart_price()
{
    global $con;
    $total_price = 0;
    $user_ip = get_client_ip();
    $cart_query = "Select * from `cart_details` where ip_address='$user_ip'";
    $result_query = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_products = "Select * from `products`where product_id=$product_id";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

// get user order details
function get_user_order_details()
{
    global $con;
    $username = $_SESSION['username'];
    $get_details = "select * from `user_table` where username='$username'";
    $result_query = mysqli_query($con, $get_details);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {

                    $Get_orders = "select * from  `user_orders` where user_id = '$user_id' and order_status = 'pending'";
                    $result_order_query = mysqli_query($con, $Get_orders);

                    $row_count = mysqli_num_rows($result_order_query);

                    if ($row_count > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";

                    } else {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore product</a></p>";
                    }

                }
            }
        }

    }

}
?>