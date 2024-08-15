<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // Assuming the user is logged in and session is active
    $postText = $_POST['post_text'];
    $postImage = '';

    // Handle image upload
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === 0) {
        $imageName = time() . '_' . $_FILES['post_image']['name'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageName);

        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
            $postImage = $imageName;
        }
    }

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO posts (user_id, post_text, post_image, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $userId, $postText, $postImage);

    if ($stmt->execute()) {
        $postId = $stmt->insert_id;

        // Fetch the post to return as HTML
        $stmt = $conn->prepare("SELECT users.name, users.profile_photo, posts.* FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        // Generate post HTML
        $postHtml = '
            <div class="feed">
                <div class="head">
                    <div class="user">
                        <div class="profile-photo">
                            <img src="assets/images/' . htmlspecialchars($post['profile_photo']) . '" alt="">
                        </div>
                        <div class="info">
                            <h3>' . htmlspecialchars($post['name']) . '</h3>
                            <small>' . date('F j, Y, g:i a', strtotime($post['created_at'])) . '</small>
                        </div>
                    </div>
                </div>
                <div class="photo">
                    ' . (!empty($post['post_image']) ? '<img src="uploads/' . htmlspecialchars($post['post_image']) . '" alt="">' : '') . '
                </div>
                <div class="caption">
                    <p><b>' . htmlspecialchars($post['name']) . '</b> ' . htmlspecialchars($post['post_text']) . '</p>
                </div>
            </div>';
        
        // Return the HTML as a response
        echo $postHtml;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
