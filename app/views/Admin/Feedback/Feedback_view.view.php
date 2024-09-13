<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminFeedback.css" />
    <title>Feedback</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
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
                            <a class="nav-link" href="Feedback.html">
                                <i class="fa fa-comment-dots me-4 fa-lg"></i>
                                Feedback
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">View Feedback</h1>

            <form class="main-content p-4 mt-3" style="
                      background-color: #ffffff;
                      border-radius: 8px;
                      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    ">
                <div class="mb-3">
                    <label for="title" class="form-label">Received from</label>
                    <input type="text" class="form-control" id="title" value="<?= $data['userID'] ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="feedback" class="form-label">Feedback</label>
                    <textarea class="form-control" id="feedback" rows="5" required
                              disabled><?php echo $data['content'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div>

                        <?php
                        for($i = 1; $i <= 5; $i++){
                        ?>
                            <span class="fa fa-star <?php if($i <= $data['rating']){ echo "checked";} ?>"></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" class="form-control" id="date" value="<?= $data['date'] ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" required disabled>
                        <option value="unread" <?php if($data['status'] == "unread"){ echo "selected"; } ?>>Unread</option>
                        <option value="read" <?php if($data['status'] == "read"){ echo "selected"; } ?>>Read</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reply" class="form-label">Reply</label>
                    <textarea class="form-control" id="reply" rows="5" disabled><?php echo $data['reply'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="coinCompensation" class="form-label">Coin Compensation</label>
                    <input type="number" class="form-control" id="coinCompensation" value="<?= $data['coinCompensation'] ?>" disabled />
                </div>

                <a href="Admin_FeedbackIndex"><button class="btn btn-danger">Back</button></a>
            </form>
        </main>

        <!--To enlarge the image-->>
        <div id="enlargeImg" class="ImageModal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="img">
        </div>

        <!-- Modal to view the Report Request -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Report Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="reportContent">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Accept</button>
                        <button type="button" class="btn btn-danger">Reject</button>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!--JavaScripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>
