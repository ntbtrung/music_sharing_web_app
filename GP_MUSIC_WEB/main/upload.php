<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file-music-upload"])) {
    $targetDir = "assets/upload/musics/";
    $originalFileName = $_FILES["file-music-upload"]["name"];
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

    // Check the file size (limit to 10MB)
    if ($_FILES["file-music-upload"]["size"] > 10 * 1024 * 1024) {
        echo "<script>alert('File is too large, please choose a file smaller than 10MB.');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0
    if ($uploadOk == 0) {
        echo "<script>alert('Your file was not uploaded.');</script>";
    } else {
        // If everything is OK, try to upload the file
        if (move_uploaded_file($_FILES["file-music-upload"]["tmp_name"], $targetFile)) {
            echo "<script>alert('File " . $originalFileName . " has been uploaded successfully.');</script>";
        } else {
            echo "<script>alert('There was an error uploading your file.');</script>";
        }
    }
} else {
    // If not a POST request or no file selected
    echo "<script>alert('Please select an MP3 file to upload.');</script>";
}
?>