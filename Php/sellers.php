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

    <title>Admin Dashboard </title> 
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

                    <a href="./addSupplier.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Seller Name</th>
                        <th>Number</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php

function all_sellers(){
    require 'connectdb.php';
    $row="";
  
    $query = "SELECT * FROM sellers";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['number'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>";
    echo "<button class='edit-btn'><a href='updateSeller.php?id=" . $row['id'] . "'>Edit</a></button>";
    ?> 
    
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>
    <?php
    
    echo "</td>";
    echo "</tr>";
}
} else {
    echo "<tr><td colspan='5'>No Seller found</td></tr>";
}

}
all_sellers();
?>

<?php
if (isset($_POST['btn'])) {
    // Retrieve the ID of the customer from the previous page
    require 'connectdb.php';
    $id = $_POST['id'];
    
    // Delete the customer's record from the database
  $query = "DELETE FROM sellers WHERE id = '$id'";
  mysqli_query($conn, $query);

  // Close the database connection
  mysqli_close($conn);

// all_sellers();
  // Redirect to the customers page
//   header("Location: refresh.php");
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
