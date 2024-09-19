<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        h1 {
            font-size: 80px;
            margin: 0;
            color: #ff0000;
            text-shadow: 0px 0px 10px #ff0000;
        }

        p {
            font-size: 24px;
            margin: 20px 0;
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
<p class="message">You do not have permission to access this page.</p>
<button class="button" onclick="window.history.back();">Back to Previous Page</button>
</body>

</html>