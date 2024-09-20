<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used */
             background-image: url("homepg.jpg"); 

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .centered {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .centered h1 {
            font-size: 80px;
            line-height: 70px;
            font-weight: bold;
            max-width: 650px;
            color: black;
            font-family: Papyrus, fantasy;
        }

        .centered h3 {
            font-size: 30px;
            font-weight: 400;
            margin-bottom: 60px;
            color: black;
            font-family: cursive;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: black;
            color: whitesmoke;
            border: none;
            padding: 10px 20px;
            margin: 0 50px;
            border-radius: 5px;
            text-decoration: none;
            font-family: cursive;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="bg"></div>
    <div class="centered">

        <h1>OrchidTechies</h1>
        <h3>“ Make a Network in your College ”</h3>

        <div class="button-container">
            <a href="std_signup.php" class="button">Let's Go...</a>
           
        </div>

    </div>
</body>

</html>