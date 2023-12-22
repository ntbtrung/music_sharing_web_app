<?php
// php/upload_avatar.php
if (isset($_FILES['avatar'])) {
    $file_name = $_FILES['avatar']['name'];
    $tmp_name = $_FILES['avatar']['tmp_name'];

    // Upload file to the 'photo' directory
    move_uploaded_file($tmp_name, "../photo/avatars/" . $file_name);

    // Save file name to the database (Update or Insert, depending on your logic)
    // You can use the existing CRUD operations for this purpose

    // Return the uploaded file name
    echo $file_name;
}
?>
