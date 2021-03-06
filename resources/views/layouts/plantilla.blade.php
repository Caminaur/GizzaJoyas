<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    @include('partials.links')
    <link rel="stylesheet" href="/css/@yield('css').css">

    <title>@yield('titulo')</title>
    {{-- <link rel="stylesheet" href="/css/@yield('css').css">  Para agregar un css a una vista en particular --}}
    @yield('scripts') {{-- Para agregar JS a una vista en particular --}}


    <!-- Script necesario para el funcionamiento del CAPTCHA 
    <script src='https://www.google.com/recaptcha/api.js'></script>
    -->
  </head>
  <body>

    <header>

      {{-- Navbar --}}

      @include('partials.navbar')


      {{-- Promotions --}}

      @include('partials.promotions')

    </header>


    <main id="main">

      {{-- Notificaciones --}}
      @if (session('status'))
        <div class="wow animated fadeInDown alert alert-success sticky-notification">
          {{session('status')}}
        </div>
      @endif

      @if (session('error'))
        <div class="wow animated fadeInDown alert alert-success sticky-notification notification-error">
          {{session('error')}}
        </div>
      @endif


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
