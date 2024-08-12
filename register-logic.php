<?php
require_once 'config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check for empty fields
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = 'Please fill in all fields.';
        header("Location: register.php");
        exit();
    }

    // Validate password
    if ($password !== $confirm_password) {
        $_SESSION['message'] = 'Passwords do not match.';
        header("Location: register.php");
        exit();
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile image upload
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $img_dir = 'assets/uploads/';
        $img_name = time() . '_' . basename($_FILES["profile_image"]["name"]);
        $img_file = $img_dir . $img_name;
        $imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            $_SESSION['message'] = 'Invalid file type. Please upload an image file (jpg, jpeg, png, gif).';
            header("Location: register.php");
            exit();
        }

        // Validate file size (max 2MB)
        if ($_FILES['profile_image']['size'] > 2000000) {
            $_SESSION['message'] = 'File size exceeds the 2MB limit.';
            header("Location: register.php");
            exit();
        }

        // Move file to the uploads directory
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $img_file)) {
            $profile_image = $img_name; // Store the file name to save in the database
        } else {
            $_SESSION['message'] = 'Failed to upload image.';
            header("Location: register.php");
            exit();
        }
    }

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $hashed_password, $profile_image);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $_SESSION['message-success'] = 'Registration successful! You can now log in.';
        header("Location: login.php");
    } else {
        $_SESSION['message'] = 'Registration failed: ' . $stmt->error;
        header("Location: register.php");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
