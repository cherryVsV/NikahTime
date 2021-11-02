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
                <div class="clear"></div>
            </div>
        </div>
<div id="app">
            <input type="file" id="myFile">
</div>
        <!--//timer-->


    </div>
</div>
<!--scripts-->
<script type="text/javascript" src=" {{asset('js/moment.js')}}"></script>
<script type="text/javascript" src=" {{asset('js/moment-timezone-with-data.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script>

    var input = document.getElementById('myFile');

    input.addEventListener("change", function(e) {
        var file = e.target.files[0]

        // Create a new tus upload
        var upload = new tus.Upload(file, {
            // Endpoint is the upload creation URL from your tus server
            endpoint: "http://127.0.0.1:1080/video/",
            // Retry delays will enable tus-js-client to automatically retry on errors
            retryDelays: [0, 3000, 5000, 10000, 20000],
            // Attach additional meta data about the file for the server
            metadata: {
                filename: file.name,
                filetype: file.type
            },
            // Callback for errors which cannot be fixed using retries
            onError: function(error) {
                console.log("Failed because: " + error)
            },
            // Callback for reporting upload progress
            onProgress: function(bytesUploaded, bytesTotal) {
                var percentage = (bytesUploaded / bytesTotal * 100).toFixed(2)
                console.log(bytesUploaded, bytesTotal, percentage + "%")
            },
            // Callback for once the upload is completed
            onSuccess: function() {
                console.log("Download %s from %s", upload.file.name, upload.url)
            }
        })

        // Check if there are any previous uploads to continue.
        upload.findPreviousUploads().then(function (previousUploads) {
            // Found previous uploads so we select the first one.
            if (previousUploads.length) {
                upload.resumeFromPreviousUpload(previousUploads[0])
            }

            // Start the upload
            upload.start()
        })
    });
</script>

<!--//scripts-->
</body>
</html>
