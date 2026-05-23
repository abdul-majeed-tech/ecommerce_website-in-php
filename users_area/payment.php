<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        img{
            width: 90%;
            margin: auto;
            display: block;
        }
    </style>
</head>

<body>
    <!-- php code access to user id -->
     <?php
     $user_ip = get_client_ip();
    
     $get_user="select * from `user_table` where user_ip='$user_ip'";
     $result=mysqli_query($con,$get_user);
     $run_query=mysqli_fetch_array($result);
     $user_id=$run_query['user_id'];
   

     ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content align-items-center mt-5">
            <div class="col-md-6">

            <a href="https://www.paypal.com" target="_blank"><img src="../images/upi.jfif" alt=""></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">Pay offline</h2></a>
            </div>
            
        </div>
    </div>
</body>

</html>