<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
        <title>@yield('title')</title>
    </head>
  <body>
    <main>
        @include('layouts.header-ip')
        @yield('container')
    </main>
    <footer>
        @include('layouts.footer-ip')
    </footer>
  </body>
</html>