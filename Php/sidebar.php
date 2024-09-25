<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../pictures/logo3.jpg" alt="">
            </div>
            <span class="logo_name">PETS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
            

                     <li><a href="./profile.php"> 
                         <i class="uil uil-user"></i> 
                        <span class="link-name">Profile</span> 
                     </a></li>
                     
                <?php
                
                session_start();

                if (isset($_SESSION["logged_in"]) && $_SESSION["user_role"] =="seller" || $_SESSION["user_role"] =="admin" ) { ?>

                     <li><a href="./products.php">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Pets</span>
                </a></li>
                
                     <li><a href="./categories.php">
                    <i class="uil uil-list-ul"></i>
                    <span class="link-name">Categories</span>
                </a></li>
                <li><a href="./orders.php">
                    <i class="uil uil-shopping-cart"></i>
                    <span class="link-name">Orders</span>
                </a></li>
                
                <?php
                

                if (isset($_SESSION["logged_in"]) && $_SESSION["user_role"] =="admin") { ?>

                
                <li><a href="./customers.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Customers</span>
                </a></li>
                
                     <li><a href="./sellers.php"> 
                         <i class="uil uil-truck"></i> 
                        <span class="link-name">Sellers</span> 
                     </a></li>
                <?php } 
                
                } 
                ?>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="./logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <div class="mode-toggle">
                  <!-- <span class="switch"></span> -->
                </div>
            </ul>
        </div>
    </nav>
</body>
</html>