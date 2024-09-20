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
        <!-- Sidebar -->
        <?php include "../app/views/adminSideBar.php"?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Edit Feedback</h1>

            <form class="main-content p-4 mt-3" style="
                      background-color: #ffffff;
                      border-radius: 8px;
                      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    " method="post" action="Admin_FeedbackEdit_Submit">
                <input type="hidden" name="feedbackID" value="<?= $data[0]->getFeedbackID() ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Received from</label>
                    <input type="text" class="form-control" id="title" value="<?= $data[0]->getUser()->getUserName() ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="feedback" class="form-label">Feedback</label>
                    <textarea class="form-control" id="feedback" rows="5" required
                              disabled><?= htmlspecialchars($data[0]->getContent(), ENT_QUOTES, 'UTF-8')  ?></textarea>
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
                    <select class="form-select" name="status" id="status" required <?php if ($data[0]->getStatus() == feedback_status::COMPENSATION_OFFERED){ echo "disabled";} ?> >
                        <option value="<?= feedback_status::PENDING ?>" <?php if($data[0]->getStatus() == feedback_status::PENDING){ echo "selected"; } ?>>Pending Review</option>
                        <option value="<?= feedback_status::IN_PROGRESS ?>" <?php if($data[0]->getStatus() == feedback_status::IN_PROGRESS){ echo "selected"; } ?>>In Progress</option>
                        <option value="<?= feedback_status::RESOLVED ?>" <?php if($data[0]->getStatus() == feedback_status::RESOLVED){ echo "selected"; } ?>>Resolved</option>
                        <option value="<?= feedback_status::COMPENSATION_OFFERED ?>" <?php if($data[0]->getStatus() == feedback_status::COMPENSATION_OFFERED){ echo "selected"; } ?>>Compensation Offered</option>
                    </select>
                    <?php  if (isset($data['error'])){ ?>
                    <span style="color: red">Invalid Status Flow</span>
                    <?php } ?>
                </div>

                <div class="stepper-wrapper">
                    <div class="stepper-item <?php if(!is_null($data[0]->getCreatedAt())){ echo "completed"; }?>">
                        <div class="step-counter">1</div>
                        <div class="step-name">Pending</div>
                        <div class="step-name"><?php if(!is_null($data[0]->getCreatedAt())){echo $data[0]->getCreatedAt()->format('Y-m-d');} ?></div>
                    </div>
                    <div class="stepper-item <?php if(!is_null($data[0]->getInProgressAt())){ echo "completed"; }?>">
                        <div class="step-counter">2</div>
                        <div class="step-name">In Progress</div>
                        <div class="step-name"><?php if(!is_null($data[0]->getInProgressAt())){echo $data[0]->getCreatedAt()->format('Y-m-d');} ?></div>
                    </div>
                    <div class="stepper-item <?php if(!is_null($data[0]->getResolvedAt())){ echo "completed"; }?>">
                        <div class="step-counter">3</div>
                        <div class="step-name">Resolved</div>
                        <div class="step-name"><?php if(!is_null($data[0]->getResolvedAt())){echo $data[0]->getCreatedAt()->format('Y-m-d');} ?></div>
                    </div>
                    <div class="stepper-item <?php if(!is_null($data[0]->getCompensationOfferedAt())){ echo "completed"; }?>">
                        <div class="step-counter">4</div>
                        <div class="step-name">Compensation Offered</div>
                        <div class="step-name"><?php if(!is_null($data[0]->getCompensationOfferedAt())){echo $data[0]->getCreatedAt()->format('Y-m-d');} ?></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="reply" class="form-label">Reply</label>
                    <textarea class="form-control" id="reply" name="reply" rows="5"><?= $data[0]->getReply() ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="coinCompensation" class="form-label">Coin Compensation</label>
                    <input type="number" class="form-control" id="coinCompensation" name="coinCompensation" value="<?= $data[0]->getCoinCompensation() ?>"  <?php if ($data[0]->getStatus() == feedback_status::COMPENSATION_OFFERED){echo "disabled";} ?>/>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="Admin_FeedbackIndex"><div class="btn btn-danger">Back</div></a>
            </form>

        </main>
    </div>
</div>

<!--JavaScripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>

<style>
    .stepper-wrapper {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;

        @media (max-width: 768px) {
            font-size: 12px;
        }
    }

    .stepper-item::before {
        position: absolute;
        content: "";
        border-bottom: 2px solid #ccc;
        width: 100%;
        top: 20px;
        left: -50%;
        z-index: 2;
    }

    .stepper-item::after {
        position: absolute;
        content: "";
        border-bottom: 2px solid #ccc;
        width: 100%;
        top: 20px;
        left: 50%;
        z-index: 2;
    }

    .stepper-item .step-counter {
        position: relative;
        z-index: 5;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ccc;
        margin-bottom: 6px;
    }

    .stepper-item.active {
        font-weight: bold;
    }

    .stepper-item.completed .step-counter {
        background-color: #4bb543;
    }

    .stepper-item.completed::after {
        position: absolute;
        content: "";
        border-bottom: 2px solid #4bb543;
        width: 100%;
        top: 20px;
        left: 50%;
        z-index: 3;
    }

    .stepper-item:first-child::before {
        content: none;
    }
    .stepper-item:last-child::after {
        content: none;
    }
</style>
