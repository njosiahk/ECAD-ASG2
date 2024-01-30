<?php 
session_start();
if (isset($_POST['action'])) {
     switch ($_POST['action']) {
        case 'add':
            addItem();
            break;
        case 'update':
            updateItem();
            break;
        case 'remove':
            removeItem();
            break;
    }
}

function addItem() {
    // Check if user logged in 
    if (! isset($_SESSION["ShopperID"])) {
        // redirect to login page if the session variable shopperid is not set
        header ("Location: login.php");
        exit;
    }

    include_once("mysql_conn.php"); // Establish database connection handle: $conn
    // Check if a shopping cart exist, if not create a new shopping cart
    if (! isset($_SESSION["Cart"])) {
        //Create a shoppin cart for the shopper
        $qry = "Insert INTO Shopcart(ShopperID) VALUES (?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("i", $_SESSION["ShopperID"]);//"i" - integer
        $stmt->execute();
        $stmt->close();
        $qry = "SELECT LAST_INSERT_ID() as ShopCartID";
        $result = $conn->query($qry);
        $row =$result->fetch_array();
        $_SESSION["Cart"]=$row["ShopCartID"];
    }
    $pid = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $qry = "select * from shopcartitem where ShopCartID = ? and ProductID = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("ii", $_SESSION["Cart"], $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $addNewItem = 0;
    if ($result->num_rows > 0) {
        // increse the quantity of purchase

        $qry = "Update shopcartitem SET Quantity = LEAST(Quantity+?,10)
                WHERE ShopCartID = ? AND ProductID = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("iii", $quantity, $_SESSION["Cart"], $pid);
        $stmt->execute();
        $stmt->close();
    }
    else{

        $qry = "Insert INTO shopcartitem(ShopCartID, ProductID, Price,Name,Quantity) 
                Select ?, ?, Price, ProductTitle, ? From Product Where ProductID=?";
        $stmt = $conn->prepare($qry);
        
        $stmt->bind_param("iiii", $_SESSION["Cart"], $pid, $quantity, $pid);
        $stmt->execute();
        $stmt->close();
        $addNewItem = 1;
    }
      $conn->close();
      if (isset($_SESSION["NumCartItem"])){
        $_SESSION["NumCartItem"] =$_SESSION["NumCartItem"]+$addNewItem;
    }
    else{
        $_SESSION["NumCartItem"] = 1;
    }
    // Redirect shopper to shopping cart page
    header ("Location: shoppingCart.php");
    exit;
}

function updateItem() {
    // Check if shopping cart exists 
    // if (! isset($_SESSION["Cart"])) {
    //     // redirect to login page if the session variable cart is not set
    //     header ("Location: login.php");
    //     exit;
    // }
    $cartid = $_SESSION["Cart"];
    $pid = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    include_once("mysql_conn.php"); // Establish database connection handle: $conn
    $qry = "Update ShopCartItem SET Quantity = ? WHERE ShopCartID = ? AND ProductID = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("iii", $quantity, $cartid, $pid);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header ("Location: shoppingCart.php");
    exit;
}
function removeItem()
{
    // if (! isset($_SESSION["Cart"])) {
    //     // redirect to login page if the session variable cart is not set
    //     header ("Location: login.php");
    //     exit;
    // }
    include_once("mysql_conn.php");
    $cartid = $_SESSION["Cart"];
    $pid = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if ($quantity >0)
    {
        $qry = "Update ShopCartItem SET Quantity = ? WHERE ShopCartID = ? AND ProductID = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("iii", $quantity, $cartid, $pid);
    }
    else 
    {
        $qry="Delete from ShopCartItem where ShopCartID = ? and ProductID = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ii", $cartid, $pid);

    }
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION["NumCartItem"] =$_SESSION["NumCartItem"]-1;
    header ("Location: shoppingCart.php");
    exit;
}
// $cartid = $_SESSION["Cart"];
// $pid = $_POST["product_id"];
// include_once("mysql_conn.php"); // Establish database connection handle: $conn
// $qry = "Delete from ShopCartItem where ShopCartID = ? and ProductID = ?";
// $stmt = $conn->prepare($qry);
// $stmt->bind_param("ii", $cartid, $pid);
// $stmt->execute();
// $stmt->close();
// $conn->close();
// $_SESSION["NumCartItem"] =$_SESSION["NumCartItem"]-1;
// header ("Location: shoppingCart.php");
// exit;