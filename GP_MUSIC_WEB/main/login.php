<?php
$servername = "localhost"; // MySQL server address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "music_server"; // MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed to connect to the server: " . $conn->connect_error);
}

session_start();

if (isset($_POST['btn-login'])) {
    $username = $_POST['username_lg'];
    $password = $_POST['password_lg'];

    $hashed_password = md5($password);

    $login_sql = "SELECT * FROM user WHERE `username` ='$username' AND `password`='$hashed_password'";
    $result = $conn->query($login_sql);

    if ($result->num_rows > 0) {
        // Successful login, save user information in session
        $user_data = $result->fetch_assoc();
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        // Additional user information can be saved in session if needed

        // Display alert for successful login
        echo '<script>alert("Login successful")</script>';

        // Redirect to the main page after successful login
        echo '<script>window.location.href = "home.html";</script>';
        exit();
    } else {
        // Failed login, display error message and redirect to regis_login.html
        echo '<script>alert("Invalid username or password")</script>';
        echo '<script>window.location.href = "regis_login.html";</script>';
        exit();
    }
}
?>
