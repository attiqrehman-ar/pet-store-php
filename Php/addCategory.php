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
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            
            require 'connectdb.php';
          // Query to insert category into database
          $query = "SELECT MAX(id) as max_id FROM categories";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $max_id = $row['max_id'] + 1;
          
          // Insert a new category into the categories table
          $query = "INSERT INTO categories (id, category_name) VALUES ('$max_id', '$name')";
          mysqli_query($conn, $query);
        
          // Close connection
          mysqli_close($conn);
        
          // Redirect to categories page
          header("Location: categories.php");
        exit;
        }        
        ?>

        <!-- Add this form below the existing top div -->
        <div class="form-container category-form">
            <h2>Add Category</h2>
            <form id="productForm" class="category-form" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Cateogry Name</label>
                        <input type="text" id="productName" name="name" required>
                    </div>
                </div>
                <button type="submit">Add Category</button>
            </form>
        </div>
    </section>
    
    

    <script src="../Assets/js/script.js"></script>
</body>
</html>
