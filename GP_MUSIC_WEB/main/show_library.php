<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // MySQL server address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "music_server"; // MySQL database name


$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng library
$sql = "SELECT * FROM library";
$result = $conn->query($sql);

// Hiển thị dữ liệu trong trang HTML
if ($result->num_rows > 0) {
    $id = 1; // Bắt đầu từ 1

    while ($row = $result->fetch_assoc()) {
        echo '<div class="playlist-items" onclick="playMusic(' . $id . ')">';
        echo '<img src="' . $row['avatar_music_url'] . '" class="playlist-item-avt">';
        echo '<div class="playlist-item-name">' . $row['name'] . '</div>';
        echo '<div class="playlist-item-singer">' . $row['Artis'] . '</div>';
        echo '</div>';

        $id++; // Tăng giá trị của biến id sau mỗi lần sử dụng
        if ($id > 50) {
            break; // Thoát khỏi vòng lặp khi id vượt quá 10
        }
    }
} else {
    echo "0 results";
}
// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>