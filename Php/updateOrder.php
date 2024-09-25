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
require 'connectdb.php';

$product_id = "";
$price = "";
$quantity = "";
$customer_id = "";

// Retrieve the ID of the customer from the previous page
$id = $_GET['id'];

// Retrieve the customer's data from the database
$query = "SELECT * FROM orders WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Populate the form fields with the customer's information
$product_id = $order['product_id'];
$price = $order['price'];
$quantity = $order['quantity'];
$customer_id = $order['customer_id'];

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
            <h2>Add Product</h2>
            <form id="productForm" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="product_id">Product id</label>
                        <input type="text" id="product_id" name="product_id" readonly value="<?php echo $product_id; ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="customer_id">Customer_id</label>
                        <input type="" id="customer_id" name="customer_id" readonly value="<?php echo $customer_id; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="name" name="price" readonly value="<?php echo $price; ?>" required>
                        </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="name" name="quantity"  value="<?php echo $quantity; ?>" required>
                    </div>
                </div>
               
                <button type="submit">update order</button>
            </form>
        </div>
    </section>
    <?php
if (!empty($_POST)) {
    $quantity = $_POST['quantity'];
    $grand_total = $price * $quantity;

    // Update the customer's record in the database
    $query = "UPDATE orders SET quantity = '$quantity', grand_total='$grand_total' WHERE id = '$id'";
    mysqli_query($conn, $query);
  
    // Close the database connection
    mysqli_close($conn);
  
    // Redirect to the customers page
    header("Location: orders.php");
    exit;
}

?>
    

    <script src="../Assets/js/script.js"></script>
</body>
</html>
