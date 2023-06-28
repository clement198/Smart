<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<p id="countdown"></p>

    <!-- Days Countdown -->

    <?php
    $due_date = date('2023-06-24');
    $time = date('00:00:00');
    $count_date = $due_date . ' ' . $time;
    ?>

    <script type="text/javascript">
        // Take date from php variable
        var project_date = "<?php echo $count_date; ?>";
        var countDownDate = new Date(project_date).getTime();
        //Update the count down for every second 
        var x = setInterval(function() {
            //Get latest date
            var now = new Date().getTime();
            //Get the distance between latest date and the countdown date
            var distance = countDownDate - now;

            //Count Time 
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));

            document.getElementById("countdown").innerHTML = days + " Days " + hours + " Hours " + "left";

            if (distance < 2) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Due!!!";
            }

        }, 1000);

        

    </script>
    <div class="container">
        <div class="progress progress-striped">
            <div class="progress-bar">
                
            </div>
        </div>
    </div>

    <style>

        .container {
            margin: 100px auto;
            width: 300px;
            text-align: center;
        }

        .progress {
            padding: 6px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 6px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
        }

        .progress-bar {
            height: 15px;
            background-color: #ee303c;
            border-radius: 4px;
            transition: 0.4s linear;
            transition-property: width, background-color;
        }

        .progress-bar {
            background-color: #FCBC51;
            width: 0;
            background-image: linear-gradient(45deg, rgb(252, 163, 17) 25%,
                    transparent 25%, transparent 50%,
                    rgb(252, 163, 17) 50%, rgb(252, 163, 17) 75%,
                    transparent 75%, transparent);
            animation: progressAnimationStrike 6s;
        }

        /* @keyframes progressAnimationStrike {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        } */
    </style>

    <script>
        var countdown = countDownDate - new Date().getTime();
        var start = new Date(2023,06,15);
        var end = new Date(2023,06,25);
        var today = new Date(2023,06,25);

        var startEnd = (end - start);
        var startToday = (today - start);
        var percentage = Math.round(startToday / startEnd * 100)
        var container = document.querySelector('.progress-bar');
        container.style.width = percentage + "%";
        if(percentage == 100){
            container.style.background = "red";
        }
    </script>
</body>

</html>