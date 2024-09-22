<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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

?>
<?php if (isset($_GET['message'])): ?>
    <div class="notification" style="background-color: #dff0d8; padding: 10px; border-radius: 5px;">
        <?php if ($_GET['message'] === 'comment_success'): ?>
            <p>Your comment was successfully added!</p>
        <?php elseif ($_GET['message'] === 'reply_success'): ?>
            <p>Your reply was successfully added!</p>
        <?php elseif ($_GET['message'] === 'comment_fail'): ?>
            <p>Your comment was not added!</p>
        <?php elseif ($_GET['message'] === 'reply_fail'): ?>
            <p>Your reply was not added!</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    // Function to get query parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    window.onload = function () {
        const edit = getQueryParam('edit');
        const remove = getQueryParam('remove');

        if (edit === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Post Edited',
                text: 'Your post has been successfully edited!',
                confirmButtonText: 'OK'
            });
        } else if (edit === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Post Edit Failed',
                text: 'There was an issue editing your post. Please try again.',
                confirmButtonText: 'OK'
            });
        } else if (remove === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Post Deleted',
                text: 'Your post has been successfully deleted!',
                confirmButtonText: 'OK'
            });
        } else if (remove === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Post Delete Failed',
                text: 'There was an issue deleting your post. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    };
</script>
<?php
if (isset($data['user'])) {
    $user = $data['user'];

}
$userID = $_SESSION['userId'];
?>

        <div id="Customer">

            <?php include(dirname(__DIR__) . '../../header.php') ?>
            <?php include(dirname(__DIR__) . '../../navigationBar.php') ?>

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
                                        <form class="form-inline d-flex" method="POST" action="<?=ROOT?>/SearchPost/index">
                                            <input type="hidden" name="searchType" value="myPost">
                                            <div class="searchInput-wrapper">
                                                <input class="form-control" type="text" name="content" placeholder="Search post"
                                                    aria-label="content" style="font-size: 0.7em;">
                                                <button class="send-btn" type="submit"><i
                                                        class="fas fa-search search-icon"></i></button>
                                            </div>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="<?=ROOT?>/FilterPost/index" method="POST">
                                            <input type="hidden" name="filterType" value="myPosts">
                                            <div class="filter-section mt-3">
                                                <h5>Filter By:</h5><br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filterOptions" id="latestPost" value="latestPost" checked>
                                                    <label class="form-check-label" for="latestPost">
                                                        Latest Post
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filterOptions" id="oldestPost" value="oldestPost">
                                                    <label class="form-check-label" for="oldestPost">
                                                        Oldest Post
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filterOptions" id="highestLikes" value="highestLikes">
                                                    <label class="form-check-label" for="highestLikes">
                                                        Highest Likes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filterOptions" id="lowestLikes" value="lowestLikes">
                                                    <label class="form-check-label" for="lowestLikes">
                                                        Lowest Likes
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3" style="font-size: 0.8em; background-color: #0066cc">Apply</button>
                                        </form>

                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="centered-container">
                            <?php if (!empty($keyword)) : ?>
                                <div class="MyPostTitle">
                                    Searched Result: <?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>
                                </div>
                            <?php else : ?>
                                <div class="MyPostTitle">
                                    My Post<br>
                                    <form method="post" action="<?=ROOT?>/PostActivity">
                                    <button class="activity-btn" onclick="window.location.href='<?=ROOT?>/PostActivity'">
                                        <i class="fa fa-eye"></i>&nbsp;View Activity
                                    </button></form>
                                    <br><br>
                                </div>
                            <?php endif; ?>

                            <!--<div class="viewYear">
                                2024
                            </div>
                            <div class="viewDate">
                                25 June
                            </div>-->
                            <br>
                            <?php if (!empty($posts)) : ?>
                                <?php foreach ($posts as $postItem) : ?>
                                <br><br>
                                    <div class="inner-container">
                                        <div class="Mypost-header">
                                            <div class="post-options">
                                                <button class="options-btn" onclick="toggleDropdown(event)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Edit Post -->
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPostModal" onclick="setEditPostID(<?php echo htmlspecialchars($postItem['postID'], ENT_QUOTES, 'UTF-8'); ?>)">
                                                        <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Post<br>
                                                    </button>

                                                    <!-- Delete Post -->
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletePostModal" onclick="setDeletePostID(<?php echo htmlspecialchars($postItem['postID'], ENT_QUOTES, 'UTF-8'); ?>)">
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
                                        <?php if ($postItem['contentImg']): ?>
                                            <div class="post-image">
                                                <img src="<?=ROOT?>/..<?php echo htmlspecialchars($postItem['contentImg']); ?>" class="posted-image" onclick="openModal(this)"/>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-content">
                                            <form class="translateForm">
                                                <input type="hidden" name="content"
                                                       value="<?php echo htmlspecialchars($postItem['content'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <p style="margin-left: 20px;"><?php echo htmlspecialchars($postItem['content'], ENT_QUOTES, 'UTF-8'); ?></p>
                                                <p class="translationResult" style="margin-left: 20px; color:#939191; font-size:0.8em;"></p>

                                                <div class="post-details">
                                                    <span><?php echo htmlspecialchars($postItem['postDate'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                    <button type="button" class="action-button translate-button"
                                                            onclick="translateContent(this)">Translate
                                                    </button>
                                                </div>
                                                <p class="translationResult" style="margin-left: 20px; color:limegreen"></p>
                                            </form>
                                            <script>
                                                function translateContent(button) {
                                                    // Find the closest form element
                                                    var form = button.closest('form');
                                                    var formData = new FormData(form);

                                                    fetch('<?= ROOT ?>/Translation/index', {
                                                        method: 'POST',
                                                        body: formData
                                                    })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            // Find the result paragraph in the same form
                                                            var resultParagraph = form.querySelector('.translationResult');
                                                            if (data.translatedText) {
                                                                resultParagraph.innerText = 'Translated Text: ' + data.translatedText;
                                                            } else if (data.error) {
                                                                resultParagraph.innerText = 'Error: ' + data.error;
                                                            }
                                                        })
                                                        .catch(error => {
                                                            // Find the result paragraph in the same form
                                                            var resultParagraph = form.querySelector('.translationResult');
                                                            resultParagraph.innerText = 'Error: ' + error;
                                                        });
                                                }

                                            </script>

                                            <!-- for like and unlike section-->
                                            <div class="action-container">
                                                <div class="action-item" style="margin-left:20px;" data-post-id="<?php echo htmlspecialchars($postItem['postID'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <i class="fa <?php echo htmlspecialchars($postItem['isLiked'] ? 'fa-heart liked' : 'fa-heart-o unliked', ENT_QUOTES, 'UTF-8'); ?> like-button"
                                                       id="like-button-<?php echo htmlspecialchars($postItem['postID'], ENT_QUOTES, 'UTF-8'); ?>"
                                                       onclick="toggleLike(event, this)"></i>
                                                    <p class="like-count" id="like-count-<?php echo htmlspecialchars($postItem['postID'], ENT_QUOTES, 'UTF-8'); ?>">
                                                        <?php echo htmlspecialchars($postItem['likeCount'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </p>
                                                </div>
                                                <button class="action-button viewComment-button" onclick="toggleComments(event)"
                                                        style="margin-top: -6px;">View Comment
                                                </button>
                                            </div>

                                            <!-- Comment Section -->

                                            <?php $post_id = $postItem['postID']; ?>
                                            <div class="display-comment" style="display: none;">
                                                <p style="color: gray; font-size: 0.7em; margin-left: 20px;">
                                                    <?php echo $postItem['comments'] ? count($postItem['comments']) . " Comment(s)" : "0 Comment(s)"; ?>
                                                </p>

                                                <div class="comment-section">
                                                    <div class="input-wrapper">
                                                        <form method="POST" action="<?= ROOT ?>/AddCommentReply/index">
                                                            <input type="hidden" name="action" value="comment" />
                                                            <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8'); ?>" />
                                                            <input class="comment-input" style="font-size: 0.8em;" name="commentText" placeholder="Write a comment..." required>
                                                            <button class="send-comment" type="submit"><i class="fas fa-paper-plane" ></i></button>
                                                        </form>
                                                    </div>


                                                    <?php if (isset($postItem['comments'])): ?>
                                                        <?php foreach ($postItem['comments'] as $comment): ?>
                                                            <div class="user-comment">
                                                                <div class="profile-container mr-3">
                                                                    <button class="btn header-font">
                                                                        <img src="<?= ROOT ?>/assets/images/<?php echo htmlspecialchars($comment['profileImg'], ENT_QUOTES, 'UTF-8'); ?>" draggable="false" id="topImage" style="width: 30px; height: 30px;" />
                                                                    </button>
                                                                </div>
                                                                <div class="comment-body">
                                                                    <span class="uname-cmt"><?php echo htmlspecialchars($comment['userName']); ?></span>
                                                                    <div class="comment-text"><?php echo htmlspecialchars($comment['commentText']); ?></div>
                                                                    <div class="comment-actions">
                                                                        <button class="action-button reply-button" onclick="showReplyBox(event)">Reply</button>
                                                                    </div>

                                                                    <!-- Reply Section -->
                                                                    <div class="reply-wrapper" style="display:none;">
                                                                        <form method="POST" action="<?= ROOT ?>/AddCommentReply/index">
                                                                            <input type="hidden" name="action" value="reply" />
                                                                            <input type="hidden" name="commentID" value="<?php echo htmlspecialchars($comment['commentID'], ENT_QUOTES, 'UTF-8'); ?>" />
                                                                            <input type="hidden" name="postID" value="<?php echo htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8'); ?>" />
                                                                            <input type="text" class="reply-input" name="replyText" placeholder="Write your reply here..." style="font-size: 0.8em;" required />
                                                                            <button class="send-reply" type="submit"><i class="fas fa-paper-plane"></i></button>
                                                                        </form>
                                                                    </div>

                                                                    <?php $comment_id = $comment['commentID']; ?>
                                                                    <?php $replies = $comment['replies'] ?? []; ?>

                                                                    <?php if ($replies): ?>
                                                                        <?php foreach ($replies as $reply): ?>
                                                                            <div class="user-reply">
                                                                                <div class="profile-container mr-3">
                                                                                    <button class="btn header-font">
                                                                                        <img src="<?= ROOT ?>/assets/images/<?php echo htmlspecialchars($reply['profileImg'], ENT_QUOTES, 'UTF-8'); ?>" draggable="false" id="topImage" style="width: 20px; height: 20px;" />
                                                                                    </button>
                                                                                </div>
                                                                                <div class="reply-body">
                                                                                    <span class="uname-rpl"><?php echo htmlspecialchars($reply['userName'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                                    <div class="reply-text"><?php echo htmlspecialchars($reply['replyText'], ENT_QUOTES, 'UTF-8'); ?></div>
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
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php if (!empty($keyword)) : ?>
                                    <p style="color: #f03351">No Result Found</p>
                                <?php else : ?>
                                    <p style="color: #f03351">No posts available</p>
                                <?php endif; ?>
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
<?php include(dirname(__DIR__) . '../../footer.php') ?>


<?php
// Ensure ROOT and $userID are properly defined
$rootUrl = ROOT; // Assuming ROOT is defined in PHP
$userID = isset($userID) ? $userID : 'null'; // Ensure $userID is set
?>

<!--JavaScripts-->
<script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/likeIcon.js"></script>


<script type="text/javascript">
    // passing the value for likeIcon.js
    const rootUrl = '<?= $rootUrl ?>';
    const userID = <?= json_encode($userID) ?>;

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