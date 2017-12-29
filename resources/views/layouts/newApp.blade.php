<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,300);
    </style>
    <link rel="stylesheet" href="{{ asset('build/css/main-style.css') }}">
</head>
<body>
<div id="app">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }} hihi
    </form>
    <router-view></router-view>
</div>
</body>
<script>
    window.loggedUser = {!! auth()->user()  ? auth()->user() : ''!!}
</script>
@yield('script')
</html>
