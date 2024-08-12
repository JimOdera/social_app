<?php
    include 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>
    <section class="sign-in">
        <article class="sign-in__details">
            <h1>Sign In</h1>
            <p>Log in to your account using your credentials</p>
            <form class="sign-in__form">
                <div class="form__control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="form__control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="sign-in__extras">
                    <div>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary">Sign In</button>
                <button class="btn google">
                    <img src="./assets/image/google.png" alt="Google-Logo">
                    <p>Sign in with Google</p>
                </button>
            </form>
            <small class="next__page">Don't have an account? <a href="<?= ROOT_URL ?>register.php">Sign Up</a></small>
        </article>
        <!-- <article class="sign-in__logo">
            <div>
                <img src="./assets//image/logo.png" alt="logo">
            </div>
        </article> -->
    </section>
</body>

</html>