<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "<nav class='navbar navbar-light bg-warning navbar-expand-xl'>
<h5 class='navbar-nav mx-auto'>Welcome</h5> 
</nav>";
// href='register.php'
$content2 = "<a href='login.php'>
<button type='button' class='btn btn-outline-info' >Login</button>
</a>";
$content3 = "";
if(isset($_SESSION["ShopperName"])) { 
//Display a greeting message, Change Password and logout links 
    //after shopper has logged in.
    if (isset($_SESSION["Cart"])) {
    $cartid = $_SESSION["Cart"];
    }
    else {
        $cartid = "not created";
    }
    $content1 = "<nav class='navbar navbar-light bg-success navbar-expand-xl'><h5 class='navbar-nav mx-auto'>Welcome $_SESSION[ShopperName] ID: $_SESSION[ShopperID] </h5></nav>";
    $content2 = "<a href='changepassword.php' class='my-auto'><i class='fas fa-user fa-2x'></i></a><a href='logout.php'><button type='button' class='btn btn-outline-danger' >Logout</button></a>";
    

    // Display number of item in cart
    if (isset($_SESSION["NumCartItem"])) {
        $content3 .= " $_SESSION[NumCartItem]";
    }
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
              <nav class="navbar navbar-light bg-secondary navbar-expand-xl">
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
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $content3 ?></span>
                            </a>
                            <?php echo $content2 ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
</header>
