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

// Handle search query
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchTerm = $_GET["search"];

    // Execute the query to search for music by name
    $sql = "SELECT * FROM library WHERE name LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    $searchResults = array();

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = array(
                'name' => $row["name"],
                'Artis' => $row["Artis"],
                'avatar_music_url' => $row["avatar_music_url"],
                'url' => $row["url"]
            );
        }
    }

    // Trả về kết quả dưới dạng JSON
    echo json_encode($searchResults);
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>