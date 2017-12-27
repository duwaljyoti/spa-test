<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,300);
    </style>
    <link rel="stylesheet" href="{{ asset('build/css/main-style.css') }}">
    {{----}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.js"></script>
    {{----}}
</head>
<body>
<div id="userApp">
    <router-view></router-view>
</div>
</body>
<script src="{{ mix('build/js/userApp.js') }}"></script>
</html>
