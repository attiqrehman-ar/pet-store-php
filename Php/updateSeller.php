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
$supplier_id = $_GET['id']; // Get the supplier ID from the query parameter

require 'connectdb.php';

// Retrieve the supplier data from the database
$query = "SELECT * FROM sellers WHERE id = '$supplier_id'";
$result = mysqli_query($conn, $query);
$supplier_data = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>


    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $supplier_id = $_GET['id']; // Get the supplier ID from the query parameter
  
    require 'connectdb.php';
  
    // Update the supplier record in the database
    $query = "UPDATE sellers SET name = '$name', number = '$number', email = '$email', password = '$password', address = '$address' WHERE id = '$supplier_id'";
    mysqli_query($conn, $query);
  
    mysqli_close($conn);
  
    header("Location: sellers.php");
    exit;
  }
  
    ?>
 
 <?php 
   
   require './loader.html';
   include './sidebar.php';
   
   ?>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Update Data</h2>
            <form id="productForm" method="post">
    <div class="form-row">
      <div class="form-group">
        <label for="productName">Name</label>
        <input type="text" id="productName" name="name" value="<?php echo $supplier_data['name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="number">Number</label>
        <input type="number" id="number" name="number" value="<?php echo $supplier_data['number']; ?>" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $supplier_data['email']; ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $supplier_data['password']; ?>" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="description">Address</label>
        <textarea id="description" name="address" rows="4" required><?php echo $supplier_data['address']; ?></textarea>
      </div>
    </div>

                <button type="submit">Update Seller</button>
            </form>
        </div>
    </section>
    
    

    <script src="../Assets/js/script.js"></script>
</body>
</html>
