<?php 
session_start(); // Detect the current session
include("header.php"); // Include the Page Layout header
?>
<!-- Create a container, 90% width of viewport -->
<div style='width:90%; margin:auto;'>

<?php 
$pid=$_GET["pid"]; // Read Product ID from query string

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php"); 
$qry = "SELECT * from product where ProductID=?";
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $pid); 	// "i" - integer 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

while ($row = $result->fetch_array()) {
    // Display Page Header
    //products name is read from the "ProductTitle" column of "product" table
    echo "<div class='row' >";
    echo "<div class='col-sm-12' style='padding:5px'>";
    echo "<span class='page-title'>$row[ProductTitle]</span>";
    echo "</div>";
    echo "</div>";

    echo "<div class='row' >";

    //left column - display product description
    echo "<div class='col-sm-9' style='padding:5px'>";
    echo "<p>$row[ProductDesc]</p>";

    //left column - display product specification
    $qry = "SELECT s.SpecName, ps.SpecVal FROM productspec ps 
            INNER JOIN specification s ON ps.SpecID=s.SpecID 
            WHERE ps.ProductID =?
            ORDER BY ps.priority";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("i", $pid); 	// "i" - integer
    $stmt->execute();
    $result2 = $stmt->get_result();
    $stmt->close();
    while ($row2 = $result2->fetch_array()) {
        echo $row2["SpecName"].": ".$row2["SpecVal"]."<br />";
    } 
    echo "</div>"; // End of left column
    //Right column - display product image
    $img = "./Images/products/$row[ProductImage]";
    echo "<div class='col-sm-3' style='vertical-align:top; padding:5px'>";
    echo "<p><img src='$img' /></p>";

    //Right column - display product price
    $formattedPrice = number_format($row["Price"], 2);
    echo "<p>Price:<span style='font-weight: bold; color: red;'>
          S$formattedPrice</span></p>";
}

echo "<form action='cartFunctions.php' method='post'>";
echo "<input type='hidden' name='action' value='add' />";
echo "<input type='hidden' name='product_id' value='$pid' />";
echo "Quantity: <input type='number' name='quantity' value='1' 
                 min='1' max='10' style='width:40px' required />";
echo "<button type='submit'>Add to Cart</button>";
echo "</form>";
echo "</div>"; // End of right column
echo "</div>"; // End of row

$conn->close(); // Close database connnection
echo "</div>"; // End of container
include("footer.php"); // Include the Page Layout footer
?>
