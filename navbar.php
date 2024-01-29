<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "Welcome Guest<br />";
// href='register.php'
$content2 = "<li class='nav-item'>
             <a class='nav-link' >Sign Up</a></li>
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
    $content1 = "Welcome <b>$_SESSION[ShopperName] $_SESSION[ShopperID] </b>";//ID:$_SESSION[ShopperID] cartid:$cartid
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


<header>
<!-- <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top"> -->

</div>
    <!-- Container wrapper -->
    <div class="container-fluid">
            <!--Dynamic Text Display-->
            <span class="navbar-text ms-md-2" style="color:black; max-width: 80%;">
            <?php echo $content1; ?>
            </span>  
        <!-- Toggler -->
      <button data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1" class="btn shadow-0 p-0 me-3 d-block d-xxl-none"
        aria-controls="#sidenav-1" aria-haspopup="true">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <!-- Container wrapper -->

<!-- </nav> -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white">

<div id="sidenav-1" class="sidenav" data-mdb-color="dark" role="navigation" data-mdb-hidden="false"
    data-mdb-accordion="true">
    <ul class="sidenav-menu">
      <li class="sidenav-item">
        <a class="sidenav-link active" href="category.php">Product Categories</a>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link" href="search.php">Product Search</a>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link" href="shoppingCart.php">Shopping Cart</a>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
                <?php echo $content2; ?>
    </ul>
    <p class="small text-muted ps-4">© 2020 MDBootstrap</p>
</nav>
</header>
