<?php
// Step 1: Define fields dynamically
$fields = [
    "name" => "text",
    "email" => "email",
    "password" => "password",
    "mobile" => "text",
    "gender" => "dropdown",
    "hobbies" => "checkbox"
];

$errors = [];
$data = [];

// Step 2: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($fields as $field => $type) {
        if (isset($_POST[$field])) {
        if (is_array($_POST[$field])) {
            $value = $_POST[$field];  // array for checkboxes
        } else {
            $value = trim($_POST[$field]);
        }
    } else {
        $value = "";
    }


        switch ($field) {
            case "name":
                if (empty($value) || !preg_match("/^[a-zA-Z ]+$/", $value)) {
                    $errors[$field] = "Enter a valid name (letters only)";
                } else {
                    $data[$field] = $value;
                }
                break;

            case "email":
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "Enter a valid email address";
                } else {
                    $data[$field] = $value;
                }
                break;

            case "password":
                if (strlen($value) < 6) {
                    $errors[$field] = "Password must be at least 6 characters";
                } else {
                    $data[$field] = $value;
                }
                break;

            case "mobile":
                if (!preg_match("/^[0-9]{10}$/", $value)) {
                    $errors[$field] = "Enter a valid 10-digit mobile number";
                } else {
                    $data[$field] = $value;
                }
                break;

            case "gender":
                if (empty($value)) {
                    $errors[$field] = "Select a gender";
                } else {
                    $data[$field] = $value;
                }
                break;

            case "hobbies":
                if (empty($_POST["hobbies"])) {
                    $errors[$field] = "Select at least one hobby";
                } else {
                    $data[$field] = implode(", ", $_POST["hobbies"]);
                }
                break;
        }
    }

    // Step 3: If no errors, store in file
    if (empty($errors)) {
        $file = fopen("responses.txt", "a");
        fwrite($file, json_encode($data) . PHP_EOL);
        fclose($file);
        echo "<p style='color:green;'>Form submitted successfully!</p>";
    }
}
?>

<!-- Step 4: Dynamic Form HTML -->
<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>">
    <span style="color:red;"><?= $errors['name'] ?? '' ?></span>
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
    <span style="color:red;"><?= $errors['email'] ?? '' ?></span>
    <br><br>

    <label>Password:</label>
    <input type="password" name="password">
    <span style="color:red;"><?= $errors['password'] ?? '' ?></span>
    <br><br>

    <label>Mobile:</label>
    <input type="text" name="mobile" value="<?= $_POST['mobile'] ?? '' ?>">
    <span style="color:red;"><?= $errors['mobile'] ?? '' ?></span>
    <br><br>

    <label>Gender:</label>
    <select name="gender">
        <option value="">--Select--</option>
        <option value="Male" <?= (($_POST['gender'] ?? '') == 'Male') ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= (($_POST['gender'] ?? '') == 'Female') ? 'selected' : '' ?>>Female</option>
    </select>
    <span style="color:red;"><?= $errors['gender'] ?? '' ?></span>
    <br><br>

    <label>Hobbies:</label>
    <input type="checkbox" name="hobbies[]" value="Reading" <?= (in_array("Reading", $_POST['hobbies'] ?? [])) ? 'checked' : '' ?>> Reading
    <input type="checkbox" name="hobbies[]" value="Sports" <?= (in_array("Sports", $_POST['hobbies'] ?? [])) ? 'checked' : '' ?>> Sports
    <input type="checkbox" name="hobbies[]" value="Music" <?= (in_array("Music", $_POST['hobbies'] ?? [])) ? 'checked' : '' ?>> Music
    <span style="color:red;"><?= $errors['hobbies'] ?? '' ?></span>
    <br><br>

    <input type="submit" value="Submit">
</form>
