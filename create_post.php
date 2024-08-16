<?php
session_start();
include 'config/database.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // Assuming the user is logged in and session is active
    $postText = filter_var($_POST['post_text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $postImage = '';

    // Handle image upload
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === 0) {
        $originalFileName = $_FILES['post_image']['name'];
        $sanitizedFileName = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $originalFileName); // Sanitize the filename
        $imageName = time() . '_' . $sanitizedFileName;
        $targetDir = "assets/uploads/posts/";
        $targetFile = $targetDir . basename($imageName);

        // Validate the image type using the MIME type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $detectedType = mime_content_type($_FILES['post_image']['tmp_name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Log detected type and file extension for debugging
        error_log("Detected MIME Type: " . $detectedType);
        error_log("File Extension: " . $imageFileType);

        // Perform validation checks
        if (in_array($detectedType, $allowedTypes) && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Check file size (max 5MB)
            if ($_FILES['post_image']['size'] <= 5_000_000) {
                if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
                    $postImage = $imageName;
                } else {
                    echo json_encode([
                        'success' => false,
                        'error' => "Failed to upload image."
                    ]);
                    exit();
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'error' => "Image size should be less than 5MB."
                ]);
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'error' => "Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed."
            ]);
            exit();
        }
    }

    if ($postImage !== '' || $postText !== '') {
        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO posts (user_id, post_text, post_image, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $userId, $postText, $postImage);

        if ($stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => "Post created successfully."
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => "Database error: " . $stmt->error
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => "Post content cannot be empty."
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => "Invalid request method."
    ]);
}
?>
