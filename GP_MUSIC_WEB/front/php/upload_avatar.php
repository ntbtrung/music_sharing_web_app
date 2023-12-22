<?php
   // php/upload_avatar.php
   require("config.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['avatar'])) {
       $file_name = $_FILES['avatar']['name'];
       $tmp_name = $_FILES['avatar']['tmp_name'];

       // Upload file to the 'photo/avatars' directory
       move_uploaded_file($tmp_name, "../photo/avatars/" . $file_name);

       // Update or Insert logic for saving file name to the 'user' table
       // Example: $user_id = 1; // Replace with the actual user ID
       // $update_query = "UPDATE user SET avatar='$file_name' WHERE id=$user_id";
       // $result = mysqli_query($conn, $update_query);

       // Redirect back to index.php after successful upload
       header("Location: /profile.php");
       exit();
   } else {
       // Handle errors or redirect back to index.php with an error message
       header("Location:/profile.php?error=1");
       exit();
   }
   ?>