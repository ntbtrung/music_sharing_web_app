<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "music_web_db"; // Tên cơ sở dữ liệu MySQL

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Fail to connect to sever: " . $conn->connect_error);
}
echo '<script>alert("Connect to sever complete")</script>';


if (isset($_POST['btn-register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `user`(`username`,`email`,`password`)
    VALUES ('$username','$email', md5('$password'))";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Insert data complete")</script>';
    } else {
        echo "Error{$sql}" . $conn->error;
    }
}

?>