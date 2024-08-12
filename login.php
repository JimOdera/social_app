<?php
    include 'config/database.php';

    // Start session if not started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Fetch the error message if it exists
    $errorMessage = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    unset($_SESSION['message']); // Clear the message after displaying
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <style>
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 10px;
            display: none; /* Hidden by default */
        }
    </style>
</head>

<body>
    <section class="sign-in">
        <article class="sign-in__details">
            <h1>Sign In</h1>
            <p>Log in to your account using your credentials</p>
            <?php if ($errorMessage): ?>
                <div class="error-message">
                    <?= $errorMessage ?>
                </div>
            <?php endif; ?>
            <form class="sign-in__form" method="POST" action="login-logic.php">
                <div class="form__control">
                    <label for="login">Email or Username</label>
                    <input type="text" name="login" id="login" placeholder="Enter your email or username" required>
                </div>
                <div class="form__control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="sign-in__extras">
                    <div>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary">Sign In</button>
                <button class="btn google">
                    <img src="./assets/image/google.png" alt="Google-Logo">
                    <p>Sign in with Google</p>
                </button>
            </form>
            <small class="next__page">Don't have an account? <a href="<?= ROOT_URL ?>register.php">Sign Up</a></small>
        </article>
    </section>

    <script>
        // Show the error message and hide it after 3 seconds
        const errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.style.display = 'block';
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    </script>
</body>

</html>
