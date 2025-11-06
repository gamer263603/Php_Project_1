<?php
include 'includes/db.php';

if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $desc = $_POST['description'];

 

  mysqli_query($conn, "INSERT INTO foods (name, price, image, description)
    VALUES ('$name', '$price', '$image', '$desc')");
  header("Location: dashboard.php");
}
?>

<form method="POST" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Food Name" required>
  <input type="number" name="price" placeholder="Price" required>
  <textarea name="description" placeholder="Description"></textarea>
  <button type="submit" name="add">Add Food</button>
</form>
