<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Report Manage</title>
    <style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .main-content {
            padding: 20px;
        }

        .main-content h2 {
            margin-top: 0;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar">
            <h4 class="text-center mt-3">Report Manage</h4>
            <div class="list-group">
                <a href="userReport" class="list-group-item list-group-item-action">
                    <i class="fas fa-user me-2"></i> User Report
                </a>
                <a href="AdminProfile" class="list-group-item list-group-item-action">
                    <i class="fas fa-user-alt me-2"></i> Back to Profile
                </a>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <h2>Welcome to Report Manage</h2>
            <p>Select an option from the sidebar to view different reports.</p>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>