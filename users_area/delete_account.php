
    <h3 class="text-danger mb-4">Delete Acount</h3>
    <form action="" method="post">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" value="Delete account" name="delete">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" value="Don't Delete account" name="dont_delete">
        </div>
    </form>


<?php
$username_session=$_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query="delete from `user_table` where username='$username_session'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account deleted successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if(isset($_POST['dont_delete'])){
   echo "<script>window.open('profile.php','_self')</script>";
}

?>