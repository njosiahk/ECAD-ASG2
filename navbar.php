<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "Welcome ";
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
    $content1 = "Welcome $_SESSION[ShopperName] ID: $_SESSION[ShopperID] ";//ID:$_SESSION[ShopperID] cartid:$cartid
    $content2 = "<li class='nav-item'>
                 <a class='nav-link' href='changePassword.php'>Change Password</a></li>
                 <li class='nav-item'>
                 <a class='nav-link' href='logout.php'>Logout</a></li>";
    

    //Display number of item in cart
    // if (isset($_SESSION["NumCartItem"])) {
    //     $content1 .= " $_SESSION[NumCartItem] item(s) in shopping cart";
    // }
}

?>


<header>
<div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Ngee Ann Polytechnic</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">CityLush@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
              <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <h5 class="navbar-nav mx-auto"><?php echo $content1 ?></h5>
              </nav>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">

                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Lion City Lush</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="category.php" class="nav-item nav-link">Product Types</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <a href="search.php"><button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" ><i class="fas fa-search text-primary"></i></button></a>
                            <a href="shoppingCart.php" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $_SESSION["NumCartItem"] ?></span>
                            </a>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
</header>
