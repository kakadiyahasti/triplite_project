<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

$packages = [];

if (isset($_GET['id'])) {
    // Fetch a single package by ID
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM packages WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $packages = $result->fetch_assoc();
    }
} else {
    // Fetch all packages
    $sql = "SELECT * FROM packages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $packages[] = $row;
        }
    }
}

$conn->close();
echo json_encode($packages);
?>