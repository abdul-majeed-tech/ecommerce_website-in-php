<?php include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your Username"
                            autocomplete="off" name="user_username" required="required" />
                    </div>
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email"
                            autocomplete="off" name="user_email" required="required" />
                    </div>
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" name="user_image" required="required" />
                    </div>
                     <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password"
                            autocomplete="off" name="user_password" required="required" />
                    </div>
                     <div class="form-outline mb-4 w-50 m-auto">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm password"
                            autocomplete="off" name="conf_user_password" required="required" />
                    </div>
                     <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address"
                            autocomplete="off" name="user_address" required="required" />
                    </div>
                     <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="number" id="user_contact" class="form-control" placeholder="Enter your contact number"
                            autocomplete="off" name="user_contact" required="required" />
                    </div>
                    <div class="mb-4 w-50 m-auto pt-2"> 
                        <input type="submit" value="Registration" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an acount ?<a href="usere_login.php" class="text-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>



<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image'] ['name'];
    $user_image_tmp=$_FILES['user_image'] ['tmp_name'];
    $user_ip = get_client_ip();
     

    //select query
    $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result_query=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result_query);
    if($row_count>0){
        echo "<script>alert('Username and Email already exist')</script>";
    }elseif($user_password!=$conf_user_password){
        echo "<script>alert('password do not match')</script>";


    }
     else{
         // insert query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
     values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
     $sql_excute=mysqli_query($con,$insert_query);
    }
   
     // selecting cart items
     $select_cart_items="select * from `cart_details` where ip_address='$user_ip'";
     $result_cart=mysqli_query($con,$select_cart_items);
     $row_count=mysqli_fetch_row($result_cart);
     if($row_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('you have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";

     }else{
        echo "<script>window.open('index.php','_self')</script>";

     }
}

?>