<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>403 Forbidden</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Audiowide&display=swap');

        html,
        body {
            margin: 0;
            height: 100%;
            overflow: hidden;
            background: radial-gradient(circle, #330000 0%, #000000 100%);
            color: #ffffff;
            font-family: Audiowide, sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 50px;
        }

        h1 {
            font-size: 120px;
            margin: 0;
            color: #ff0000;
            text-shadow: 0px 0px 10px #ff0000;
        }

        p {
            font-size: 24px;
            margin: 50px 0;
        }

        .message {
            font-size: 20px;
            color: #ffffff;
        }
    </style>
</head>

<body>
<h1>403</h1>
<p class="message">Permission Denied</p>
<p class="message mb-2">You do not have permission to access this page.</p>
<p class="message mt-4 text-danger">You will be redirected to the login page in 5 seconds...</p>
<a href="<?= ROOT ?>/LoginStaff">
    <button class="btn btn-danger mt-4">Back to Login Page</button>
</a>

<script>
    setTimeout(function () {
        window.location.href = '<?= ROOT ?>/LoginStaff';
    }, 5000);
</script>
</body>

</html>