<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BE FAST | Kalahkan temanmu dalam adu ketik.</title>

    <link rel="stylesheet" href="./assets/css/w3.css" />
    <link rel="stylesheet" href="./assets/css/fonts.css" />
    <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.css" />
    <script src="./assets/js/loader.js"></script>
    <script src="./assets/js/ajax.js"></script>
</head>
<body onload="loader()">
    <!-- LOADER -->
    <div
        class="w3-display-container w3-display-topleft w3-display-topright w3-display-bottomleft w3-display-bottomright w3-blue"
        id="loader"
        style="position: fixed; z-index: 9">
        <div class="w3-display-middle">
            <center>
                <img src="./assets/image/loader.gif"/>
                <br>
                <br>
                Harap tunggu sebentar . . .
            </center>
        </div>
    </div>

    <!-- CONTAINER -->
    <div class="w3-display-container w3-display-topleft w3-display-topright w3-display-bottomleft w3-display-bottomright w3-blue"
        id="container"
        style="position: fixed; z-index: 1; background-image: url('./assets/image/background_image.jpg'); background-size: cover; background-position: center;">

        <?php
            session_start();
            if (isset($_SESSION["userAuth"])) require_once ("./pages/player.html");
            else require_once ("./pages/login.html");
        ?>

    </div>
</body>
</html>