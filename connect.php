<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'online_book_store';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new-username']) && isset($_POST['new-email']) && isset($_POST['new-password'])) {
        $newUsername = $_POST['new-username'];
        $newEmail = $_POST['new-email'];
        $newPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $newUsername, $newEmail, $newPassword);
            if (mysqli_stmt_execute($stmt)) {
                echo "Registered successfully!";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);

?>