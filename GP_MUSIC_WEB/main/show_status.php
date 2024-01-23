<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_server";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM post_status";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post-item'>";
        echo "<div class='post-title-item'>";
        echo "<img src='assets/icons/intersect.svg' alt='' class='post-avatar'>";
        echo "<div class='post-text' style='color: black;font-size: 14px;'> Do Thanh Vinh</div>";
        echo "</div>";
        echo "<div class='post-main-item'>";
        echo "<div class='post-caption'>" . $row['caption'] . "</div>";
        echo "<img src='" . $row['image_url'] . "' alt='' class='post-img'>";
        echo "<audio controls src='". $row['audio_url'] ."' >";
        echo "</div>";
        echo "<div class='post-emotion-item'>";
        echo "<div class='btn-emotion text-center'>";
        echo "<img src='assets/icons/heart.svg' alt='' class='icon-emotion  heart-icon'>" ;
        echo "</div>";
        echo "<div class='btn-emotion text-center'>";
        echo "<img src='assets/icons/comment.svg' alt='' class='icon-emotion '>";
        echo "</div>";
        echo "<div class='btn-emotion text-center'>";
        echo "<img src='assets/icons/share.svg' alt='' class='icon-emotion '>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }
}


$conn->close();
?>