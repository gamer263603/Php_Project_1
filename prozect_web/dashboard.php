<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}
include("includes/header.php");
include("includes/db.php");

?>

<a href="add_food.php">Add New Food</a>
<h2>Food List</h2>

<table border="1">
<tr><th>Image</th><th>Name</th><th>Price</th><th>Action</th></tr>
<?php
$result = mysqli_query($conn, "SELECT * FROM foods");
while ($row = mysqli_fetch_assoc($result)) {
echo "
<tr>
<td><img src='uploads/<?php echo $row["image"]; ?>' width='60' height='60'></td>
<td>$row[name]</td>
<td>₹$row[price]</td>
<td>
<a href='edit_food.php?id=$row[id]'>Edit</a> |
<a href='delete_food.php?id=$row[id]'>Delete</a>
</td>
</tr>
";
}
?>
</table>
