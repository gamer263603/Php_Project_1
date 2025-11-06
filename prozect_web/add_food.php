<?php
include 'includes/db.php';

if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $desc = $_POST['description'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($tmp, "uploads/$image");

  mysqli_query($conn, "INSERT INTO foods (name, price, image, description)
    VALUES ('$name', '$price', '$image', '$desc')");
  header("Location: dashboard.php");
}
?>

<form method="POST" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Food Name" required>
  <input type="number" name="price" placeholder="Price" required>
  <textarea name="description" placeholder="Description"></textarea>
  <input type="file" name="image" required>
  <button type="submit" name="add">Add Food</button>
</form>
