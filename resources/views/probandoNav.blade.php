<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <!-- Bootstrap --><link rel="stylesheet" href="/css/bootstrap.css">
    <!-- Icono del logo en pestana --><link rel="icon" type="image/png" href="/img/diamante.svg">
    <!-- Google Fonts --><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Mi css Animate --><link rel="stylesheet" href="/css/animate.css">
    <!-- Mi cssUIkit --><link rel="stylesheet" href="/css/uikit.css">
    <!-- Mi css General --><link rel="stylesheet" href="/css/styles.css">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.6/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.6/dist/js/uikit-icons.min.js"></script>
    <!-- Google API JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <!-- Wow JS -->
    <script src="/js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <!-- Navbar Shrink -->
    <script src="/js/classie.js"></script>
    <script src="/js/cbpAnimatedHeader.js"></script>
    <!-- Nuestro JS -->
    <script type="text/javascript" src="/js/funciones.js"></script>

    <title>Probando Nav</title>

  </head>
  <body>
    <header>
    {{-- Aqui comienza la navbar sticky --}}

            {{-- navbar principal --}}
            <nav class="cbp-af-header uk-navbar-container uk-navbar-transparent uk-flex uk-flex-column" uk-navbar>

              {{-- 1er piso de la nav - between --}}
              <div class="uk-flex uk-flex-between uk-flex-middle pt-4">

                {{-- Searchs --}}
                <div>

                  {{-- Search desktop, se muestra en resoluciones M o mayores (959px)--}}
                  <form class="uk-visible@m uk-search uk-search-default uk-margin-left">
                    <span uk-search-icon></span>
                    <input class="uk-search-input" type="search" placeholder="Search...">
                  </form>


                  {{-- Search tablets-mobile, se oculta en 639px y mayores (M) y en 520px y menores (XS) ALTERNATIVO--}}
                  <div class="hiddenXS uk-hidden@m">
                    <a class="uk-navbar-toggle" uk-search-icon href="#"></a>
                    <div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">
                      <form class="uk-search uk-search-navbar uk-width-1-1">
                        <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
                      </form>
                    </div>
                  </div>


                  {{-- Search tablets-mobile dropdown, Visible solo en XS (520px o menor) --}}
                  <div class="visibleSoloXS">
                    <a class="uk-navbar-toggle" href="#" uk-search-icon></a>
                    <div class="uk-navbar-dropdown" uk-drop="mode: click; cls-drop: uk-navbar-dropdown; boundary: !nav">

                      <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                          <form class="uk-search uk-search-navbar uk-width-1-1">
                            <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
                          </form>
                        </div>
                        <div class="uk-width-auto">
                          <a class="uk-navbar-dropdown-close" href="#" uk-close></a>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>

                {{-- logo --}}
                <div>


                  <a class="uk-navbar-item uk-logo uk-flex-column" uk-scroll href="/"><span class="cbp-af-header gizza text-center">Gizza</span><span class="cbp-af-header joyas text-center mt-3">Joyas</span></a><!--<span class="cbp-af-header hidden">Escondido</span>-->

                </div>

                {{-- Lado derecho --}}
                <div>

                  {{-- Items del lado derecho de la nav solo son visibles en resoluciones mayores 959px (M) --}}
                  <ul class="uk-visible@m uk-navbar-nav uk-nav-parent-icon uk-margin-right">
                    <li><a href="#asd" offset="80" uk-scroll>Registrarse</a></li>
                    <li><a href="#asd" offset="80" uk-scroll>Ingresar</a></li>
                    <li><a href="#asd2" offset="80" uk-scroll><span uk-icon="cart"></span></a></li>
                  </ul>

                  {{-- Menu hamburguesa, se muestra al bajar de 959px (M)--}}
                  <ul class="uk-hidden@m uk-navbar-nav uk-nav-parent-icon">
                    <li class="uk-visible-small"><a href="#navbarMobile"  uk-navbar-toggle-icon uk-toggle uk-toggle="target: #offcanvas-push"></a></li>
                  </ul>


                </div>

              </div>

              {{-- 2do piso de la nav - space-between --}}
              <div class=" nav-categories uk-visible@m uk-flex uk-flex-center uk-flex-middle my-3">


                  {{-- Items del centro de la nav solo son visibles en resoluciones mayores o iguales a M (959px) --}}
                  <ul class="cbp-af-header uk-visible@m uk-navbar-nav uk-nav-parent-icon">
                    <li><a href="#asd" offset="80" uk-scroll>Productos</a></li>
                    <li><a href="#asd1" offset="80" uk-scroll>Como comprar</a></li>
                    <li><a href="#asd2" offset="80" uk-scroll>Nosotros</a></li>
                    <li><a href="#asd2" offset="80" uk-scroll>Contactanos</a></li>
                  </ul>


              </div>


            </nav>

            {{-- Fin navbar principal --}}

          {{-- Al clickear en el menu hamburguesa aparece esta navbar --}}
          <div id="navbarMobile" uk-offcanvas="mode: push; overlay: true">

            <div class="uk-offcanvas-bar">
              <button class="uk-offcanvas-close" type="button" uk-close></button>

              <a class="uk-navbar-item uk-logo" uk-scroll href="#body">Logo</a>

              <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
                <li><a href="#asd" offset="80" uk-scroll>Item</a></li>
                <li><a href="#asd1" offset="80" uk-scroll>Item</a></li>
                <li><a href="#asd2" offset="80" uk-scroll>Item</a></li>


                <li><a href="#asd" offset="80" uk-scroll>Item</a></li>
                <li><a href="#asd1" offset="80" uk-scroll>Item</a></li>
                <li><a href="#asd2" offset="80" uk-scroll>Item</a></li>
              </ul>

            </div>
          </div>
            {{-- Fin navbar principal --}}

          </header>

          <section class="text-center">

            <a class="btn bg-doveGrey" href="#">Dove Grey</a>
            <a class="btn bg-ashBlue" href="#">Ash Blue</a>
            <a class="btn bg-dandelion" href="#">Dandelion</a>
            <a class="btn bg-blueSlate" href="#">Blue Slate</a>

            <br><br><br>

            <a class="btn border-doveGrey" href="#">Dove Grey</a>
            <a class="btn border-ashBlue" href="#">Ash Blue</a>
            <a class="btn border-dandelion" href="#">Dandelion</a>
            <a class="btn border-blueSlate" href="#">Blue Slate</a>

            <br><br><br>


            <h1 class="bold">Playfair Display H1 bold 32px </h1>
        		<h1 class="medium">Playfair Display H1 medium 32px</h1>
        		<h1 class="regular">Playfair Display H1 regular 32px</h1>

            <h2 class="regular">Playfair Display H2 regular 24px</h2>
            <h3 class="regular">Playfair Display H3 regular 18px</h3>

            <h4 class="bold">Source Sans Pro H4 bold 16px</h4>
        		<h4 class="regular">Source Sans Pro H4 regular 16px</h4>
        		<h4 class="light">Source Sans Pro H4 light 16px</h4>

            <h5 class="regular">Source Sans Pro H5 regular 13px</h5>
            <h6 class="regular">Source Sans Pro H5 regular 12px</h6>

            <p class="regular">Source Sans Pro Pregular 14px</p>

          </section>

          <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div>
              <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
              <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
              <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
          </div>

          <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/aros.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Aros</h4></div>
    	          </div>
    	        </div>
    	      </div>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/pulseras.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Pulseras</h4></div>
    	          </div>
    	        </div>
    	      </div>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/collares.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Collares</h4></div>
    	          </div>
    	        </div>
    	      </div>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/anillos.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Anillos</h4></div>
    	          </div>
    	        </div>
    	      </div>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/relojes.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Relojes</h4></div>
    	          </div>
    	        </div>
    	      </div>

    				<div>
    	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
    	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/accesorios.jpg" alt="">
    	          <div class="uk-position-center">
    	              <div class="uk-light"><h4 class="uk-margin-remove">Accesorios</h4></div>
    	          </div>
    	        </div>
    	      </div>

    			</div>



  </body>
</html>
