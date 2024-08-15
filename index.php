<?php
    require 'config/database.php';
    include 'partials/header.php';

    // Check if the user is logged in
    if ($isLoggedIn) {
        $userId = $_SESSION['user_id'];

        // Fetch user details from the database
        $query = "SELECT firstname, lastname, username, profile_image FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName, $username, $profileImage);
        $stmt->fetch();
        $stmt->close();

        // Set profile image path
        $profileImagePath = !empty($profileImage) ? ROOT_URL . 'assets/uploads/' . $profileImage : ROOT_URL . 'assets/images/default-profile.jpg';
    }
?>

    <!-- ========================================================================== -->
    <main>
        <div class="container">
            <div class="left">
                <?php if ($isLoggedIn): ?>
                <a href="" class="profile">
                    <div class="profile-photo">
                        <img src="<?= htmlspecialchars($profileImagePath) ?>" alt="Profile Image">
                        <?php if ($isLoggedIn): ?>
                        <div class="active"></div>
                        <?php endif; ?>
                    </div>
                    <div class="handle">
                        <h4><?= htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName) ?></h4>
                        <p class="text-muted">@<?= htmlspecialchars($username) ?></p>
                    </div>
                </a>
                <?php endif; ?>
                <!-- ========================================================================== -->
                <div class="sidebar">
                    <a class="menu-item active">
                        <span><i class="uil uil-home"></i></span>
                        <h3>Home</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-compass"></i></span>
                        <h3>Explore</h3>
                    </a>
                    <a class="menu-item" id="notifications">
                        <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span>
                        <h3>Notifications</h3>
                        <!-- NOTIFICATION POPUP -->
                        <div class="notifications-popup">
                            <div class="notification">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-2.jpg" alt="">
                                </div>
                                <div class="notification-body">
                                    <h4>Iris West</h4>
                                    <p>Hey there! I just wanted to let you know about...</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-3.jpg" alt="">
                                </div>
                                <div class="notification-body">
                                    <h4>Iris West</h4>
                                    <p>Hey there! I just wanted to let you know about...</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-4.jpg" alt="">
                                </div>
                                <div class="notification-body">
                                    <h4>Iris West</h4>
                                    <p>Hey there! I just wanted to let you know about...</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-5.jpg" alt="">
                                </div>
                                <div class="notification-body">
                                    <h4>Iris West</h4>
                                    <p>Hey there! I just wanted to let you know about...</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="menu-item" id="messages-notifications">
                        <span><i class="uil uil-envelope-alt"><small class="notification-count">7</small></i></span>
                        <h3>Messages</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-bookmark"></i></span>
                        <h3>Bookmarks</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-chart-line"></i></span>
                        <h3>Analytics</h3>
                    </a>
                    <a class="menu-item choose-color" id="theme">
                        <span><i class="uil uil-palette"></i></span>
                        <h3>Theme (Light)</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-setting"></i></span>
                        <h3>Settings</h3>
                    </a>
                </div>
                <!-- ============================================== -->
                <label for="create-post" class="btn btn-primary">Create Post</label>
            </div>
            <div class="middle">
                <!-- STORIES -->
                <div class="stories">
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-8.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-9.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-10.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-11.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-12.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="assets/images/profile-13.jpg" alt="">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                </div>

                <!-- ============================ -->
                <form action="" class="create-post">
                    <div class="profile-photo">
                        <img src="assets/images/profile-1.jpg" alt="">
                    </div>
                    <input type="text" placeholder="What's on your mind, Diana" id="create-post">
                    <span><i class="uil uil-image-upload"></i></span>
                    <input type="submit" value="Post" class="btn btn-primary">
                </form>

                <!-- ======================== FEEDS ======================== -->
                <div class="feeds">
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-1.jpg" alt="">
                                    <div class="active"></div>
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-1.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-4.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-7.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-6.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-3.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-7.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-4.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-8.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-5.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== FEED ======================== -->
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="assets/images/profile-1.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h3>Iris West</h3>
                                    <small>Dubai, 15 MINUTES AGO</small>
                                </div>
                            </div>
                            <span class="edit">
                                <i class="uil uil-ellipsis-h"></i>
                            </span>
                        </div>
                        <!--  -->
                        <div class="photo">
                            <img src="assets/images/feed-6.jpg" alt="">
                        </div>
                        <!--  -->
                        <div class="action-buttons">
                            <div class="interaction-buttons">
                                <span><i class="uil uil-heart"></i></span>
                                <span><i class="uil uil-comment-dots"></i></span>
                                <span><i class="uil uil-share-alt"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark-full"></i></span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="liked-by">
                            <span><img src="assets/images/profile-10.jpg" alt=""></span>
                            <span><img src="assets/images/profile-4.jpg" alt=""></span>
                            <span><img src="assets/images/profile-15.jpg" alt=""></span>
                            <p>Liked by <b>Iris West</b> and <b>323 others</b></p>
                        </div>
                        <!--  -->
                        <div class="caption">
                            <p>
                                <b>Iris West</b> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates
                                illum a esse dolor <span class="hash-tag">#lifestyle</span>
                            </p>
                        </div>
                        <div class="comments text-muted">View all 277 comments</div>
                    </div>
                    <!-- ======================== END FEED ======================== -->
                </div>
                <!-- ======================== END FEEDS ======================== -->
            </div>

            <!-- ========================================================================== -->
            <div class="right">
                <!-- MESSAGES -->
                <div class="messages">
                    <div class="heading">
                        <h4>Messages</h4><i class="uil uil-edit"></i>
                    </div>
                    <!-- SEARCH BAR -->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" id="message-search" placeholder="Search messages">
                    </div>
                    <!-- MESSAGES CATEGORY -->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6>General</h6>
                        <h6 class="message-requests">Requests(9)</h6>
                    </div>
                    <!-- MESSAGE -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="assets/images/profile-17.jpg" alt="">
                        </div>
                        <div class="message-body">
                            <h5>John Doe</h5>
                            <p class="text-bold">Just woke up bruh!</p>
                        </div>
                    </div>
                    <!-- MESSAGE -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="assets/images/profile-9.jpg" alt="">
                        </div>
                        <div class="message-body">
                            <h5>Iris West</h5>
                            <p class="text-bold">Just woke up bruh!</p>
                        </div>
                    </div>
                    <!-- MESSAGE -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="assets/images/profile-15.jpg" alt="">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Allan Doe</h5>
                            <p class="text-muted">Just woke up bruh!</p>
                        </div>
                    </div>
                    <!-- MESSAGE -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="assets/images/profile-19.jpg" alt="">
                        </div>
                        <div class="message-body">
                            <h5>John Doe</h5>
                            <p class="text-muted">Just woke up bruh!</p>
                        </div>
                    </div>
                </div>
                <!-- END MESSAGES -->

                <!-- FRIEND REQUESTS -->
                <div class="friend-requests">
                    <h4>Requests</h4>
                    <!-- REQUEST -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="assets/images/profile-17.jpg" alt="">
                            </div>
                            <div>
                                <h5>Hajia Bintu</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!--  -->
                    <!-- REQUEST -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="assets/images/profile-17.jpg" alt="">
                            </div>
                            <div>
                                <h5>Hajia Bintu</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!--  -->
                    <!-- REQUEST -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="assets/images/profile-17.jpg" alt="">
                            </div>
                            <div>
                                <h5>Hajia Bintu</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!--  -->
                    <!-- REQUEST -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="assets/images/profile-17.jpg" alt="">
                            </div>
                            <div>
                                <h5>Hajia Bintu</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- ========================================================================== -->
        </div>
    </main>


    <!-- ================================================================================================= -->
     <div class="post-modal">
        <div class="card">
            <h2>Create Post</h2>

            <form action="" class="create-post">
                <div class="profile-photo">
                    <img src="assets/images/profile-1.jpg" alt="">
                </div>
                <input type="text" placeholder="What's on your mind, Diana" id="create-post">
            </form>

            <div class="image-upload">
                <span><i class="uil uil-image-upload"></i></span>
            </div>

            <!-- ============================================== -->
            <label for="create-post" class="btn btn-primary">Create Post</label>
        </div>
     </div>
    <!-- ================================================================================================= -->

    <script src="assets/js/script.js"></script>
</body>

</html>