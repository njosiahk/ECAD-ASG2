<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "Welcome Guest<br />";
$content2 = "<li class='nav-item'>
             <a class='nav-link' href='register.php'>Sign Up</a></li>
             <li class='nav-item'>
             <a class='nav-link' href='login.php'>Login</a></li>";

if(isset($_SESSION["ShopperName"])) { 
//Display a greeting message, Change Password and logout links 
    //after shopper has logged in.
    if (isset($_SESSION["Cart"])) {
    $cartid = $_SESSION["Cart"];
    }
    else {
        $cartid = "not created";
    }
    $content1 = "Welcome <b>$_SESSION[ShopperName] </b>";//ID:$_SESSION[ShopperID] cartid:$cartid
    $content2 = "<li class='nav-item'>
                 <a class='nav-link' href='changePassword.php'>Change Password</a></li>
                 <li class='nav-item'>
                 <a class='nav-link' href='logout.php'>Logout</a></li>";
    

    //Display number of item in cart
    if (isset($_SESSION["NumCartItem"])) {
        $content1 .= " $_SESSION[NumCartItem] item(s) in shopping cart";
    }
}
?>

     <!-- Display a navbar which is visible before or after collapsing -->
<nav class="navbar navbar-expand-md bg-secondary">
    <div class="container-fluid">
        <!--Dynamic Text Display-->
        <span class="navbar-text ms-md-2" style="color:black; max-width: 80%;">
            <?php echo $content1; ?>
        </span>
        <!-- Toggler/Collapsibe Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            
        </button>
    </div>
</nav>

     <!-- Define a collapsible navbar -->
     <nav class="navbar navbar-expand-md bg-custom">
    <div class="container-fluid">
        <!-- Collapsoble part of navbar -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- left-justified menu items  -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="category.php">Product Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Product Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoppingCart.php">Shopping Cart</a>
                </li>
            </ul>
            <!-- right-justified items  -->
            <ul class="navbar-nav ms-auto">
                <?php echo $content2; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark"></nav> -->