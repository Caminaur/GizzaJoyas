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


              <a class="uk-navbar-item uk-logo uk-flex-column" uk-scroll href="/"><span class="cbp-af-header gizza text-center">Gizza</span>{{--<span class="cbp-af-header joyas text-center mt-3">Joyas</span>--}}</a><!--<span class="cbp-af-header hidden">Escondido</span>-->

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
          <div class=" nav-categories uk-visible@m uk-flex uk-flex-center uk-flex-middle mt-3">


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

      {{-- Fin Navbar offcanvas --}}
