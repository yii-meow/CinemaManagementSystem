<!DOCTYPE html>
<!--
@Author Angeline Chuang May Teng
-->
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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css" />

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/MyPost.css" />
    <title>Forum</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to get query parameters
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        window.onload = function () {
            const message = getQueryParam('message');
            if (message === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Post Created',
                    text: 'Your post has been successfully created!',
                    confirmButtonText: 'OK'
                });
            } else if (message === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Post Creation Failed',
                    text: 'There was an issue creating your post. Please try again.',
                    confirmButtonText: 'OK'
                });
            } else if (message === 'validation_error') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please fill in all required fields.',
                    confirmButtonText: 'OK'
                });
            } else if (message === 'image_upload_error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Image Upload Failed',
                    text: 'There was an issue uploading the image. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        };
    </script>
</head>

<body>

    <body>
        <div id="Customer">
            <?php include(dirname(__DIR__) . '../../header.php') ?>
            <?php include(dirname(__DIR__) . '../../navigationBar.php') ?>


            <!--Main Contents-->
            <div class="main-content">

                <div class="centered-container">
                    <div class="MyPostTitle">
                        Create Post
                    </div>
                    <br><br><br>
                    <div class="inner-container">

                        <form id="createPostForm" enctype="multipart/form-data" method="POST" action="<?=ROOT?>/AddPost/index">
                            <input type="hidden" name="action" value="createPost" />

                            <div class="mb-3">
                                <input type="hidden" name="userId" value="3" />
                                <label for="postContent" class="form-label">Post Content</label>
                                <textarea class="form-control" id="postContent" name="content" rows="4" placeholder="Write your content here..." required><?= isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '' ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="postImage" class="form-label">Upload Image Only</label>
                                <input class="form-control" type="file" id="postImage" name="contentImg" onchange="previewImage(event)">
                                <div id="fileError" class="text-danger mt-2">
                                    <?php if (isset($errorMessage)): ?>
                                        <?php echo htmlspecialchars($errorMessage); ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Image Preview Section -->
                            <div class="mb-3">
                                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; display: none;" />
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit Post</button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>


            <!--Footer-->
            <?php include(dirname(__DIR__) . '../../footer.php') ?>




            <!--JavaScripts-->
            <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

            <script type="text/javascript">

                function previewImage(event) {
                    const reader = new FileReader();
                    const imagePreview = document.getElementById('imagePreview');

                    reader.onload = function () {
                        imagePreview.src = reader.result;
                        imagePreview.style.display = 'block';  // Show the preview
                    }

                    if (event.target.files[0]) {
                        reader.readAsDataURL(event.target.files[0]); // Read the image file as a data URL
                    }
                }
            </script>
    </body>

</html>