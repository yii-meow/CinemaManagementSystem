<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css" />
    <title>Reward Details</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>


        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Reward Details</h1>

            <!-- Display Reward Details -->
            <form id="rewardDetailsForm" class="main-content p-4 mt-3" style="
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                ">
                <div class="mb-3">
                    <label for="rewardID" class="form-label">Reward ID</label>
                    <input type="text" class="form-control" id="rewardID" value="R001" required disabled />
                </div>

                <div class="mb-3">
                    <label for="rewardTitle" class="form-label">Reward Title</label>
                    <input type="text" class="form-control" id="rewardTitle" value="Free Movie Ticket" required
                           disabled />
                </div>

                <div class="mb-3">
                    <label for="rewardCategory" class="form-label">Category</label>
                    <input type="text" class="form-control" id="rewardCategory" value="Entertainment" required
                           disabled />
                </div>

                <div class="mb-3">
                    <label for="rewardImage" class="form-label">Reward Image</label>
                    <div class="d-flex align-items-center">
                        <img src="../../Media/Image/defaultProfile.jpg" alt="Reward Image"
                             class="img-thumbnail me-3" style="width: 100px; height: 100px;" />
                        <!-- Optionally include an option to update the image -->
                        <input type="file" class="form-control" id="rewardImage" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rewardDetails" class="form-label">Details</label>
                    <textarea class="form-control" id="rewardDetails" rows="3" required
                              disabled>Free movie ticket valid for any movie.</textarea>
                </div>

                <div class="mb-3">
                    <label for="rewardDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="rewardDescription" rows="3" required
                              disabled>This reward can be redeemed at any cinema branch.</textarea>
                </div>

                <div class="mb-3">
                    <label for="rewardQty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="rewardQty" value="10" required disabled />
                </div>

                <div class="mb-3">
                    <label for="neededCoins" class="form-label">Needed Coins</label>
                    <input type="number" class="form-control" id="neededCoins" value="50" required disabled />
                </div>

                <br>

                <div class="d-md-block justify-content-between">
                    <a href="RewardManage.html" class="btn btn-primary">Back</a>
                    <button type="button" class="btn btn-secondary" id="editButton">Edit</button>
                    <button type="submit" class="btn btn-success d-none" id="saveButton">Save</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </form>
        </main>
    </div>
</div>
<br>

<script>
    // When the Edit button is clicked, enable form fields for editing
    document.getElementById("editButton").addEventListener("click", function () {
        document.getElementById("rewardTitle").disabled = false;
        document.getElementById("rewardCategory").disabled = false;
        document.getElementById("rewardDetails").disabled = false;
        document.getElementById("rewardDescription").disabled = false;
        document.getElementById("rewardQty").disabled = false;
        document.getElementById("neededCoins").disabled = false;

        // Show the Save button and hide the Edit button
        document.getElementById("saveButton").classList.remove("d-none");
        document.getElementById("editButton").classList.add("d-none");
    });

    // Additional save logic can go here
    document.getElementById("rewardDetailsForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Implement save functionality here

        // Disable fields after saving
        document.getElementById("rewardTitle").disabled = true;
        document.getElementById("rewardCategory").disabled = true;
        document.getElementById("rewardDetails").disabled = true;
        document.getElementById("rewardDescription").disabled = true;
        document.getElementById("rewardQty").disabled = true;
        document.getElementById("neededCoins").disabled = true;

        // Reset the buttons
        document.getElementById("saveButton").classList.add("d-none");
        document.getElementById("editButton").classList.remove("d-none");
    });

    // Handle Delete button click
    document.getElementById("deleteButton").addEventListener("click", function () {
        if (confirm("Are you sure you want to delete this reward?")) {
            // Implement delete functionality here
            alert("Reward deleted successfully.");
            // Redirect or update the page as needed
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>