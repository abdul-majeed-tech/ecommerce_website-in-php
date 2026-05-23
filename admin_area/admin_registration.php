<?php include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="product_images/signup.jfif" alt="admin_registration" class="img-fluid">
            </div>


            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4 w-auto">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control w-75"
                            placeholder="Please enter your name" required="required">

                    </div>
                    <div class="form-outline mb-4 w-auto">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control w-75"
                            placeholder="Please enter your email" required="required">

                    </div>
                    <div class="form-outline mb-4 w-auto">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control w-75"
                            placeholder="Please enter your password" required="required">

                    </div>
                    <div class="form-outline mb-4 w-auto">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control w-75"
                            placeholder="Please enter your password" required="required">

                    </div>
                    <div>
                        <input type="submit" name="admin_registration" value="Register"
                            class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1">Do you already have an account ? <a href="admin_login.php"
                                class="link-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<?php
if (isset($_POST['admin_registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
    $user_ip = get_client_ip();


    //select query
    $select_query = "Select * from `admin_table` where admin_name='$username' or admin_email='$email'";
    $result_query = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result_query);
    if ($row_count > 0) {
        echo "<script>alert('Username and Email already exist')</script>";
    } elseif ($password != $confirm_password) {
        echo "<script>alert('password do not match')</script>";


    } else {
        // insert query

        $insert_query = "insert into `admin_table` (admin_name,admin_email,admin_password)
     values ('$username','$email','$hash_password')";
        $sql_excute = mysqli_query($con, $insert_query);
        if ($sql_excute) {
            echo "<script>alert('Username and Email successfull inserted')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        }
    }
}

?>