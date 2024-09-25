<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="../Assets/css/login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>

      <?php

require './loader.html';
$error="";
// Check if form is submitted
require "./connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $address = $_POST['address'];
   $role = $_POST['role'];
   
   if ($role=="customer"){
     
   // Get the max ID in the suppliers table
   $query = "SELECT MAX(id) as max_id FROM customers";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $max_id = $row['max_id'] + 1;
   
   // Insert a new supplier into the suppliers table
   $query = "INSERT INTO customers (id, name, number, email, password, address) VALUES ('$max_id', '$name', '$number', '$email', '$password', '$address')";
   mysqli_query($conn, $query);
   
   mysqli_close($conn);
   header("Location: login.php");
ext();
 
   }else{
      
   // Get the max ID in the suppliers table
   $query = "SELECT MAX(id) as max_id FROM sellers";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $max_id = $row['max_id'] + 1;
   
   // Insert a new supplier into the suppliers table
   $query = "INSERT INTO sellers (id, name, number, email, password, address) VALUES ('$max_id', '$name', '$number', '$email', '$password', '$address')";
   mysqli_query($conn, $query);
   
   mysqli_close($conn);
   header("Location: login.php");
      exit();
   
}
}      
?>
      
      

      <div class="center">
         <div class="container container2">
            <div class="error"> <?php echo $error ?> </div>
            <div class="text">
              Please Signup here
            </div>
            <form  method="post" class="form2">
         

            <div class="data">
                  <input type="text" required name="name" placeholder="Name">
               </div>
               <div class="data">
                  <input type="number" required name="number" placeholder="Number">
               </div>
          
               <div class="data">
                  <input type="text" required name="address" placeholder="Address">
               </div>
          

         
                <div class="data">
                  <input type="email" required name="email" placeholder="Email">
               </div>
               <div class="data">
                  <input type="password" placeholder="Password" required name="password">
               </div>
               <div class="data">
        <select name="role" required>
            <option disable>Select role</option>
            <option value="seller">Seller</option>
            <option value="customer">Customer</option>
        </select>
    </div>

                <div class="btn">
                  <div class="inner"></div>
                  <button type="submit">Signup</button>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>