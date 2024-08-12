<?php
// Include database connection
require_once 'config/database.php';

// Initialize a session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $login = trim(htmlspecialchars($_POST['login']));
    $password = trim($_POST['password']);

    // Prepare SQL statement to check user by email or username
    $stmt = $conn->prepare("SELECT id, firstname, lastname, username, email, password, profile_image FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $login, $login);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user data in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['profile_image'] = $user['profile_image'];

            // Redirect to a protected page
            header('Location: '. ROOT_URL.'home.php');
            exit();
        } else {
            $_SESSION['message'] = 'Invalid password. Please try again.';
        }
    } else {
        $_SESSION['message'] = 'No account found with that email or username.';
    }

    // Redirect back to the login page with error message
    header("Location: login.php");
    exit();
}
?>
