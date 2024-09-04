<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // Database username
$password = "";      // Database password
$dbname = "users"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered.']);
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_username, $user_email, $user_password);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
        }
    }

    $stmt->close();
}

$conn->close();
?>
