<?php
require_once "connect.php";
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'online_book_store';

$conn = mysqli_connect($host, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["new-username"];
    $password = $_POST["new-password"];

    $query = "SELECT user_id FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $user = $stmt->get_result();

    if ($user) {
        
        header("Location: home.html");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>


