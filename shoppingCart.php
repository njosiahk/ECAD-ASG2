<?php 

include_once("cartFunctions.php");
include("header.php");

if (! isset($_SESSION["ShopperID"])) { // Check if user logged in 
    // redirect to login page if the session variable shopperid is not set
    header ("Location: login.php");
    exit;
}

echo "<div id='myShopCart' style='margin:auto'>"; // Start a container
if (isset($_SESSION["Cart"])) {
    include_once("mysql_conn.php");
    $qry = "Select *,(Price*Quantity) as Total from ShopCartItem where ShopCartID=?"; // Form SQL to retrieve the shopping cart content
    
    $stmt = $conn->prepare($qry);
    $stmt->bind_param('i', $_SESSION["Cart"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        // the page header and header row of shopping cart page
        echo "<p class='page-title' style='text-align:center'>Shopping Cart</p>"; 
        echo "<div class='table-responsive' >"; 
        echo "<table class='table table-hover'>";
        echo "<thead class='cart-header'>";
        echo "<tr>";
        echo "<th width='250px'>Item</th>";
        echo "<th width='90px'>Price</th>";
        echo "<th width ='60px'>Quantity</th>";
        echo "<th width='120px'>Total (S$)</th>";
        echo "<th>&nbsp;</th>";
        echo "</tr>";
        echo "</thead>";
        // Declare an array to store the shopping cart items in session variable 
        $_SESSION["Items"]=array();
        // Display the shopping cart content
        $subTotal = 0; // Declare a variable to compute subtotal before tax
        echo "<tbody>"; // Start of table's body section
        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td style='width:50%'>$row[Name]<br/>";
            echo "Product ID: $row[ProductID]</td>";
            $formattedPrice = number_format($row["Price"], 2);
            echo "<td>$formattedPrice</td>";
            echo "<td>";
            echo "<form action = 'cartFunctions.php' method='post'>";
            echo "<select name = 'quantity' onChange='this.form.submit()'>";
    
            
            for ($i = 1; $i <= 10; $i++) {
                $selected = ($i == $row["Quantity"]) ? "selected" : "";
                echo "<option value='$i' $selected>$i</option>";
                
            }
            echo "</select>";
            echo "<input type='hidden' name='action' value='update' />";
            echo "<input type='hidden' name='product_id' value='$row[ProductID]' />";
            echo "</form>";
            echo "</td>";
            $formattedTotal = number_format($row["Total"], 2);
            echo "<td>$formattedTotal</td>";
            echo "<td>";
            echo "<form action = 'cartFunctions.php' method='post'>";
            echo "<input type='hidden' name='action' value='remove' />";
            echo "<input type='hidden' name='product_id' value='$row[ProductID]' />";
            echo "<input type='image' src='images/delete.png' title='Remove Item' style='width: 50px; height: auto;'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
            // Store the shopping cart items in session variable as an associate array
            $_SESSION["Items"][]=array("productId"=>$row["ProductID"],
                                       "name"=>$row["Name"],
                                       "price"=>$row["Price"],
                                       "quantity"=>$row["Quantity"]
        );
            // Accumulate the running sub-total
            $subTotal += $row["Total"];
        }
        echo "</tbody>"; // End of table's body section
        echo "</table>"; // End of table
        echo "</div>"; // End of Bootstrap responsive tabl
        // Display the subtotal at the end of the shopping cart
            echo "<p style ='text-align:right;font-size:20px'> Subtotal: S$". number_format($subTotal,2);
            $_SESSION["SubTotal"]=round($subTotal,2);
        // Add PayPal Checkout button on the shopping cart page
        echo "<form method='post' action=''>";
        echo "<input type='image' style='float:right;'src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif'>";
        echo "</form></p>";
                
    }
    else {
        echo "<h3 style='text-align:center; color:red;'>Empty shopping cart!</h3>";
    }
    $conn->close(); // Close database connection
}
else {
    echo "<h3 style='text-align:center; color:red;'>Empty shopping cart!</h3>";
}
echo "</div>"; // End of container
include("footer.php"); // Include the Page Layout footer
?>
