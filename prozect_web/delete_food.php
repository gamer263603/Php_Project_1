<?php
include 'includes/db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM foods WHERE id=$id");
header("Location: dashboard.php");
?>
