<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Note App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .component-header {
                padding-bottom: 34px;
                padding-top: 34px;
            }
            li .options{
                cursor: pointer;
            }
            li:hover .options{
                margin-right:20px;
                font-size: 15px;
            }
            .glyphicon {
                margin-right: 20px;
            }
            .header-nav > a {
                padding-right: 20px;
            }
            .header-nav {
                padding: 20px;
                text-align: left;
            }
            body {
                font-size: 16px;
                font-weight: 600;
            }
            .note-form {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
    <div class="container">
    <div id="app" class="flex-center position-ref full-height">
    </div>
    </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
