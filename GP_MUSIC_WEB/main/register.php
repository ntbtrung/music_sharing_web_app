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

if (isset($_POST['btn-register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra username và email trước khi thêm vào cơ sở dữ liệu
    $check_duplicate_sql = "SELECT * FROM user WHERE `username`= '$username' OR `email`='$email'";
    $result = $conn->query($check_duplicate_sql);

    if ($result->num_rows > 0) {
        // Nếu đã tồn tại username hoặc email, hiển thị thông báo lỗi
        echo '<script>alert("Username or email already exists. Please choose a different one.")</script>';
        echo '<script>window.location.href = "regis_login.html";</script>';
        exit();


    } else {
        // Nếu chưa tồn tại, thêm vào cơ sở dữ liệu
        $insert_sql = "INSERT INTO `user` (`username`, `email`, `password`)
               VALUES ('$username', '$email', MD5('$password'))";


        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("Register successful! Login Now")</script>';
            echo '<script>window.location.href = "regis_login.html";</script>';
            exit();
        } else {
            echo '<script>alert("Something wrong! Please re enter")</script>';
            echo '<script>window.location.href = "regis_login.html";</script>';
            exit();
        }
    }
}

?>