<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Assets/css/main.css"> 
    <link rel="stylesheet" href="../Assets/css/form.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
</head>
<body>
   
<?php 
   
   require './loader.html';
   include './sidebar.php';
   
   ?>
    
    <?php

$mesg="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $category_id = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    
  if (!empty($_FILES['pictures']) && isset($_FILES['pictures']['tmp_name'])) {
        // Define error variables
        $nameErr = $dateErr = $descriptionErr = "";
        
        // Validate name/title
        if (empty($_POST["productName"])) {
            $nameErr = "Name/Title is required";
        } else {
            $productName = $_POST["productName"];
        }

        // Validate date of completion
        if (empty($_POST["category"])) {
            $dateErr = "Category is required";
        } else {
            $category_id = $_POST["category"];
        }

        // Validate description
        if (empty($_POST["price"])) {
            $priceErr = "Description is required";
        } else {
            $price = $_POST["price"];
        }

        if (empty($_POST["quantity"])) {
            $priceErr = "quantity is required";
        } else {
            $quantity = $_POST["quantity"];
        }
        if (empty($_POST["description"])) {
            $descriptionErr = "description is required";
        } else {
            $description = $_POST["description"];
        }

        // Check if there are no errors
        if (empty($nameErr)) {
            // Connect to the database

    require 'connectdb.php';
    // Query to insert product into database
    $query = "SELECT MAX(id) as max_id FROM alllpets";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $max_product_id = $row['max_id'] + 2;
    
    $sellerid=$_SESSION['user_id'];
    // Insert a new product into the products table
    $query = "INSERT INTO alllpets (id, name, price, quantity, description,seller_id) VALUES ('$max_product_id', '$productName', '$price', '$quantity', '$description', '$sellerid' )";
    // mysqli_query($conn, $query);

// if ($conn->query($query) === TRUE) {
if (mysqli_query($conn, $query) === TRUE) {
                // Get the last inserted project ID
                $petid = $conn->insert_id;

                // Handle uploaded images
                foreach ($_FILES['pictures']['tmp_name'] as $key => $tmp_name) {
                    // Check if the file is uploaded successfully
                    if ($_FILES['pictures']['error'][$key] === UPLOAD_ERR_OK) {
                        $file_name = $_FILES['pictures']['name'][$key];
                        $file_tmp = $_FILES['pictures']['tmp_name'][$key];

                        $sanitized_file_name = preg_replace('/[^a-zA-Z0-9_.]/', '_', $file_name);


                        // Move uploaded file to upload directory
                        move_uploaded_file($file_tmp, "../Assets/pictures/pets/" . $sanitized_file_name);

                        // Insert image details into the database
                        $sql = "INSERT INTO pictures (pet_id, img_name, path) VALUES ('$petid', '$file_name', '../Assets/pictures/pets/$sanitized_file_name')";
                        $conn->query($sql);
                    }
                }

                header("Location: ./products.php");
                exit;                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close database connection
            $conn->close();
        }
    }
    
      
}
?>


    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Add Pet details</h2>
            <div class="error"> <?php echo $mesg ?> </div>
            <form id="productForm" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="PetName">Pet Name</label>
                        <input type="text" id="productName" name="productName" required>
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
                        <input type="number" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" title="please enter" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Picture</label>
                        <input type="file" required id="pictures" name="pictures[]" accept="image/*" multiple />
                        </div>
                </div>
                <button type="submit">Add Pet</button>
            </form>
        </div>
    </section>
    
    

    <script src="../Assets/js/script.js"></script>
</body>
</html>
