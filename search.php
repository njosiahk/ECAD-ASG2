<?php 
session_start(); // Detect the current session
include("header.php"); // Include the Page Layout header
?>

<!-- HTML Form to collect search keyword and submit it to the same page in server -->
<div style="width:80%; margin:auto;"> <!-- Container -->
<form name="frmSearch" method="get" action="">
    <div class="mb-3 row"> <!-- 1st row -->
        <div class="col-sm-9 offset-sm-3">
            <span class="page-title">Product Search</span>
        </div>
    </div> <!-- End of 1st row -->
    <div class="mb-3 row"> <!-- 2nd row -->
        <label for="keywords" 
               class="col-sm-3 col-form-label">Product Title:</label>
        <div class="col-sm-6">
            <input class="form-control" name="keywords" id="keywords" 
                   type="search" />
        </div>
        <div class="col-sm-3">
            <button type="submit">Search</button>
        </div>
    </div>  <!-- End of 2nd row -->
</form>

<?php
// The non-empty search keyword is sent to server
include_once("mysql_conn.php"); // Include the PHP file that establishes database connection handle: $conn
if (isset($_GET["keywords"]) && trim($_GET['keywords']) != "") {

	$SearchText = "%".$_GET["keywords"]."%";
     $qry = "select Distinct p.ProductID,p.ProductTitle,p.ProductImage,p.Price,p.Quantity from product p inner join ProductSpec ps on p.ProductID=ps.ProductID where (ProductTitle like ?) or (ProductDesc like ?) or (SpecVal like ?) order by ProductTitle"; // form SQL to select all the catergories
     $stmt = $conn->prepare($qry);
        $stmt->bind_param("sss", $SearchText, $SearchText, $SearchText);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0){
        echo "<table>";
        while ($row=$result->fetch_assoc()){
            $product = "productDetails.php?pid=$row[ProductID]";
            $formattedPrice = number_format($row["Price"], 2);
            $img = "Images/products/$row[ProductImage]";
            echo "<tr>";
            echo "<td><div class='row' style='padding: 5px'>";
            echo "<p><a href=$product>$row[ProductTitle]</a></p>";
            echo "Price: <span = 'font-weight:bold;color:red;'> S$$formattedPrice</span>";
            echo "</div></td>";
            echo "<td><div class ='col-4'>";
            echo "<img style='max-height:95%; max-width:95%;' src='$img'/>";
            echo "</div>";
            echo "</td></tr>";
        }
        echo "</table>";
        }
        else{
            $text = $_GET["keywords"];
            echo "<div class='danger'> Unable to find product with the keyword \"$text\".</div>";
        }

}

echo "</div>"; // End of container
include("footer.php"); // Include the Page Layout footer
?>