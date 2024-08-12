<?php
// Include database connection and start session
require 'config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

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
                    <div class="profile-photo">
                        <img src="<?= ROOT_URL . $_SESSION['profile_image'] ?>" alt="Profile Image">
                    </div>
                <?php else: ?>
                    <a href="<?= ROOT_URL ?>login.php" class="btn btn-primary">Login</a>
                    <div class="profile-photo">
                        <img src="<?= ROOT_URL ?>assets/images/default-profile.jpg" alt="Default Profile Image">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- ========================================================================== -->
