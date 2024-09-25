<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/main.css">
     
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
        <div class="table-container">
            <div>
                <button  class="edit-btn">

                    <a href="./addCategory.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Category Name</th>
                        <th>Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  require  "connectdb.php";
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

// Fetch categories as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close connection
// mysqli_close($conn);

// Display categories
foreach ($categories as $category) { ?>
  <tr>
    <td><?= $category["id"] ?></td>
    <td><?= $category["category_name"] ?></td>
  
<td class="check">
<form action="updateCategory.php" method="get">
      <input type="hidden" name="id" value="<?= $category["id"] ?>">
      <button class="edit-btn" type="submit">Edit</button>
    </form>
    <form action="#" method="get">
        <input type="hidden" name="id" value="<?= $category["id"] ?>">
        <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>

  </td>

  </tr>
<?php } ?>


<?php

require 'connectdb.php';

if (isset($_GET['id'])) {
// if (isset($_GET['btn'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM categories WHERE id = '$id'";
  mysqli_query($conn, $query);
  mysqli_close($conn);
//   header("Location: categories.php");
//   exit;
}

?>

                </tbody>
            </table>
        </div>
    </section>

    <script src="../Assets/js/script.js"></script>
</body>
</html>
