<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <link rel="icon" href="{{asset('favicon.ico')}}"/>
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="{{asset('css/jquery.countdown.css')}}"/>

    <!--fonts-->
    <link
        href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!--//fonts-->
    <title>Поддержка Nikah Time</title>
</head>

<body>
<h1>Поддержка Nikah Time</h1>
<div class="container" style="margin: 0 0 25px 0">
    <form style="margin: 0 auto; max-width: 400px;">
        <h3>Тема</h3>
        <input type="text" name="topic" size="54"/>
        <h3>ФИО</h3>
        <input type="text" name="name"size="54"/>
        <h3>Сообщение</h3>
        <input type="text" name="message" size="54"/>
        <div style="text-align: center;"><input type="button" value="Отправить" style="margin-top: 30px"></div>
    </form>
</div>
</body>
</html>
