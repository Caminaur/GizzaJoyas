{{-- Aqui comienza la navbar sticky --}}

        {{-- navbar principal --}}
        <nav class="cbp-af-header uk-flex uk-flex-column" uk-navbar>

          {{-- 1er piso de la nav - between --}}
          <div class="uk-flex uk-flex-middle uk-flex-between my-3">

            {{-- Searchs --}}
            <div>

              {{-- Search desktop, se muestra en resoluciones M o mayores (959px)--}}
              <form class="uk-visible@m uk-search uk-search-default uk-margin-left">
                <span uk-search-icon></span>
                <input class="uk-search-input" type="search" placeholder="Buscar...">
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
            <div class="pt-3">

              <a class="uk-navbar-item uk-logo uk-flex-column" href="/"><span class="cbp-af-header gizza text-center">GIZZA</span></a><span class="joyas text-center mt-2">Joyas - Relojes</span>

            </div>

            {{-- Lado derecho --}}
            <div>

              {{-- Items del lado derecho de la nav solo son visibles en resoluciones mayores 959px (M) --}}
              <ul class="uk-visible@m uk-navbar-nav uk-nav-parent-icon uk-margin-right">

              @if (Auth::user())
                @if (Auth::user()->isAdmin == true)
                  <li><a class="navlink hvr-underline-from-center {{ request()->is('adminpanel') ? 'active' : '' }}" href="/adminpanel">Panel de Control</a></li>
                @endif

                <li><a class="navlink hvr-underline-from-center {{ request()->is('profile') ? 'active' : '' }}" href="/profile"><i class="fas fa-user"></i> {{auth::user()->name}}</a></li>
                <li class="nav-item">
                  <form class="" action="/logout" method="post">
                    @csrf
                    <button class="navlink hvr-underline-from-center" type="submit" name="button"><span> Cerrar Sesion</span></button>
                  </form>
                </li>

              @else

                <li><a class="navlink hvr-underline-from-center {{ request()->is('register') ? 'active' : '' }}" href="/register">Registrarse</a></li>
                <li><a class="navlink hvr-underline-from-center {{ request()->is('login') ? 'active' : '' }}" href="/login">Ingresar</a></li>

              @endif

                <li><a class="navlink" href="#asd2" offset="80" uk-scroll><span class="material-icons">local_mall</span></a></li>
              </ul>

              {{-- Menu hamburguesa, se muestra al bajar de 959px (M)--}}
              <ul class="uk-hidden@m uk-navbar-nav uk-nav-parent-icon">
                <li class="uk-visible-small"><a href="#navbarMobile"  class="burger" uk-navbar-toggle-icon uk-toggle uk-toggle="target: #offcanvas-push"></a></li>
              </ul>


            </div>

          </div>

          {{-- 2do piso de la nav - flex-center --}}
          <div class=" nav-categories uk-visible@m uk-flex uk-flex-center uk-flex-middle">


              {{-- Items del centro de la nav solo son visibles en resoluciones mayores o iguales a M (959px) --}}
              <ul class="cbp-af-header uk-visible@m uk-navbar-nav uk-nav-parent-icon">
                <li><a class="navlink blueSlate hvr-underline-from-center" href="/addproduct">Agregar producto</a></li>
                <li><a class="navlink blueSlate hvr-underline-from-center" href="/editproduct/21">Editar producto</a></li>
                <li>
                  <a class="navlink blueSlate hvr-underline-from-center {{ request()->is('productos') ? 'active' : '' }}" href="#asd" offset="80" uk-scroll>Productos<span uk-icon="icon: triangle-down"></span></a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                      <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                          <div>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active"><a href="#">Active</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-header">Header</li>
                                  <li><a href="#">Item</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-divider"></li>
                                  <li><a href="#">Item</a></li>
                              </ul>
                          </div>
                          <div>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active"><a href="#">Active</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-header">Header</li>
                                  <li><a href="#">Item</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-divider"></li>
                                  <li><a href="#">Item</a></li>
                              </ul>
                          </div>
                          <div>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active"><a href="#">Active</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-header">Header</li>
                                  <li><a href="#">Item</a></li>
                                  <li><a href="#">Item</a></li>
                                  <li class="uk-nav-divider"></li>
                                  <li><a href="#">Item</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                </li>
                <li><a class="navlink hvr-underline-from-center {{ request()->is('faqs') ? 'active' : '' }}" href="#asd1">Como comprar</a></li>
                <li><a class="navlink hvr-underline-from-center {{ request()->is('nosotros') ? 'active' : '' }}" href="/nosotros">Nosotros</a></li>
                <li><a class="navlink hvr-underline-from-center {{ request()->is('contacto') ? 'active' : '' }}" href="/contacto">Contactanos</a></li>
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
