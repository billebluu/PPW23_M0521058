<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
        <title>@yield('title')</title>
    </head>
  <body>
    <main>
        @include('layouts.header-details')
        @yield('container')
    </main>
    <footer>
        @include('layouts.footer-details')
    </footer>
  </body>
</html>