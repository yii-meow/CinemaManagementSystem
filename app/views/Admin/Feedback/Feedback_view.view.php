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
        <?php include "../app/views/adminSideBar.php"?>

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
                    <input type="text" class="form-control" id="title" value="<?= $data[0]->getUser()->getUserName() ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="feedback" class="form-label">Feedback</label>
                    <textarea class="form-control" id="feedback" rows="5" required
                              disabled><?= $data[0]->getContent() ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div>
                        <?php for ($i = 1; $i <= 5; $i++){?>
                            <span class="fa fa-star  <?php if($data[0]->getRating() >= $i) { echo "checked"; } ?>"></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" class="form-control" id="date" value="<?= $data[0]->getCreatedAt()->format('Y-m-d') ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" required disabled>
                        <option value="pending" <?php if($data[0]->getStatus() == "pending"){ echo "selected"; } ?>>Pending Review</option>
                        <option value="inProgress" <?php if($data[0]->getStatus() == "inProgress"){ echo "selected"; } ?>>In Progress</option>
                        <option value="resolved" <?php if($data[0]->getStatus() == "resolved"){ echo "selected"; } ?>>Resolved</option>
                        <option value="compensationOffered" <?php if($data[0]->getStatus() == "compensationOffered"){ echo "selected"; } ?>>Compensation Offered</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reply" class="form-label">Reply</label>
                    <textarea class="form-control" id="reply" rows="5" disabled><?= $data[0]->getReply() ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="coinCompensation" class="form-label">Coin Compensation</label>
                    <input type="number" class="form-control" id="coinCompensation" value="<?= $data[0]->getCoinCompensation() ?>" disabled />
                </div>

                <a href="Admin_FeedbackIndex"><div class="btn btn-danger">Back</div></a>
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
