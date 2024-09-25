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
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Add Customer</h2>
            <form id="productForm" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">  Number</label>
                        <input type="number" id="price" name="number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Address</label>
                        <textarea id="description" name="address" rows="4" required></textarea>
                    </div>
                </div>
                <button type="submit">Add Customer</button>
            </form>
        </div>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
  $number = $_POST['number'];
  $address = $_POST['address'];

  require 'connectdb.php';
 
  // Get the max ID in the table
  $query = "SELECT MAX(id) as max_id FROM customers";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $max_id = $row['max_id'] + 1;
  
  // Insert a new record with the next ID
  $query = "INSERT INTO customers (id, name, number, address) VALUES ('$max_id', '$name', '$number', '$address')";
 mysqli_query($conn, $query);
  mysqli_close($conn);
  header("Location: customers.php");
  exit;
}
?>

<script src="../Assets/js/script.js"></script>

</body>
</html>
