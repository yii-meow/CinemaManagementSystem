<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/MyPost.css"/>
    <title>Forum</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>
<?php

// Handle POST requests to set session variables for editing or deleting a post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $_SESSION['postID'] = $_POST['postID'];
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $_SESSION['postID'] = $_POST['postID'];
    }
}

if (isset($_SESSION['delete_success']) && $_SESSION['delete_success']): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: 'Deleted!',
            text: 'Your post has been deleted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
<?php unset($_SESSION['delete_success']); ?>
<?php endif; ?>
?>
        <div id="Customer">

            <!--Header-->
            <div class="header" id="header">

                <div class="binder">


                    <div style="margin-left: 20px;" class="business-icon">
                        <div
                            style="color: white; height: inherit; text-align: center; font-weight: bold; font-size: 20px;">
                            <img src="<?= ROOT ?>/assets/images/alternativeIcon.png" draggable="false" width="200" height="55" />
                        </div>
                    </div>




                    <div class="search-ctn col-7" style="margin-top: auto; margin-bottom: auto;">
                        <div class="search-ctn input-group"
                            style="display: flex; flex-flow: row nowrap; min-width: 100%;" role="search">
                            <div class="s-box col-11">
                                <input type="text" autocomplete="off"
                                    style="outline:2px solid #f03351; color: #f03351; position: relative; border-bottom-right-radius: 0px; border-top-right-radius: 0px;"
                                    id="txtSearch" class="form-control border border-1 search-bar"
                                    placeholder="Movie Title" />
                            </div>
                            <div>
                                <button id="btnSch"
                                    style="background-color: #141414; width: fit-content; border-bottom-left-radius: 0px; border-top-left-radius: 0px; border-color: #f03351; height: 41px; margin-top: -2px;"
                                    class="btn-light btn btn-search">
                                    <i style="color: #f03351; font-size: 18px; display: flex; justify-content: center; align-items: center; margin-top: 4.5px; height: 18px;"
                                        class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="right-header">

                    <div class="action-group" style="display: flex; flex-flow: row nowrap;">


                        <div class="nofitication-cont">
                            <div>
                                <i onclick="openMessage()"
                                    style="cursor: pointer; position: relative; top: 0; color: white; font-size: 28px;"
                                    class="fa-regular fa-bell" id="bell"></i>
                                <div runat="server" ID="REDDOT"
                                    style="position: absolute; top: 0; right: 0; border-radius: 100px; background-color: #ff2b2b; height: 11px; width: 11px;">
                                </div>
                            </div>

                            <div class="messages">
                                <ul id="dropdownMessage" tabindex="-1" class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="navbarDropdownMenuLink">
                                    <li>
                                        abcde
                                    </li>
                                </ul>
                            </div>
                        </div>



                        <div class="profile-container action" id="profile">
                            <div style="margin-top: auto; margin-bottom: auto;">
                                <button onclick="" class="btn header-font"
                                    style="padding:10px; width: 160px; font-size: 17px; display: flex; color: #f03351;">
                                    <div
                                        style="margin-top: -3px; border-radius: 150px; width: 30px; height: 30px; overflow: hidden;">
                                        <img src="<?= ROOT ?>/assets/images/defaultProfile.jpg" draggable="false"
                                            style="background-color: white; border-radius: 100px; width: 30px; height: 30px;"
                                            id="topImage" />
                                    </div>
                                    &nbsp;
                                    User Profile
                                </button>
                            </div>
                        </div>

                        <div class="login action" style="margin-right: 20px;">
                            <div style="margin-top: auto; margin-bottom: auto;">
                                <button ID="btnLgn" class="topBtns btn dropdown-toggle header-font"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    Style="font-size: 17px; color:#f03351">
                                    <i style="color: #f03351; font-size:18px"
                                        class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;
                                    Login
                                </button>
                                <ul class="dropdown-menu">
                                    <li id="userlogin">
                                        <a href="" id="hrefCustomer" class="dropdown-item LoginHover">Customer</a>
                                    </li>
                                    <li id="stafflogin">
                                        <a id="hrefStaff" href="" class="dropdown-item LoginHover">Staff</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <!--Navigation Bar-->
            <div class="dropdowns" style="display: flex; flex-flow: row nowrap;">
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        NEW MOVIES
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">New Action</a></li>
                        <li><a class="dropdown-item" href="">New Horror</a></li>
                        <li><a class="dropdown-item" href="">New Animation</a></li>
                        <li><a class="dropdown-item" href="">New Romance</a></li>
                    </ul>
                </div>
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ACTION
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Superhero</a></li>
                        <li><a class="dropdown-item" href="">War</a></li>
                        <li><a class="dropdown-item" href="">Adventure</a></li>
                    </ul>
                </div>
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        HORROR
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Supernatural Horror</a></li>
                        <li><a class="dropdown-item" href="">Zombie</a></li>
                    </ul>
                </div>
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ANIMATION
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">2D Animation</a></li>
                        <li><a class="dropdown-item" href="">3D Animation</a></li>
                        <li><a class="dropdown-item" href="">Anime</a></li>
                    </ul>
                </div>
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ROMANCE
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Romantic Comedy</a></li>
                        <li><a class="dropdown-item" href="">Romantic Drama</a></li>
                    </ul>
                </div>
                <ul class="nav-item dropdown">
                    <button class="btn dropbtn" type="button" aria-expanded="false">
                        <a href="" style="text-decoration: none;"> NOW SHOWING</a>
                    </button>
                </ul>
                <ul class="nav-item dropdown">
                    <button class="btn dropbtn" type="button" aria-expanded="false">
                        <a href="" style="text-decoration: none;"> COMING SOON</a>
                    </button>
                </ul>
                <div class="drop">
                    <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        FORUM
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Forum.html">Community Forum</a></li>
                        <li><a class="dropdown-item" href="AddPost.html">Create Post</a></li>
                        <li><a class="dropdown-item" href="MyPost.html">My Post</a></li>
                        <li><a class="dropdown-item" href="LikedPost.html">Liked Post</a></li>
                    </ul>
                </div>
            </div>


            <!--Main Contents-->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row flex-nowrap">
                        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                            <div
                                class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                                <p
                                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                    <span class="fs-5 d-none d-sm-inline">MY POST</span>
                                </p>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <form class="form-inline d-flex">
                                            <div class="searchInput-wrapper">
                                                <input class="form-control" type="content" placeholder="Search post"
                                                    aria-label="content" style="font-size: 0.7em;">
                                                <button class="send-btn" type="submit"><i
                                                        class="fas fa-search search-icon"></i></button>
                                            </div>
                                        </form>
                                    </li>
                                    <li>
                                        <div class="filter-section mt-3">
                                            <h5>Filter By:</h5><br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filterOptions"
                                                    id="latestPost" value="latestPost" checked>
                                                <label class="form-check-label" for="latestPost">
                                                    Latest Post
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filterOptions"
                                                    id="highestLikes" value="highestLikes">
                                                <label class="form-check-label" for="highestLikes">
                                                    Highest Likes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filterOptions"
                                                    id="oldestPost" value="oldestPost">
                                                <label class="form-check-label" for="oldestPost">
                                                    Oldest Post
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="centered-container">
                            <div class="MyPostTitle">
                                My Post<br>
                                <button class="activity-btn" onclick="window.location.href='<?=ROOT?>/PostActivity/viewActivity'">
                                    <i class="fa fa-eye"></i>&nbsp;View Activity
                                </button>
                                <br><br>
                            </div>
                            <!--<div class="viewYear">
                                2024
                            </div>
                            <div class="viewDate">
                                25 June
                            </div>-->
                            <br>
                            <?php if (!empty($posts)) : ?>
                                <?php foreach ($posts as $postItem) : ?>
                                    <div class="inner-container">
                                        <div class="Mypost-header">
                                            <div class="post-options">
                                                <button class="options-btn" onclick="toggleDropdown(event)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Edit Post -->
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPostModal" onclick="setEditPostID(<?php echo htmlspecialchars($postItem->postID, ENT_QUOTES, 'UTF-8'); ?>)">
                                                        <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Post<br>
                                                    </button>

                                                    <!-- Delete Post -->
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletePostModal" onclick="setDeletePostID(<?php echo htmlspecialchars($postItem->postID, ENT_QUOTES, 'UTF-8'); ?>)">
                                                            <i class="fas fa-trash-alt me-1"></i>&nbsp;&nbsp;Delete Post<br>
                                                    </button>
                                                </div>

                                                <!-- Modal for Edit Post -->
                                                <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editPostModalLabel">Edit Post Content</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Edit Post Form -->
                                                                <form id="editPostForm" action="<?=ROOT?>/EditPost/index" method="POST">
                                                                    <input type="hidden" name="postID" id="editPostID">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <div class="mb-3">
                                                                        <label for="editPostContent" class="form-label">Post Content</label>
                                                                        <textarea class="form-control" id="editPostContent" name="editPostContent" rows="4"></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary" style="float:right;">Save Changes</button>
                                                                    <br><br>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for Delete Confirmation -->
                                                <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deletePostModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this post? This action cannot be undone.
                                                                <form id="deletePostForm" action="<?= ROOT ?>/DeletePost/index" method="POST">
                                                                    <input type="hidden" name="postID" id="deletePostID">
                                                                    <input type="hidden" name="action" value="delete">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($postItem->contentImg): ?>
                                            <div class="post-image">
                                                <img src="<?= ROOT ?>/assets/contentImg/<?php echo htmlspecialchars($postItem->contentImg, ENT_QUOTES, 'UTF-8'); ?>" class="posted-image" onclick="openModal(this)" />
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-content">
                                            <p><?php echo htmlspecialchars($postItem->content, ENT_QUOTES, 'UTF-8'); ?></p>
                                            <div class="post-details">
                                                <span><?php echo htmlspecialchars($postItem->postDate, ENT_QUOTES, 'UTF-8'); ?></span>
                                                <button class="action-button translate-button">Translate</button>
                                            </div>

                                            <div class="action-container">
                                                <div class="action-item">
                                                    <i class="fa fa-heart-o"></i>
                                                    <p class="like-count">10</p> <!-- Replace with dynamic like count if available -->
                                                </div>
                                                <button class="action-button viewComment-button" onclick="toggleComments(event)" style="margin-top: -6px;">View Comment</button>
                                            </div>

                                            <!-- Comment Section -->

                                            <div class="display-comment" style="display: none;">
                                                <p style="color: gray; font-size: 0.7em; margin-left: 20px;">
                                                    <?php echo $postItem->comments ? count($postItem->comments) . " Comment(s)" : "0 Comment(s)"; ?>
                                                </p>

                                                <div class="comment-section">
                                                    <div class="input-wrapper">
                                                        <form method="POST" action="<?= ROOT ?>/public/index.php">
                                                            <input type="hidden" name="action" value="createComment" />
                                                            <textarea class="comment-input" style="font-size: 0.8em;" name="commentText" placeholder="Write a comment..." required></textarea>
                                                            <button class="send-comment" type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>

                                                    <?php if (isset($postItem->comments)): ?>
                                                        <?php foreach ($postItem->comments as $comment): ?>
                                                            <div class="user-comment">
                                                                <div class="profile-container mr-3">
                                                                    <button class="btn header-font">
                                                                        <img src="<?= ROOT ?>/assets/images/<?php echo htmlspecialchars($comment->profileImg, ENT_QUOTES, 'UTF-8'); ?>" draggable="false" id="topImage" style="width: 30px; height: 30px;" />
                                                                    </button>
                                                                </div>
                                                                <div class="comment-body">
                                                                    <span class="uname-cmt"><?php echo htmlspecialchars($comment->userName, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                    <div class="comment-text"><?php echo htmlspecialchars($comment->CommentText, ENT_QUOTES, 'UTF-8'); ?></div>
                                                                    <div class="comment-actions">
                                                                        <button class="action-button reply-button" onclick="showReplyBox(event)">Reply</button>
                                                                        <button class="action-button translate-button">Translate</button>
                                                                    </div>

                                                                    <!-- Reply Section -->
                                                                    <div class="reply-wrapper" style="display:none;">
                                                                        <input type="text" class="reply-input" placeholder="Write your reply here..." style="font-size: 0.8em;" />
                                                                        <button class="send-reply" type="submit" onclick="sendReply(event)"><i class="fas fa-paper-plane"></i></button>
                                                                    </div>

                                                                    <?php $comment_id = $comment->commentID; ?>
                                                                    <?php $replies = $comment->replies ?? []; ?>
                                                                    <?php if ($replies): ?>
                                                                        <?php foreach ($replies as $reply): ?>
                                                                            <div class="user-reply">
                                                                                <div class="profile-container mr-3">
                                                                                    <button class="btn header-font">
                                                                                        <img src="<?= ROOT ?>/assets/images/<?php echo htmlspecialchars($reply->profileImg, ENT_QUOTES, 'UTF-8'); ?>" draggable="false" id="topImage" style="width: 20px; height: 20px;" />
                                                                                    </button>
                                                                                </div>
                                                                                <div class="reply-body">
                                                                                    <span class="uname-rpl"><?php echo htmlspecialchars($reply->userName, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                                    <div class="reply-text"><p style="color: #005eff; display: inline;">@<?php echo htmlspecialchars($reply->userName, ENT_QUOTES, 'UTF-8'); ?></p> <?php echo htmlspecialchars($reply->replyText, ENT_QUOTES, 'UTF-8'); ?></div>
                                                                                    <div class="reply-actions">
                                                                                        <button class="action-button reply-button" onclick="showSubReplyBox(event)">Reply</button>
                                                                                        <button class="action-button translate-button">Translate</button>
                                                                                    </div>
                                                                                    <div class="reply-wrapper" style="display:none; width: 380px;">
                                                                                        <input type="text" class="reply-input" placeholder="Write your reply here..." style="font-size: 0.8em;" />
                                                                                        <button class="send-reply" type="submit" onclick="sendReply(event)"><i class="fas fa-paper-plane"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Currently no posts from users.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>




        </div>

        <!-- Allow the user to enlarge the posted image -->
        <div id="enlargeImg" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="img">
        </div>


        <!--End of Main Contents-->



        <!--Footer-->
        <footer id="footer">
            <div class="footer-container container-fluid">
                <div class="bottom" style="text-align: center; color: white;">
                    © 2023 - 2024 DreamWorks Cinema (Copyright All Right Reserved)
                </div>
            </div>
        </footer>




        <!--JavaScripts-->
        <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript">
            // post id of Edit post
            function setEditPostID(postID) {
                document.getElementById('editPostID').value = postID;
                // Optionally, you might want to fetch and populate the post content here using AJAX
            }

            // post id of delete post
            function setDeletePostID(postID) {
                document.getElementById('deletePostID').value = postID;
            }

            function toggleDropdown(event) {
                const dropdown = event.currentTarget.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

                //Click again the View Comment to hide the comment
                function handleOutsideClick(e) {
                    if (!dropdown.contains(e.target) && e.target !== event.currentTarget) {
                        dropdown.style.display = 'none';
                        document.removeEventListener('click', handleOutsideClick);
                    }
                }
            }

            // show the comment 
            function toggleComments(event) {
                const commentSection = event.currentTarget.closest('.inner-container').querySelector('.display-comment');
                commentSection.style.display = commentSection.style.display === 'none' ? 'block' : 'none';
            }

            //Display the reply input field
            function showReplyBox(event) {
                const replyContainer = event.currentTarget.closest('.comment-body').querySelector('.reply-wrapper');
                replyContainer.style.display = (replyContainer.style.display === 'none' || replyContainer.style.display === '') ? 'block' : 'none';
            }

            // Display the sub-reply input field
            function showSubReplyBox(event) {
                const subReplyContainer = event.currentTarget.closest('.reply-body').querySelector('.reply-wrapper');
                subReplyContainer.style.display = (subReplyContainer.style.display === 'none' || subReplyContainer.style.display === '') ? 'block' : 'none';
            }



            // Get the modal
            var modal = document.getElementById("enlargeImg");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var modalImg = document.getElementById("img");

            function openModal(element) {
                modal.style.display = "block";
                modalImg.src = element.src;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            function closeModal() {
                modal.style.display = "none";
            }
        </script>
    </body>

</html>