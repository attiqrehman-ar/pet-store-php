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
            <h2>Update Product</h2>

<?php
require 'connectdb.php';
$id = $_GET['id'];
$query = "SELECT * FROM alllpets WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<?php
require 'connectdb.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // $id = $_GET["id"];
  $productName = $_POST["productName"];
  $category = $_POST["category"];
  $price = $_POST["price"];
  $quantity = $_POST["quantity"];
  $description = $_POST["description"];

  $query = "UPDATE alllpets SET name = '$productName',  price = '$price', quantity = '$quantity', description = '$description' WHERE id = '$id'";
  mysqli_query($conn, $query);

  mysqli_close($conn);
  ?>
    <script >
      window.location.href="products.php";
    </script>
  <?php
 }
?>

<!-- Form to update product -->
<form id="productForm" method="post">
  <div class="form-row">
    <div class="form-group">
      <label for="productName">Product Name</label>
      <input type="text" id="productName" name="productName" value="<?= $product['name'] ?>" required>
    </div>
    <div class="form-group">
                        <label for="PetName">Category</label>
                        <select id="category" name="category" required>
    <?php
    require 'connectdb.php';
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);
    // Fetch categories as an array
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Display categories as options
    foreach ($categories as $category) {
      ?>
      <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
      <?php
    }
    ?>
              </select>
          </div>
      </div>
  <div class="form-row">
    <div class="form-group">
      <label for="price">Price</label>
      <input type="number" id="price" name="price" value="<?= $product['price'] ?>" required>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="number" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" required><?= $product['description'] ?></textarea>
    </div>
  </div>
  <button type="submit">Update Product</button>
</form>

        </div>
    </section>
    



    <script src="../Assets/js/script.js"></script>
</body>
</html>
