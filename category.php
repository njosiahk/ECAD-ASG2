<?php 
session_start(); // Detect the current session
include("header.php"); // Include the Page Layout header
?>
<!-- Create a container, 60% width of viewport -->
<div style="width:60%; margin:auto;">
<!-- Display Page Header -->
<div class="row" style="padding:5px"> <!-- Start of header row -->
    <div class="col-12">
        <span class="page-title">Product Categories</span>
        <p>Select a category listed below:</p>
    </div>
</div> <!-- End of header row -->

<?php 
// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");

$qry = "SELECT * FROM Category";
$result = $conn->query($qry);

//Display each category in a row
while ($row = $result->fetch_array()) {
    echo "<div class='row' style='padding:5px'>"; // Start of row

    //left column, display a text link showing cat name, cat desc in new paragraph
    $catname = urlencode($row["CatName"]);
    $catproduct = "catProduct.php?cid=$row[CategoryID]&catName=$catname";
    echo "<div class='col-8'>";
    echo "<p><a href='$catproduct'>$row[CatName]</a></p>";
    echo "$row[CatDesc]";
    echo "</div>"; // End of left column

    //right column - display category image
    $img = "./Images/Category/$row[CatImage]";
    echo "<div class='col-4'>";
    echo "<img src='$img' />";
    echo "</div>"; // End of right column

    echo "</div>"; // End of row
}

$conn->close(); // Close database connnection
echo "</div>"; // End of container
include("footer.php"); // Include the Page Layout footer
?>
