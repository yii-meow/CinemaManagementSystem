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
            background-color: #f0f2f5;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 20px;
            font-size: 1.75rem;
            font-weight: bold;
            color: #333;
        }
        .btn-secondary {
            margin-bottom: 20px;
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-check-label {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<!-- Back to Report Manage Button -->
<div class="d-flex justify-content-between mb-4">
    <a href="ReportManage" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Report Manage
    </a>
</div>
<div class="container">


    <h1>Select User Status to Generate Report</h1>
    <form action="userReport" method="POST">
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="status" id="activeUsers" value="active" checked>
            <label class="form-check-label" for="activeUsers">
                Active Users
            </label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="status" id="deactiveUsers" value="deactive">
            <label class="form-check-label" for="deactiveUsers">
                Deactive Users
            </label>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="status" id="bothUsers" value="Both">
            <label class="form-check-label" for="bothUsers">
                Both Active and Inactive Users
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Generate Report</button>
    </form>
</div>

<!-- FontAwesome (for the back button icon) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>