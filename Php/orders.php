<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/main.css">
    <link rel="stylesheet" href="../Assets/css/loader.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
</head>
<body>
<?php

require 'connectdb.php';

// if (isset($_GET['id'])) {
  if (isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query = "UPDATE orders SET status = '$status' WHERE id = '$id'";
    mysqli_query($conn, $query);
    mysqli_close($conn);
    header("Location: orders.php");
    exit;
}

?>
   <!-- Loader container -->
<div class="loader-container" id="loaderContainer">
    <!-- Loader image -->
    <img src="../pictures/loader.svg" alt="Loader" class="loader-img">
  </div>  

  
  <script>
    function showloader(){
  // Get the loader container element
  var loaderContainer = document.getElementById('loaderContainer');
      // Display the loader container
      loaderContainer.style.display = 'block';
  
      // Hide the loader after 2 seconds
      setTimeout(function() {
        // Hide the loader container
        loaderContainer.style.display = 'none';
      }, 900);
    
    } ;
    window.onload=showloader();
    </script>
   <?php 
   
   include './sidebar.php';
   
   ?>

    <section class="dashboard">
        <!-- <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
          
        </div> -->
        <div class="table-container">
        <div>
                <button  class="edit-btn non">

                    <a href="./addProduct.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Product id</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Grand total</th>
                        <th>Customer name</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
    <?php 
    $query = "SELECT * FROM orders";
    $result = mysqli_query($conn, $query);
    $i=1;
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $status = $row['status']; 

                echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row['pet_id'] . "</td>";
            echo "<td>$" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>$" . $row['grand_total'] . "</td>";
            $i++;
            $query2 = "SELECT * FROM customers WHERE id = '" . $row['customer_id'] . "'";
            $result2 = mysqli_query($conn, $query2);
            while($row2 = mysqli_fetch_assoc($result2)) {
                $customer_name =$row2['name'];
                $customer_address =$row2['address'];
                echo "<td>$customer_name</td>";
                echo "<td>$customer_address</td>";

              }
            echo "<td class='check'>";
            ?>
            <form action="#" method="get">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <select name="status" class="delete-btn" id="" onchange="this.form.submit()">
                    <option value="" disabled> Select status</option>
                    <?php 
                    if($status == 'pending') {
                        echo '<option value="pending" selected> Pending </option> 
                              <option
                value="delivered"> Delivered </option>';
                    } else {
                        echo '<option value="delivered" selected disabled> Delivered </option>';
                    }
                    ?>
                </select>
            </form>
            <?php 
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No order placed yet</td></tr>";
    }
    ?>
</tbody>     </table>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
