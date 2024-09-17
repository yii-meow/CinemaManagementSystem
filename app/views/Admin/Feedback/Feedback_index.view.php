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

        <?php include "../app/views/adminSideBar.php"?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fa fa-comment-dots me-2"></i>Feedback
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="row mb-4">

                <div class="col-md-4 mt-3" style="width: 50%;">
                    <label for="status">Feedback</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search Feedback..." />
                    </div>
                </div>
                <div class="col-md-4 mt-3" style="width: 50%;">
                    <label for="rating">Rating</label>
                    <div class="input-group">
                        <select class="form-select" id="rating" required>
                            <option value="5" selected>5 Stars</option>
                            <option value="4" >4 Stars</option>
                            <option value="3" >3 Stars</option>
                            <option value="2" >2 Stars</option>
                            <option value="1" >1 Star</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-3" style="width: 50%;">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <select class="form-select" id="status" required>
                            <option value="pending" selected>Pending Review</option>
                            <option value="inProgress" >In Progress</option>
                            <option value="resolved" >Resolved</option>
                            <option value="compensationOffered" >Compensation Offered</option>
                        </select>
                    </div>
                </div>



            </div>

            <!-- Tables -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 25%;">Username</th>
                    <th scope="col" style="width: 25%;">Rating</th>
                    <th scope="col" style="width: 20%;">Date</th>
                    <th scope="col" style="width: 10%;">Status</th>
                    <th scope="col" style="width: 15%;">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php if(!empty($data)){ foreach ($data as $index => $feedback){ ?>
                <tr>
                    <th scope="row"><?= $index+1 ?></th>
                    <td><?= $feedback->getUser()->getUserName() ?></td>
                    <td>
                        <div>
                            <?php for ($i = 1; $i <= 5; $i++){?>
                                <span class="fa fa-star  <?php if($feedback->getRating() >= $i) { echo "checked"; } ?>"></span>
                            <?php } ?>
                        </div>
                    </td>
                    <td><?= $feedback->getCreatedAt()->format('Y-m-d') ?></td>
                    <td><?= strtoupper($feedback->getStatus()) ?></td>
                    <td><a href="Admin_FeedbackView?feedbackID=<?= $feedback->getFeedbackId() ?>"><button class="btn btn-md btn-outline-primary me-2">
                                <i class="fas fa-exclamation-circle me-1"></i>View
                            </button></a>
                        <a href="Admin_FeedbackEdit?feedbackID=<?= $feedback->getFeedbackId() ?>">
                            <button class="btn btn-md btn-outline-primary me-2">
                                <i class="fas fa-edit me-1"></i>Edit
                            </button>
                        </a>
                    </td>
                </tr>
                <?php }} ?>

                </tbody>
            </table>


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


<script type="text/javascript">
    //To view report content
    function setReportContent(content) {
        document.getElementById('reportContent').innerText = content;
    }

    //To enlarge image
    var ImageModal = document.getElementById("enlargeImg");
    var modalImg = document.getElementById("img");

    function openModal(element) {
        ImageModal.style.display = "block";
        modalImg.src = element.src;
    }
    var span = document.getElementsByClassName("close")[0];
    function closeModal() {
        ImageModal.style.display = "none";
    }


</script>
</body>


</html>
