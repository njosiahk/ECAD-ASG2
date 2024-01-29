<?php
session_start();
 $email  = $_POST["email"];
 $pwd = $_POST["password"];
//  $hased_pass= crypt($pwd,'st');

include_once("mysql_conn.php");
$qry = "Select ShopperID, Name,Email,Password from shopper where Email = ? ";
$stmt = $conn->prepare($qry);
$stmt ->bind_param('s',$email);
$stmt -> execute();

$result = $stmt->get_result();
$loginpass = false;
 
if ($result->num_rows > 0) 
{
    // Fetch the row from the result set.
    $row = $result->fetch_assoc();
    $hashed_pwd=$row['Password'];
    // Compare the email and password to the database values.
    if (password_verify($pwd, $hashed_pwd)) 
    {
        $loginpass = true;
        // Save the user's info in session variables.
        $_SESSION["ShopperName"] = $row['Name'];
        $_SESSION["ShopperID"] = $row['ShopperID'];

        $qry = "Select sc.ShopCartID,COUNT(sci.ProductID) as NumItems 
        from ShopCart sc inner join ShopCartItem sci 
        on sc.ShopCartID=sci.ShopCartID 
        where sc.OrderPlaced = 0 and sc.ShopperID = ?";
        
        $stmt = $conn->prepare($qry);
        $stmt->bind_param('i', $_SESSION["ShopperID"]);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $stmt->close();
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $_SESSION["NumCartItem"] = $row2['NumItems'];
            $_SESSION["Cart"]=$row2['ShopCartID'];
        }
        $conn->close();
        header("Location: index.php");
        exit;
    } 
    else 
    {
        echo "<p></p>";
        echo "<h3 style ='color:red'>Invalid Login Credentials - <br/>
        password is incorrect!</h3>";
    }
} 
else 
{
    echo "<h3 style ='color:red'>Invalid Login Credentials - <br/>
    Email address not found!</h3>";
}
$conn->close();

if ($loginpass) {
    header("Location:index.php");
    exit;
}
else{
    echo "Please <a href='login.php'>login</a> again.";
}

//Include the Page Layout footer
include("footer.php");
//for testing now later need to delete
// session_destroy();
?>