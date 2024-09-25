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
   
   include './sidebar.php';
   
   ?>
    


    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
          
        </div>
        <div class="table-container">
            <div>
                <button  class="edit-btn">

                    <a href="./addProduct.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Pet Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Pitures</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>


                <?php 
   require './loader.html';
   
   require 'connectdb.php' ;

   $query="";
   if($_SESSION['user_role']=="admin")
   $query = "SELECT * FROM alllpets ";
   else if($_SESSION['user_role']=="seller")   
    $query = "SELECT * FROM alllpets where seller_id = '".$_SESSION["user_id"]."'";
$result = mysqli_query($conn, $query);

// Fetch products as an array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close connection

// Display products
$i=1;
foreach ($products as $product) { 
    $id=$product['id'];
    ?>
  <tr>
    <td><?= $i ?></td>
    <td><?= $product["name"] ?></td>
    <td>$<?= $product["price"] ?></td>
    <td><?= $product["quantity"] ?></td>
    <?php
   $sql2 = "SELECT * FROM pictures where pet_id=$id GROUP BY pet_id
              LIMIT 1";
    $result2 = $conn->query($sql2);

 if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) { 

    // echo '<td> <img src="../pictures/pets/p1.jpg" alt='.$row2['path'] .' height="60px" wdith="60px" style="border-radius:4%; "  /> </td>';
    echo '<td> <img src=' . $row2['path'] . ' alt='.$row2['path'] .' height="60px" wdith="60px" style="border-radius:4%; "  /> </td>';
    }
  }
?>
    <td class="check">
            <form action="updateProduct.php"  method="get">
                <input type="hidden" name="id" value="<?= $product["id"] ?>">
                <button class="edit-btn" type="submit">Edit</button>
            </form>
            <form action="#" method="get">
                <input type="hidden" name="id" value="<?= $product["id"] ?>">
                <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        
</td>



  </tr>
 
<?php  $i++; } 
mysqli_close($conn);

?>

<?php

require 'connectdb.php';

// if (isset($_GET['id'])) {
if (isset($_GET['btn'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM alllpets WHERE id = '$id'";
  mysqli_query($conn, $query);
  mysqli_close($conn);
//   header("Location: products.php");
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
