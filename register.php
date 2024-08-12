<?php
include 'config/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <style>
        .error-message {
            color: #b71c1c;
            background-color: #ffebee;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #b71c1c;
        }

        .success-message {
            color: #1b5e20;
            background-color: #e8f5e9;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #1b5e20;
        }

    </style>
</head>

<body>
    <section class="sign-in">
        <article class="sign-in__details">
            <h1>Sign Up</h1>
            <p>Fill in the form below to create your account</p>
            <!-- Display error/success messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="error-message">
                    <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php elseif (isset($_SESSION['message-success'])): ?>
                <div class="success-message">
                    <?= $_SESSION['message-success']; unset($_SESSION['message-success']); ?>
                </div>
            <?php endif; ?>
            <form class="sign-in__form" action="register-logic.php" method="POST" enctype="multipart/form-data">
                <!-- Form fields -->
                <div class="form__control">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname" value="<?= isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '' ?>">
                </div>
                <div class="form__control">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname" value="<?= isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '' ?>">
                </div>
                <div class="form__control">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                </div>
                <div class="form__control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>
                <div class="form__control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="form__control">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                </div>
                <!-- Image upload field -->
                <div class="form__control">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
                <button class="btn google">
                    <img src="./assets/image/google.png" alt="Google-Logo">
                    <p>Sign up with Google</p>
                </button>
            </form>
            <small class="next__page">Already have an account? <a href="<?= ROOT_URL ?>login.php">Log In</a></small>
        </article>
    </section>

    <script>
        setTimeout(function() {
            const message = document.querySelector('.error-message, .success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>

</body>

</html>
