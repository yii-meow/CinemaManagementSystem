<?php
use App\constant\feedback_status;
?>

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

                <form method="post" action="Admin_FeedbackIndex\Search">
                    <div class="col-md-4 mt-3" style="width: 50%;">
                        <label for="rating">Rating</label>
                        <div class="input-group">
                            <select class="form-select" id="rating" name="filter_rating" required>
                                <option value="all" selected>All</option>
                                <option value="5" >5 Stars</option>
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
                            <select class="form-select" id="status" name="filter_status" required>
                                <option value="all" selected>All</option>
                                <option value="<?= feedback_status::PENDING ?>"><?= feedback_status::PENDING ?></option>
                                <option value="<?= feedback_status::IN_PROGRESS ?>" ><?= feedback_status::IN_PROGRESS ?></option>
                                <option value="<?= feedback_status::RESOLVED ?>" ><?= feedback_status::RESOLVED ?></option>
                                <option value="<?= feedback_status::COMPENSATION_OFFERED ?>" ><?= feedback_status::COMPENSATION_OFFERED ?></option>
                            </select>
                        </div>
                    </div>
                    <button type="submit">Search</button>
                </form>



            </div>

            <!-- Tables -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 10%;">Username</th>
                    <th scope="col" style="width: 20%;">Feedback Keyword</th>
                    <th scope="col" style="width: 10%;">Rating</th>
                    <th scope="col" style="width: 10%;">Date</th>
                    <th scope="col" style="width: 25%;">Status</th>
                    <th scope="col" style="width: 20%;">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php if(!empty($data)) {
                    foreach ($data['feedback'] as $index => $feedback) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $feedback->getUser()->getUserName() ?></td>
                            <td style="display: flex">
                                <?php
                                foreach ($data['keyword'][$index] as $value) {
                                echo "<div class='keyword-div'>$value</div>";
                                }
                                ?>
                            </td>
                            <td>
                                <div>
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                        <span class="fa fa-star  <?php if ($feedback->getRating() >= $i) {
                                            echo "checked";
                                        } ?>"></span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td><?= $feedback->getCreatedAt()->format('Y-m-d') ?></td>
                            <td class="<?php switch($feedback->getStatus()) {
                                case feedback_status::PENDING:
                                    echo "pending";
                                    break;
                                case feedback_status::IN_PROGRESS:
                                    echo "inProgress";
                                    break;
                                case feedback_status::RESOLVED:
                                    echo "resolved";
                                    break;
                                case feedback_status::COMPENSATION_OFFERED:
                                    echo "compensationOffered";
                                    break;
                                default:
                                    echo "compensationOffered";
                                    break;
                            } ?>"><?= strtoupper($feedback->getStatus()) ?></td>
                            <td><a href="Admin_FeedbackView?feedbackID=<?= urldecode($feedback->getFeedbackId()) ?>">
                                    <button class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>View
                                    </button>
                                </a>
                                <a href="Admin_FeedbackEdit?feedbackID=<?= urldecode($feedback->getFeedbackId()) ?>">
                                    <button class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php }
                } ?>

                </tbody>
            </table>


        </main>


    </div>
</div>


</body>


</html>
<style>
    .pending {
        color: orange;
    }

    .inProgress {
        color: #005eff;
    }

    .resolved {
        color: #27aa80;
    }

    .compensationOffered {
        color: #44b253;
    }

    .keyword-div{
        background-color: #2c3e50;
        padding: 5px;
        margin: 2px;
        color: aliceblue;
        border-radius: 10px;
    }
</style>
