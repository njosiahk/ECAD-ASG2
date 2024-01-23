<?php
session_start();
 $email  = $_POST["email"];
 $pwd = $_post["password"];

 if(($email == "ecader@np.edu.sg") && ($pwd == "ecader"))
{
    $_SESSION["ShopperName"] = "Ecader";
    $_SESSION["ShopperID"] = 1;
    echo "You are a valid user";
}


 else{
    echo "You are an invalid user!";
 }
 ?>
