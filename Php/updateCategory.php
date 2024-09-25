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
require 'connectdb.php';

$id = $_GET['id'];
$query = "SELECT * FROM categories WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
  
        <!-- Add this form below the existing top div -->
        <div class="form-container category-form">
            <h2>Update Category</h2>
            <form id="productForm" class="category-form" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Cateogry Name</label>
                        <input type="text" id="productName" name="name" value="<?= $category['category_name'] ?>" required>
</div> 
                    </div>
                    <button type="submit">Update Category</button>
                </div>
            </form>
        </div>
    </section>
    
    <?php
require 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];

  $query = "UPDATE categories SET category_name = '$name' WHERE id = '$id'";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  header("Location: categories.php");
  exit;
}
?>


<script src="../Assets/js/script.js"></script>
</body>
</html>
