<?php
session_start();
if(isset($_SESSION['username'])){


echo "welcome".$_SESSION['username'];
echo "<br>";
echo "And your password".$_SESSION['password'];
echo "<br>";
echo "And your email".$_SESSION['email'];

}else{
    echo "Please login again to continue ";
}





?>