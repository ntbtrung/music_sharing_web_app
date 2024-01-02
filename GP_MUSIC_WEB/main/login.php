<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "music_server"; // Tên cơ sở dữ liệu MySQL

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Fail to connect to sever: " . $conn->connect_error);
}
echo '<script>alert("Connect to sever complete")</script>';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-login"])) {
    // Nhận dữ liệu từ form
    $username = htmlspecialchars($_POST["username_lg"]);
    $password = htmlspecialchars($_POST["password_lg"]);

    // Kiểm tra đăng nhập
    $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        echo "Login successful!";
        // Redirect hoặc thực hiện các hành động khác ở đây
    } else {
        // Đăng nhập không thành công
        echo "Login failed. Please check your username and password.";
    }
}

// Đóng kết nối
$conn->close();
?>