<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Nikah Time</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <link rel="icon" href="{{asset('favicon.ico')}}"/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="{{asset('css/jquery.countdown.css')}}"/>

    <!--fonts-->
    <link
        href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!--//fonts-->
</head>
<body>
<div class="agile">
    <div class="container">
        <h1>Nikah Time</h1>

        <div class="clear-loading logo">
            <img src="{{asset('images/logo.png')}}" alt="логотип">
        </div>

        <h4>Первый международный центр создания семьи Ханума Ханым для татар со всего мира в ноябре этого года запускает уникальное мобильное приложение NikahTime! Центр семьи активно работает с 2010 г. в Казани и уже помог найти родного человека нескольким тысячам человек. Целями приложения являются предоставление более масштабного выбора кандидатов, организация тёплых встреч. Свахи центра всегда будут рядом с вами. Для бесплатного пользования функционалом приложения просим Вас в срок до 22:00 часов 30.11.2021 года актуализировать свои анкетные данные, <a href ="https://sms.ru/2naHG" target="_blank" style="color: #00de9b; font-size: 17px; border-bottom: 1px #00de9b solid;">перейдя по ссылке</a>.
            <div>С уважением, Директор международного центра создания семьи Наиля Ханум Зиганшина.</div>
            <div>Да поможет нам Аллах!</div>
            <div>По всем возникающим  вопросам можно обращаться на e-mail: <p  style="color: #00de9b; font-size: 17px;">nikahtime@bk.ru</p></div></h4>
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
                <div class="clear"></div>
            </div>

        </div>
        <!--//timer-->

        <h3>Мы Вас ждем в Nikah Time, заполните анкету и присоединяйтесь!</h3>

        <div style="margin: 0 0 25px 0"><a href="https://docs.google.com/forms/d/e/1FAIpQLSegOFmhAL66m2I58lkNwWz1PKLGwODSA8vJRLz1IP1natBF8A/viewform"
                                           target="_blank" style="color: #00de9b; font-size: 22px; border-bottom: 1px #00de9b solid;">Заполнить анкету</a></div>
        <div><a href="/privacy/policy" style="color: white">Политика конфиденциальности</a></div>
        <div><a href="/user/agreement" style="color: white">Пользовательское соглашение</a></div>
    </div>
</div>
<!--scripts-->
<script type="text/javascript" src=" {{asset('js/moment.js')}}"></script>
<script type="text/javascript" src=" {{asset('js/moment-timezone-with-data.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<!--//scripts-->
</body>
</html>
