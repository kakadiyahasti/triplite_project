<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // In a real application, user_id would come from a session
    $user_id = $conn->real_escape_string($_POST['user_id']);
    $package_id = $conn->real_escape_string($_POST['package_id']);
    $travel_date = $conn->real_escape_string($_POST['travel_date']);
    $num_travelers = $conn->real_escape_string($_POST['num_travelers']);

    // Basic validation
    if (empty($user_id) || empty($package_id) || empty($travel_date) || empty($num_travelers)) {
        $response['message'] = "All booking fields are required.";
    } else if (!is_numeric($num_travelers) || $num_travelers < 1) {
        $response['message'] = "Number of travelers must be at least 1.";
    } else {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, package_id, travel_date, num_travelers) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $user_id, $package_id, $travel_date, $num_travelers);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Booking confirmed! We'll contact you shortly.";
        } else {
            $response['message'] = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>