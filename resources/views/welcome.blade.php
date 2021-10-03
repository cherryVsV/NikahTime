<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Nikah Time</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{asset('css/jquery.countdown.css')}}" />
    <!--fonts-->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <!--//fonts-->
</head>
<body>
<div class="agile">
    <div class="container">
        <h1>Nikah Time</h1>

        <div class="clear-loading logo">
            <img src="{{asset('images/logo.png')}}" alt="логотип">
        </div>

        <div class="wthree-info">
            <h2>Nikah Time находится в разработке!</h2>
        </div>
        <!--timer-->
        <div class="agileits-timer">
            <div class="clock">
                <div class="column days">
                    <div class="timer" id="days"></div>
                    <div class="text">ДНИ</div>
                </div>
                <div class="timer days"></div>
                <div class="column">
                    <div class="timer" id="hours"></div>
                    <div class="text">ЧАСЫ</div>
                </div>
                <div class="timer"></div>
                <div class="column">
                    <div class="timer" id="minutes"></div>
                    <div class="text">МИНУТЫ</div>
                </div>
                <div class="timer"></div>
                <div class="column">
                    <div class="timer" id="seconds"></div>
                    <div class="text">СЕКУНДЫ</div>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
        <!--//timer-->

    </div>
</div>
<!--scripts-->
<script type="text/javascript" src=" {{asset('js/moment.js')}}"></script>
<script type="text/javascript" src=" {{asset('js/moment-timezone-with-data.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<!--//scripts-->
</body>
</html>
