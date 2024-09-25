<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/css/index.css">
    <link rel="stylesheet" href="../Assets/css/popup.css">
    <link rel="stylesheet" href="../Assets/css/pet_description.css">
    <link rel="stylesheet" href="../Assets/css/cards.css">

</head>
<body>

<?php  



require './connectdb.php';

$pet_id = $_GET['pet_id'];

// Query database for product details
$query = "SELECT * FROM alllpets WHERE id = '$pet_id'";
$result = mysqli_query($conn, $query);
$product_row = mysqli_fetch_assoc($result);

session_start();
$_SESSION['pet_id']=$pet_id;
$_SESSION['price']=$product_row['price'];
$_SESSION['quantity']=$product_row['quantity'];

// Query database for product image
$image_query = "SELECT path FROM pictures WHERE pet_id = '$pet_id'";
$image_result = mysqli_query($conn, $image_query);
$image_row = mysqli_fetch_assoc($image_result);
$error="";


mysqli_close($conn);

require './loader.html';
?>



<?php
    require './navbar.php';
    ?>




<?php

require './connectdb.php';

if (isset($_POST['search'])) {
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

?>

<section class="product_details">
    <img src="<?php echo $image_row['path']; ?>" alt="<?php echo $product_row['name']; ?>">
    <div class="product_box">
        <p>Pet name: <?php echo $product_row['name']; ?></p>
        <p>Price: $<?php echo $product_row['price']; ?></p>
        <p>Quantity: <?php echo $product_row['quantity']; ?></p>
        <p>Description: <?php echo $product_row['description']; ?></p>
        <button onclick="move()">Order now</button>
    </div>
</section>

<script src="../Assets/js/index.js"></script>

</body>
</html>