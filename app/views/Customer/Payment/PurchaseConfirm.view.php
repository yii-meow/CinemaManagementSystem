<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html,
        body {
            min-height: 100vh;
            max-width: 100%;
            font-family: 'Poppins';
            background-color: #141414;
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            z-index: -1;
        }

        html {
            overflow-y: hidden;
        }

        .container {
            border-radius: 10px;
            padding: 10px;
            width: 700px;
            height: 454px;
            background-color: #292929;
            position: relative;
            margin-top: -10px;
        }

        .container:before {
            content: "";
            z-index: -1;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(-103deg, #f89b29 0%, #ff0f7b 100%);
            transform: translate3d(-3px, -1px, 0) scale(0.99);
            filter: blur(20px);
            opacity: var(0.51);
            transition: opacity 0.3s;
            border-radius: inherit;
        }

        .container::after {
            content: "";
            z-index: -1;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: inherit;
            border-radius: inherit;
        }

        .mainmessage,
        .submessage {
            text-align: center;
        }

        .mainmessage {
            font-weight: bold;
            font-size: 22px;
            color: white
        }

        .submessage {
            margin-top: 7px;
            color: #a8a8a8;
            font-size: 14px;
        }

        .btn-container {
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            width: 100%;
            padding-top: 25px;
            gap: 10px;
        }

        .btn {
            font-size: 12px;
            padding: 10px 60px 10px 60px;
            font-weight: bold;
        }

        .real-content {
            padding: 40px;
        }

        .continue-btn {
            background-color: #f03351;
            color: white;
        }

        .continue-btn:hover,
        .continue-btn:active {
            background-color: white;
            color: #f03351;
        }


        .btn-view{
            background-color: white;
            color:#f03351;
        }

        .btn-view:hover {
            background-color: #f03351;
            color:white;
        }

        .real-content {
            height: 5px;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.6s linear;
        }

        .real-show {
            height: auto;
            visibility: visible;
            opacity: 1;
        }

        .loading-content {
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            height: inherit;
            gap: 7px;
        }

        .t1 {
            color: #f7d2ad;
        }

        .t2 {
            color: #fac38c;
        }

        .t3 {
            color: #faac5f;
        }

        .t4 {
            color: #f79431;
        }

        .t5 {
            color: #f78411;
        }
    </style>

    <title>Payment Successful</title>
    <link rel="icon" type="image/x-icon" href="../../../../public/images/icon.png" />
</head>

<body>

    <div id="form1">

        <div class="container" id="container">
            <div class="loading-content" id="loading-content">
                <div class="spinner-grow t1" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow t2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow t2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow t3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow t4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow t5" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="real-content" id="real">
                <div class="checkmark" style="display: flex; flex-flow: row nowrap; justify-content: center;">
                    <img style="width: 60%; margin-bottom: 8px;" src="../../../../public/images/checkmark.png" />
                </div>
                <div class="mainmessage">
                    Thank you for booking!
                </div>
                <div class="submessage">
                    Your booking number is 
                    <span style="color: #f03351;" id="lblOrderID">#20233101</span>.
                    <br />
                    Your e-ticket QR code has been generated! 
                </div>
                <div class="btn-container">
                    <div class="view-order">
                        <button id="btnCheckOrderStatus" class="btn border btn-view" onclick="">VIEW TICKET</button>
                    </div>
                    <div class="continue">
                        <button class="btn continue-btn" onclick="location.href='../Movie/MovieCategory.html'">BACK TO HOME</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        setTimeout(function () {
            document.getElementById("loading-content").style.display = "none";
            document.getElementById("real").classList.add("real-show");
        }, 800)
    </script>
</body>

</html>