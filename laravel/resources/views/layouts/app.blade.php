<!doctype html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
  </head>
  <body>
      @yield('content')
      <script src="{{ asset('js/widget.js') }}"></script>
  </body>
</html>
