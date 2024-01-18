
<?php
// // Connect to the database
// $servername = "localhost"; // MySQL server address
// $username = "root"; // MySQL username
// $password = ""; // MySQL password
// $dbname = "music_server"; // MySQL database name

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Handle data when the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $avt= "assets/upload/avatar-user/" . $_FILES["avatar"]["name"];
//     $cover_photo = "assets/upload/bg-user/" . $_FILES["cover_photo"]["name"];

//     // Execute the query to insert data into the 'song' table
//     $sql = "INSERT INTO user (avatar,cover_photo) VALUES ('$avt','$cover_photo')";

//     if ($conn->query($sql) === TRUE) {
//         echo "<script>alert('Apply successfully.');</script>";
//     } else {
//         echo "<script>alert('Error inserting data: " . $conn->error . "');</script>";
//     }
// }
// echo '<script>window.location.href = "profile.html";</script>';


// // Close the connection
// $conn->close();
?>