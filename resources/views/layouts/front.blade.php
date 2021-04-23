<!doctype html>
<html lang="en">

  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('includes.frontend.styles')

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

    @include('includes.frontend.header')

    @yield('content')

    

    @include('includes.frontend.footer')

    </div>

    @include('includes.frontend.scripts')

  </body>

</html>

