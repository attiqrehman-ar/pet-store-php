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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        require 'connectdb.php';
        
        // Get the max ID in the suppliers table
        $query = "SELECT MAX(id) as max_id FROM suppliers";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'] + 1;
        
        // Insert a new supplier into the suppliers table
        $query = "INSERT INTO suppliers (id, name, number, email, password, address) VALUES ('$max_id', '$name', '$number', '$email', '$password', '$address')";
        mysqli_query($conn, $query);
        
        mysqli_close($conn);
        header("Location: suppliers.php");
    }      
    ?>

<?php 
   
   include './sidebar.php';
   
   ?>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Add Suplier</h2>
            <form id="productForm" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName"> Name</label>
                        <input type="text" id="productName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">  Number</label>
                        <input type="number" id="number" name="number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">  Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">  Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Address</label>
                        <textarea id="description" name="address" rows="4" required></textarea>
                    </div>
                </div>
                <button type="submit">Add Suplier</button>
            </form>
        </div>
    </section>
    
    

    <script src="../Assets/js/script.js"></script>
</body>
</html>
