<?php
// Include database connection and start session
require 'config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$themeMode = 'light'; // Default theme mode

if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];

    // Fetch the theme mode from the database
    $query = "SELECT theme_mode FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($themeMode);
    $stmt->fetch();
    $stmt->close();
}

// Set profile image path
$profileImage = ROOT_URL . 'assets/image/default.png'; // Default profile image

if ($isLoggedIn && !empty($_SESSION['profile_image'])) {
    // If the user is logged in and has a profile image, use it
    $profileImage = ROOT_URL . 'assets/uploads/' . $_SESSION['profile_image'];
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?= htmlspecialchars($themeMode) ?>">

<!-- <html lang="en"> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social App</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/style.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>

    <!-- ========================================================================== -->
    <nav>
        <div class="container">
            <h2 class="logo">Social App</h2>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Search for creators, inspirations & projects">
            </div>
            <div class="create">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= ROOT_URL ?>logout.php" class="btn btn-primary">Logout</a>
                <?php else: ?>
                    <a href="<?= ROOT_URL ?>login.php" class="btn btn-primary">Login</a>
                <?php endif; ?>
                
                <div class="profile-photo">
                    <img src="<?= $profileImage ?>" alt="Profile Image">
                </div>
            </div>
        </div>
    </nav>
    <!-- ========================================================================== -->
