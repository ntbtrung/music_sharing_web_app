<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle avatar upload
    if (isset($_FILES["avatar"])) {
        $avatarDir = "uploads/avatars/";
        $avatarPath = $avatarDir . basename($_FILES["avatar"]["name"]);

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatarPath)) {
            echo "Avatar uploaded successfully.";
        } else {
            echo "Error uploading avatar.";
        }
    }

    // Handle background image upload
    if (isset($_FILES["background"])) {
        $backgroundDir = "uploads/backgrounds/";
        $backgroundPath = $backgroundDir . basename($_FILES["background"]["name"]);

        if (move_uploaded_file($_FILES["background"]["tmp_name"], $backgroundPath)) {
            echo "Background image uploaded successfully.";
        } else {
            echo "Error uploading background image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Avatar and Background</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="avatar">Select Avatar:</label>
        <input type="file" name="avatar" id="avatar" accept="image/*" required>
        <br>
        <label for="background">Select Background Image:</label>
        <input type="file" name="background" id="background" accept="image/*" required>
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
