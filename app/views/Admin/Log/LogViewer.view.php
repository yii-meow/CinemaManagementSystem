<html>
<!--
/**
 * @author Chong Yik Soon
 */
 -->
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
    />
    <link
            href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
            rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
            href="https://fonts.googleapis.com/css?family=Poppins"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
            integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Cinema Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-file-alt me-3"></i>Important Logs
                </h1>
            </div>

            <div class="mb-4">
                <form action="" method="get" class="d-flex">
                    <select name="date" class="form-select me-2" style="width: auto;">
                        <?php foreach ($logDates as $date): ?>
                            <option value="<?php echo $date; ?>" <?php echo $date === $selectedDate ? 'selected' : ''; ?>>
                                <?php echo $date; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">View Logs</button>
                </form>
            </div>

            <?php if (empty($logs)): ?>
                <div class="alert alert-info" role="alert">
                    No logs found for the selected date.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Level</th>
                            <th>Message</th>
                            <th>Context</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['datetime']); ?></td>
                                <td>
                                        <span class="badge bg-<?php echo getLevelBadgeColor($log['level_name']); ?>">
                                            <?php echo htmlspecialchars($log['level_name']); ?>
                                        </span>
                                </td>
                                <td><?php echo htmlspecialchars($log['message']); ?></td>
                                <td>
                                    <?php if (is_array($log['context'])): ?>
                                        <pre><code><?php echo htmlspecialchars(json_encode($log['context'], JSON_PRETTY_PRINT)); ?></code></pre>
                                    <?php else: ?>
                                        <?php echo htmlspecialchars($log['context']); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function getLevelBadgeColor($level) {
    switch ($level) {
        case 'DEBUG':
            return 'secondary';
        case 'INFO':
            return 'info';
        case 'NOTICE':
            return 'light';
        case 'WARNING':
            return 'warning';
        case 'ERROR':
            return 'danger';
        case 'CRITICAL':
        case 'ALERT':
        case 'EMERGENCY':
            return 'dark';
        default:
            return 'primary';
    }
}

function formatContext($context) {
    if (is_array($context)) {
        $pairs = [];
        foreach ($context as $key => $value) {
            $pairs[] = htmlspecialchars($key) . ': ' . htmlspecialchars($value);
        }
        return implode(', ', $pairs);
    } else {
        return htmlspecialchars($context);
    }
}
?>
