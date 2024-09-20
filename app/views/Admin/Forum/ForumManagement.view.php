<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/AdminCinemaManagement.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ForumManagement.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Forum Management</title>
    <link rel="icon" type="image/x-icon" href="<?=ROOT?>/assets/images/icon.png" />
    <script>
        // Function to get query parameters
        // Function to get query parameters
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        window.onload = function () {
            const remove = getQueryParam('remove');
            const action = getQueryParam('action');

            if (remove === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Post Deleted',
                    text: 'Your post has been successfully deleted!',
                    confirmButtonText: 'OK'
                });
            } else if (remove === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Post Edit Failed',
                    text: 'There was an issue deleting your post. Please try again.',
                    confirmButtonText: 'OK'
                });
            } else if (action === 'approve') {
                Swal.fire({
                    icon: 'success',
                    title: 'Reported Post Approved',
                    text: 'The reported post has been approved and deleted.',
                    confirmButtonText: 'OK'
                });
            } else if (action === 'reject') {
                Swal.fire({
                    icon: 'error',
                    title: 'Reported Post Rejected',
                    text: 'There was an issue processing the reported post. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        };

    </script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Remember to change this-->

        <nav class="col-md-3 col-lg-2 d-md-block p-0">
            <div class="sidebar-container">
                <div class="sidebar p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-film me-4 fa-lg"></i>
                                Cinemas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-4 fa-lg"></i>
                                Showtimes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ticket-alt me-4 fa-lg"></i>
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AdminForum.html">
                                <i class="fa fa-users me-4 fa-lg"></i>
                                Forum
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-4 fa-lg"></i>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-4 fa-lg"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Admin Info -->
                <div class="admin-info">
                    <div class="d-flex align-items-center mb-2">
                        <img src="/Media/Image/pp.webp" alt="Admin Avatar" class="me-2" />
                        <div>
                            <strong>John Doe</strong>
                            <div class="small text-muted">Admin</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-light btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fa fa-users me-2"></i>Forum Management
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="row mb-4">
                <div class="col-md-4" style="width: 65%;">
                    <form action="<?=ROOT?>/SearchPost/index" method="post">

                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="hidden" name="searchType" value="adminView"/>
                        <input type="text" class="form-control" name="content" placeholder="Search Post..." />
                    </div>
                    </form>

                </div>


            </div>

            <!-- Tables -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 20%;">Username</th>
                    <th scope="col" style="width: 40%;">Content</th>
                    <th scope="col" style="width: 10%;">Image</th>
                    <th scope="col" style="width: 10%;">Status</th>
                    <th scope="col" style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($posts)) : ?>
                    <?php foreach ($posts as $index => $post): ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= htmlspecialchars($post['userName']) ?></td>
                            <td><?= htmlspecialchars($post['content']) ?></td>
                            <td>
                                <?php if ($post['contentImg']): ?>
                                    <img src="<?php echo ROOT . htmlspecialchars($post['contentImg']); ?>"
                                         style="width: 30%; height: 20%;" onclick="openModal(this)">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($post['status']) ?></td>
                            <td>
                                <?php if ($post['status'] === 'Reported'): ?>
                                    <button class="btn btn-md btn-outline-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#reportModal<?= htmlspecialchars($post['postID'], ENT_QUOTES, 'UTF-8') ?>"
                                            data-post-id="<?= htmlspecialchars($post['postID'], ENT_QUOTES, 'UTF-8') ?>"
                                            data-report-reason="<?= htmlspecialchars($post['reportReason'], ENT_QUOTES, 'UTF-8') ?>">
                                        <i class="fas fa-exclamation-circle me-1"></i>View
                                    </button>

                                    <!-- Modal for Report Request -->
                                    <div class="modal fade" id="reportModal<?= htmlspecialchars($post['postID'], ENT_QUOTES, 'UTF-8') ?>" tabindex="-1"
                                         aria-labelledby="reportModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportModalLabel">Report Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="reportContent">
                                                    <?= "Reason: " . htmlspecialchars($post['reportReason'], ENT_QUOTES, 'UTF-8') ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="reportActionForm" method="POST" action="<?= ROOT ?>/AdminRepReq/index">
                                                        <input type="hidden" id="reportPostId" name="postID"
                                                               value="<?= htmlspecialchars($post['postID'], ENT_QUOTES, 'UTF-8') ?>">
                                                        <button type="submit" class="btn btn-success" name="action" value="approve">Accept</button>
                                                        <button type="submit" class="btn btn-danger" name="action" value="reject">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                <?php else: ?>
                                    <button class="btn btn-md btn-outline-danger me-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter" onclick="setPostId(<?= htmlspecialchars($post['postID'], ENT_QUOTES, 'UTF-8') ?>)">
                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                    </button>

                                    <!-- Confirmation Msg -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Confirm to Delete?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deletePostForm" method="POST" action="<?=ROOT?>/AdminDeletePost/index">
                                                        <input type="hidden" id="postId" name="postId" value="">

                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p style="color: #f03351">No posts available</p>
                <?php endif; ?>
                </tbody>

            </table>



        </main>

        <!-- Image Enlargement Modal -->
        <div id="enlargeImg" class="modal" style="display: none;">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="img-content" id="modalImg" />
        </div>




    </div>
</div>

<!--JavaScripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript">
    function setPostId(postID) {
        document.getElementById('postId').value = postID;
    }

    //To view report content
    function setReportContent(content) {
        document.getElementById('reportContent').innerText = content;
    }

    //To enlarge image
    function openModal(element) {
        var modal = document.getElementById("enlargeImg");
        var modalImg = document.getElementById("modalImg");
        modal.style.display = "block";
        modalImg.src = element.src;
        modalImg.alt = element.alt;
    }

    function closeModal() {
        var modal = document.getElementById("enlargeImg");
        modal.style.display = "none";
    }


</script>
</body>


</html>