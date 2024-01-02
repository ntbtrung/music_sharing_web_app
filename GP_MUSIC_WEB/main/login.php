<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "music_server"; // Tên cơ sở dữ liệu MySQL

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Fail to connect to server: " . $conn->connect_error);
}
echo '<script>alert("Connect to server complete")</script>';

session_start();

if (isset($_POST['btn-login'])) {
    $username = $_POST['username_lg'];
    $password = $_POST['password_lg'];

    $hashed_password = md5($password);

    $login_sql = "SELECT * FROM user WHERE username`='$username' AND password`='$hashed_password'";
    $result = $conn->query($login_sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, lưu thông tin người dùng vào session
        $user_data = $result->fetch_assoc();
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        // Có thể lưu thêm thông tin khác vào session nếu cần

        // Redirect đến trang chính sau khi đăng nhập thành công
        header("Location: home.html");
        exit();
    } else {
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        echo '<script>alert("Invalid username or password")</script>';
    }
}
?>