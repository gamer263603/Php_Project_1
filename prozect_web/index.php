<?php
include("includes/db.php");
include("includes/header.php");
?>

<h2>Our Menu</h2>

<div class="menu-container">
<?php
$sql = "SELECT * FROM foods";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){

        // ✅ Show placeholder image if none exists
        // $image = $row['image'] ? $row['image'] : "placeholder.png";

        echo "
        <div class='menu-card'>
            
            <h3>{$row['name']}</h3>
            <p>₹{$row['price']}.00</p>
        </div>";
    }
} else {
    echo "<p>No food items found.</p>";
}
?>
</div>

<?php include("includes/footer.php"); ?>
