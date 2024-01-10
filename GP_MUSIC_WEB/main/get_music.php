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

// Thực hiện truy vấn cơ sở dữ liệu để lấy danh sách nhạc
$sql = "SELECT * FROM song";
$result = $conn->query($sql);

// Hiển thị danh sách nhạc
while ($row = $result->fetch_assoc()) {
    echo "<div class='sound-items'>";
    echo "<img class='sound-item-avt' src='{$row['avatar_music_url']}'>";
    echo "<div class='sound-item-name'>{$row['name']}</div>";
    echo "<div class='sound-item-singer'>{$row['Artis']}</div>";
    echo "<audio controls>";
    echo "<source src='{$row['url']}' type='audio/mp3'>";
    echo "Your browser does not support the audio element.";
    echo "</audio>";
    echo "</div>";
}


// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>