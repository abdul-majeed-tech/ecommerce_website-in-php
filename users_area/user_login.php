<?php 
@session_start();
include('../includes/connect.php'); 
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

<style>
    body{
        overflow-x: hidden;
    }
</style>
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your Username"
                            autocomplete="off" name="user_username" required="required" />
                    </div>
                    
                     <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password"
                            autocomplete="off" name="user_password" required="required" />
                    </div>
 
                    <div class="mb-4 w-50 m-auto pt-2"> 
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an acount ?<a href="user_registration.php" class="text-danger"> Registration</a></p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>


<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="select * from `user_table` where username='$user_username'";
   
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip = get_client_ip();


    // cart items
     $select_query_cart="select * from `cart_details` where ip_address='$user_ip'";
     $result_cart=mysqli_query($con,$select_query_cart);
     $row_count_cart=mysqli_num_rows($result_cart);
    if($row_count>0){
        $_SESSION['username'] = $user_username;
        if(password_verify($user_password,$row_data['user_password'])){
        //echo "<script>alert('login successfull')</script>";

          

        if($row_count==1 and $row_count_cart==0){
            $_SESSION['username'] = $user_username;
        echo "<script>alert('login successfull')</script>";
        echo "<script>window.open('profile.php','_self')</script>";

        }else{
            $_SESSION['username'] = $user_username;
            echo "<script>alert('login successfull')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
        }
        }
        echo "<script>alert('invalid credentials ')</script>";


    }else{
        echo "<script>alert('invalid credentials')</script>";

    }
}

?>