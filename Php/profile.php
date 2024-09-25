<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/main.css"> 
    <link rel="stylesheet" href="../Assets/css/form.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
</head>
<body>
    
   <?php 
   
   require './loader.html';
   include './sidebar.php';
   
   ?>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
<?php 

// session_start();
require './connectdb.php';
// Retrieve the seller data from the database

if ($_SESSION["user_role"] == "seller") {
    $query = "SELECT * FROM sellers WHERE id = '".$_SESSION["user_id"]."'";
} elseif ($_SESSION["user_role"] == "customer") {
    $query = "SELECT * FROM customers WHERE id = '".$_SESSION["user_id"]."'";
}
else{
    
    $query = "SELECT * FROM admin WHERE id = '".$_SESSION["user_id"]."'";
}
$result = mysqli_query($conn, $query);
$seller_data = mysqli_fetch_assoc($result);



?>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Profile</h2>
            <form id="productForm" method="post">
                <div class="form-row" autcomplete="none">
                    <div class="form-group">
                        <label for="productName"> Name</label>
                        <input type="text" id="productName" name="name" value=<?php echo $seller_data['name'] ?> required>
                    </div>
                    <div class="form-group">
                        <label for="number">  Number</label>
                        <input type="number" id="number" name="number" value=<?php echo $seller_data['number'] ?> required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Address</label>
                        <textarea id="description" name="address" rows="4" required> <?php echo $seller_data['address'] ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">  Email</label>
                        <input type="email" id="email" name="email" value=<?php echo $seller_data['email'] ?> required>
                    </div>
                    <div class="form-group">
                        <label for="password">  Password</label>
                        <input type="password" id="password" name="password" value=<?php echo $seller_data['password'] ?>  required>
                    </div>
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </section>
    
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];

    // Update the seller data in the database
   $query="";
    if ($_SESSION["user_role"] == "seller") {
        $query = "UPDATE sellers SET name = '$name', number = '$number', email = '$email', password = '$password', address = '$address' WHERE id = '".$_SESSION["user_id"]."'";
    } elseif ($_SESSION["user_role"] == "customer") {
        $query = "UPDATE customers SET name = '$name', number = '$number', email = '$email', password = '$password', address = '$address' WHERE id = '".$_SESSION["user_id"]."'";
    }
    else{
        
        $query = "UPDATE admin SET name = '$name', number = '$number', email = '$email', password = '$password', address = '$address' WHERE id = '".$_SESSION["user_id"]."'";
    }
   
    mysqli_query($conn, $query);
    header("Location: profile.php");
      exit();
}

?>


<div class="loading">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>
<script src="../Assets/js/script.js"></script>
</body>
</html>
