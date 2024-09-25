<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php  
    
    require './navbar.php';
 $error="";
    ?>
    
    <link rel="stylesheet" href="../Assets/css/index.css">
    <link rel="stylesheet" href="../Assets/css/popup.css">
    <link rel="stylesheet" href="../Assets/css/cards.css">
</head>
<body>
    

<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    if(isset($_POST['search'])) {
        require "./connectdb.php";
        echo '
        <div class="pets" id="pets">
            <p class="pp"> Search result</p>
            <div class="card-list">';
        $searchQuery = $_POST['search'];
        $sqlSearch = "SELECT p.id AS pet_id, p.price as price, p.name AS pet_name, pic.path AS image_path 
                      FROM alllpets p 
                      INNER JOIN pictures pic ON p.id = pic.pet_id 
                      WHERE p.name LIKE '%$searchQuery%' OR p.description LIKE '%$searchQuery%'";
        $resultSearch = $conn->query($sqlSearch);
    
        if ($resultSearch->num_rows > 0) {
            while ($rowSearch = $resultSearch->fetch_assoc()) {
                echo '<a href="pet_description.php?pet_id=' . $rowSearch['pet_id'] . '" class="card-item animate-left">';
                echo '<img src="' . $rowSearch['image_path'] . '" alt="Card Image" >';
                echo '<h3>' . $rowSearch['pet_name'] . '</h3>';
                echo '<h6> Price: $' . $rowSearch['price'] . '</h6>';
                echo '<div class="arrow">Details</div>';
                echo '</a>';
            }
        } else {
            echo 'No pets found matching your search.';
        }
        echo '</div></div>'; // Close the projects and card-list divs for the "Projects" section
    }
    
            else {
    
    require './connectdb.php';
    
    $name = $_POST["name"];
    $number = $_POST["number"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $quantity = $_POST["quantity"];
    
            
    session_start();
    $pet_id = $_SESSION['pet_id'];
    $price = $_SESSION['price'];
    $available_stock = $_SESSION['quantity'];
    
    $quantity = intval($_POST["quantity"]);
    if ($quantity > $available_stock) {
        $error = "Quantity is greater than our stock";
    }
    
    if ($error == "") {
    
            // Insert customer data into "customers" table
            $customer_query = "INSERT INTO customers (name, number, address, email, password) VALUES ('$name', '$number', '$address', '$email', '$password')";
        mysqli_query($conn, $customer_query);
        $customer_id = mysqli_insert_id($conn);
    
    
    $grand_total = $price * $quantity;
    
    // Insert order data into "orders" table
    $order_query = "INSERT INTO orders (customer_id, pet_id, quantity, price, grand_total) VALUES ('$customer_id', '$pet_id', '$quantity', '$price', '$grand_total')";
    mysqli_query($conn, $order_query);
    
    // Close connection
    mysqli_close($conn);
    
    // Redirect to confirmation page
    header("Location: ./confirmation.php");
    exit;
    }
    else{
        $error="Quantity out of stock";
    }
            }
        }    
    
        ?>




<div class="description-form">
    <p class="mesg">Customer details</p>
    <div class="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="post" autocomplete="off">
    <input type="hidden" name="action" value="order">

        <div class="row">
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <label for="number">Number</label>
            <input type="text" id="number" placeholder="Number" name="number">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" placeholder="Address" name="address">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" autocomplete="new-password" name="email">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" placeholder="Quantity" name="quantity">
        </div>
    </div>

    <button type="submit">Order now</button>
</div>
</form>

   
 

<script>
    document.getElementById("email").value = "";

</script>


</body>
</html>