<?php
session_start();
include("includes/db.php");
include("includes/header.php");


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    // $password = md5($_POST['password']);
    $password = $_POST['password'];


    $query = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: /prozect_web/dashboard.php");
    } else {
        $error = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- ✅ Add CSS here -->
    <link rel="stylesheet" href="admin/admin-style.css">

    <style>
        /* You can also add small inline styles */
        .login-box {
            width: 350px;
            margin: 120px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.2);
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
        }
        button {
            width: 95%;
            padding: 10px;
            font-size: 18px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 6px;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
