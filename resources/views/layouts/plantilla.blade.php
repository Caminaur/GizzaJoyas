<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

    @include('partials.links')

    @yield('links') {{-- Para agregar CSS a una vista en particular --}}

    <title>@yield('titulo')</title>
    {{-- <link rel="stylesheet" href="/css/@yield('css').css">  Para agregar un css a una vista en particular --}}
    @yield('scripts') {{-- Para agregar JS a una vista en particular --}}

  </head>
  <body>

    <header>

      {{-- Navbar --}}

      @include('partials.navbar')


      {{-- Promotions --}}

      @include('partials.promotions')

    </header>


    <main id="main">


      @yield('main')


    </main>

    <footer>

      {{-- Footer --}}

      @include('partials.footer')

    </footer>

    {{-- Social Bar --}}

    @include('partials.socialbar')



    {{-- Scripts --}}

    @include('partials.scripts')

  </body>
</html>
