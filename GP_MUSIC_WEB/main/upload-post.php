<?php
$uploadedMusic = false;
$uploadedImage = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if music file is uploaded
    if (isset($_FILES["music-post-upload"])) {
        $targetDir = "assets/post/audio/";
        $originalFileName = $_FILES["music-post-upload"]["name"];
        $targetFile = $targetDir . $originalFileName;

        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an MP3 file
        if ($fileType != "mp3") {
            echo "<script>alert('Only MP3 files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "<script>alert('File already exists.');</script>";
            $uploadOk = 0;
        }

        if ($_FILES["music-post-upload"]["size"] > 10 * 1024 * 1024) {
            echo "<script>alert('File is too large, please choose a file smaller than 10MB.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Your file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($_FILES["music-post-upload"]["tmp_name"], $targetFile)) {
                $uploadedMusic = true;
            } else {
                echo "<script>alert('There was an error uploading your file.');</script>";
            }
        }
    }
    
    if (isset($_FILES["img-post-upload"])) {
        $targetDirImage = "assets/post/image/";
        $originalFileNameImage = $_FILES["img-post-upload"]["name"];
        $targetFileImage = $targetDirImage . $originalFileNameImage;

        $uploadOkImage = 1;
        $allowedExtensions = array("jpg", "jpeg", "png");  // Add any other allowed extensions

        $fileTypeImage = strtolower(pathinfo($targetFileImage, PATHINFO_EXTENSION));

        // Check if the image file has a valid extension
        if (!in_array($fileTypeImage, $allowedExtensions)) {
            echo "<script>alert('Only JPG, JPEG, and PNG images are allowed.');</script>";
            $uploadOkImage = 0;
        }

        // Check if the image file already exists
        if (file_exists($targetFileImage)) {
            echo "<script>alert('Image file already exists.');</script>";
            $uploadOkImage = 0;
        }

        // Check the image file size (limit to 5MB, adjust as needed)
        if ($_FILES["img-post-upload"]["size"] > 5 * 1024 * 1024) {
            echo "<script>alert('Image file is too large, please choose a file smaller than 5MB.');</script>";
            $uploadOkImage = 0;
        }

        // If everything is OK, try to upload the image file
        if ($uploadOkImage == 0) {
            echo "<script>alert('Your image file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($_FILES["img-post-upload"]["tmp_name"], $targetFileImage)) {
                $uploadedImage = true;
            } else {
                echo "<script>alert('There was an error uploading your image file.');</script>";
            }
        }
    }

    // Display appropriate alert messages
    if ($uploadedMusic && $uploadedImage) {
        echo "<script>alert('Music and image have been uploaded successfully.');</script>";
    } elseif ($uploadedMusic) {
        echo "<script>alert('Music has been uploaded successfully.');</script>";
    } elseif ($uploadedImage) {
        echo "<script>alert('Image has been uploaded successfully.');</script>";
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
    }
}
?>
<?php
// Connect to the database
$servername = "localhost"; // MySQL server address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "music_server"; // MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption = $_POST["caption-upload"];
    $image_url = "assets/post/image/" . $_FILES["img-post-upload"]["name"];
    $audio_url = "assets/post/audio/" . $_FILES["music-post-upload"]["name"];

    // Execute the query to insert data into the 'song' table
    $sql = "INSERT INTO post_status (caption, image_url, audio_url) VALUES ('$caption','$image_url', '$audio_url')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data inserted successfully.');</script>";
    } else {
        echo "<script>alert('Error inserting data: " . $conn->error . "');</script>";
    }
}
echo '<script>window.location.href = "home.html";</script>';


// Close the connection
$conn->close();
?>