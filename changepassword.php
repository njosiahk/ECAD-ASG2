<?php 
session_start();
include("header.php")
?>
<form action="post">
    <label for="pwd1">Enter New password :</label>
    <input type="password">
    <br>
    <br>
    <label for="pwd2">Re-enter New password :</label>
    <input type="password">
    <hr>
    <input type="submit" value="Submit">
</form>


<?php 
include("footer.php")
?>