<?php
require 'config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $theme = $data['theme'];

        // Log received data for debugging
        error_log("Received theme: $theme for user ID: $userId");

        $query = "UPDATE users SET theme_mode = ? WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('si', $theme, $userId);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
                error_log("Theme updated successfully.");
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
                error_log("Database update failed: " . $stmt->error);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed.']);
            error_log("Statement preparation failed: " . $conn->error);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        error_log("User not logged in.");
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
}
