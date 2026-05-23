<?php
session_start();
include('../includes/connect.php'); 
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

    <!-- awesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .body {
            overflow: hidden;
        }

        .img-fluid {
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="product_images/login.jfif" alt="admin_registration" class="img-fluid">
            </div>


            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4 w-auto">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control w-75"
                            placeholder="Please enter your name" required="required">

                    </div>
                   
                    <div class="form-outline mb-4 w-auto">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control w-75"
                            placeholder="Please enter your password" required="required">

                    </div>

                    <div>
                        <input type="submit" name="admin_login" value="Login"
                            class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account ? <a href="admin_registration.php"
                                class="link-danger"> Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php

if(isset($_POST['admin_login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $select_query="select * from `admin_table` where admin_name='$username'";
   
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip = get_client_ip();

    if($row_count>0){
        
        if(password_verify($password,$row_data['admin_password'])){
            $_SESSION['admin_name'] = $username;
        echo "<script>alert('login successfull')</script>";
        echo "<script>window.open('profile.php','_self')</script>";

        }else{
            // Wrong password
            echo "<script>alert('Wrong password')</script>";
        }
        }else{
            // Username doesn't exist
        echo "<script>alert('Username does not exist')</script>";
        }
       
}

?>

