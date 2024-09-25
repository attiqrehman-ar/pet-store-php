<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PETS</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="../Assets/css/cards.css">
    <link rel="stylesheet" href="../Assets/css/form.css">
    <link rel="stylesheet" href="../Assets/css/index.css">

</head>
<body>
    <?php
    require './loader.html';
    require './navbar.php';

    ?>

    <div class="banner-container">
        <h1>Welcome, we have 
            <span class="typing">  </span> 
        </h1>
        <p>We're passionate about connecting pet enthusiasts and facilitating seamless buying and selling experiences. Whether you're looking to bring a new furry friend home or find a loving owner for your cherished pet, our platform is designed to make your journey effortless and enjoyable.
        <!-- <button>Contact Us</button> -->
    </div>


    
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

    echo ' <div class="pets" id="pets"> 
            <p class="pp">All Available Pets</p> 
            <div class="card-list">';
    
    require 'connectdb.php';
    
    // Pagination variables
    $limit = 5; // Number of items per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    
    // Query to fetch project names and corresponding image paths
    $sqlPets = "SELECT p.id AS pet_id, p.price as price, p.name AS pet_name, pic.path AS image_path
                        FROM alllpets p
                        INNER JOIN pictures pic ON p.id = pic.pet_id
                        GROUP BY p.id 
                     LIMIT $limit OFFSET $offset "; 
                     
    
    // Total count query
    $sqlCount = "SELECT COUNT(*) AS total FROM alllpets";
    
    $resultPets = $conn->query($sqlPets);
    $resultCount = $conn->query($sqlCount);
    $total = $resultCount->fetch_assoc()['total'];
    
    // Check if there are any projects
    if ($resultPets->num_rows > 0) {
        // Output each project dynamically
        while ($rowPets = $resultPets->fetch_assoc()) {
            echo '<a href="pet_description.php?pet_id=' . $rowPets['pet_id'] . '" class="card-item animate-left">';
            echo '<img src="' . $rowPets['image_path'] . '" alt="Card Image" >';
            echo '<h3>' . $rowPets['pet_name'] . '</h3>';
            echo '<h6> Price: $' . $rowPets['price'] . '</h6>';
            echo '<div class="arrow">Details</div>';
            echo '</a>';
        }
    } else {
        echo 'No Pet Available right now.';
    }
    echo '</div></div>';
    ?>
    </div>

    <?php
    // Pagination links
    $pages = ceil($total / $limit);
    echo '<div class="pagination">';
    for ($i = 1; $i <= $pages; $i++) {
        echo '<a href="?page=' . $i . '" class="' . ($page == $i ? 'active' : '') . '">' . $i . '</a>';
    }
    echo '</div>';

// Close the database connection
// $conn->close();
?>
<footer>
    &copy; All rights reserved
</footer>
<script src="../Assets/js/index.js"></script>
</body>
</html>
