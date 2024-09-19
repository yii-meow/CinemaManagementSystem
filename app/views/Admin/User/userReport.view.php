<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select User Report Type</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="back-button">
    <a href="ReportManage" class="btn btn-secondary">Back to Report Manage</a>
</div>
<div class="form-container">

    <h1>Select User Status to Generate Report</h1>
    <form action="userReport" method="POST">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="activeUsers" value="active" checked>
            <label class="form-check-label" for="activeUsers">
                Active Users
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="deactiveUsers" value="deactive">
            <label class="form-check-label" for="deactiveUsers">
                Deactive Users
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="bothUsers" value="Both">
            <label class="form-check-label" for="bothUsers">
                Both Active and Inactive Users
            </label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>