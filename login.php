<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $response['message'] = "Please enter both username and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Login successful
                // In a real application, you'd start a session here
                // For this beginner project, we'll just indicate success
                $response['success'] = true;
                $response['message'] = "Login successful! Welcome " . $username . ".";
                // You might also return user_id here for frontend use
                // $_SESSION['user_id'] = $user['id'];
            } else {
                $response['message'] = "Incorrect password.";
            }
        } else {
            $response['message'] = "Username not found.";
        }
        $stmt->close();
    }
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>