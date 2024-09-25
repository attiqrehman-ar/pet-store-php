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

                    <a href="./addCustomers.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Customer name</th>
                        <th>Number</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
require 'connectdb.php';

$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);
$i=1;
 while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["number"]; ?></td>
      <td><?php echo $row["address"]; ?></td>
      <td>
        <form action="updateCustomer.php" method="get">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <button class="edit-btn" type="submit">Edit</button>
        </form>
       
        <form action="#" method="get">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>
   
    </td>
    </tr>

<?php 
$i++;
} ?>




    <!-- Delete button code  -->

    <?php
if (isset($_GET['btn'])) {
    // Retrieve the ID of the customer from the previous page
  $id = $_GET['id'];

  // Delete the customer's record from the database
  $query = "DELETE FROM customers WHERE id = '$id'";
  mysqli_query($conn, $query);

  // Close the database connection
  mysqli_close($conn);

  // Redirect to the customers page
  header("Location: customers.php");
  exit;
}
?>

                                    </tbody>
            </table>
        </div>
    </section>

    <script src="../Assets/js/script.js"></script>
</body>
</html>
