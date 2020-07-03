@extends('layouts.plantilla')
@section('titulo')
Gizza Joyas Home
@endsection
@section('main')

	<section id="hero" class="container-fluid">

		{{-- Imagen fija de fondo con 3 botones, un h1 y un h3 --}}

		{{-- <div class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-background-cover uk-light uk-background-blend-darken" uk-height-viewport ="offset-top: true" data-src="img/extras/4.jpg" uk-img>
			<h1 class="bold mb-3">Background Image</h1>
			<h3 class="medium mb-5">Descripcion de lo que vamos a poner aca, 50% off Sale</h3>
				<div class="">
					<a class="btn bg-dandelion mx-1" href="#">Dandelion</a>
					<a class="btn bg-ashBlue mx-1" href="#">Ash Blue</a>
				</div>

			<a class="btn bg-blueSlate mt-1" href="#">Blue Slate</a>
		</div> --}}

		{{-- Slider Hero con 4 imagenes de fondo y cada una con su texto y boton --}}

		<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider autoplay="true">

    <ul class="uk-slider-items uk-grid uk-height-max-large uk-flex-middle uk-background-cover">
        <li class="uk-width-1-1">
            <div class="uk-panel">
                <img src="/img/extras/4.jpg" alt="">
                <div class="uk-position-center uk-text-center px-2">
									<h1 class="bold mb-3" uk-slider-parallax="x: 100,-100">Background Image</h1>
									<h3 class="medium mb-5" uk-slider-parallax="x: 200,-200">Descripcion de lo que vamos a poner aca, 50% off Sale</h3>
									<a class="btn bg-dandelion mx-1" href="#">Dandelion</a>
									<a class="btn bg-ashBlue mx-1" href="#">Ash Blue</a>
                </div>
            </div>
        </li>
        <li class="uk-width-1-1">
            <div class="uk-panel">
                <img src="/img/extras/hero2.jpg" alt="">
                <div class="uk-position-center uk-text-center px-2">
									<h1 class="bold mb-3" uk-slider-parallax="x: 100,-100">Background Image</h1>
									<h3 class="medium mb-5" uk-slider-parallax="x: 200,-200">Descripcion de lo que vamos a poner aca, 50% off Sale</h3>
									<a class="btn bg-dandelion mx-1" href="#">Dandelion</a>
									<a class="btn bg-ashBlue mx-1" href="#">Ash Blue</a>
                </div>
            </div>
        </li>
        <li class="uk-width-1-1">
            <div class="uk-panel">
                <img src="/img/extras/hero3.jpg" alt="">
                <div class="uk-position-center uk-text-center px-2">
									<h1 class="bold mb-3" uk-slider-parallax="x: 100,-100">Background Image</h1>
									<h3 class="medium mb-5" uk-slider-parallax="x: 200,-200">Descripcion de lo que vamos a poner aca, 50% off Sale</h3>
									<a class="btn bg-dandelion mx-1" href="#">Dandelion</a>
									<a class="btn bg-ashBlue mx-1" href="#">Ash Blue</a>
                </div>
            </div>
        </li>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

	</section>

	<section id="categories" class="uk-container-extend uk-background-muted p-4">

		<h2 class="regular text-center pb-3">Mirá nuestras <span class="bold blueSlate">Categorías</span></h2>


			<div class="uk-child-width-1-2 uk-child-width-1-3@m" uk-grid>

				@forelse ($categories as $category)
					<div>
						<div class="uk-inline-clip uk-transition-toggle" tabindex="0">
							<a href="productos/categoria/{{$category->name}}">
                <img class="brightness uk-transition-scale-up uk-transition-opaque" src="{{$category->image}}" alt="">
              </a>
							<div class="uk-position-center ncursor">
								<div class="uk-light"><h3 class="medium uk-margin-remove">{{$category->name}}</h3></div>
							</div>
						</div>
					</div>

				@empty
					<h3 class="regular text-center pb-3">No hay <span class="bold blueSlate">Categorías Existentes</span></h3>
				@endforelse

			</div>

	</section>

	<section id="newArrivals" class="p-4">

		<h2 class="regular text-center pb-3">Productos en <span class="bold blueSlate">Oferta</span></h2>

		<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m">
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>1</h1></div>
        </li>
        <li>
            <img src="img/accesorios.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>2</h1></div>
        </li>
        <li>
            <img src="img/collares.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>3</h1></div>
        </li>
        <li>
            <img src="img/relojes.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>4</h1></div>
        </li>
        <li>
            <img src="img/pulseras.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>5</h1></div>
        </li>
        <li>
            <img src="img/anillos.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>6</h1></div>
        </li>
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>7</h1></div>
        </li>
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>8</h1></div>
        </li>
        <li>
            <img src="img/accesorios.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>9</h1></div>
        </li>
        <li>
            <img src="img/relojes.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>10</h1></div>
        </li>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

	</section>

	<section id="newArrivals" class="p-4">

		<h2 class="regular text-center pb-3">Lo más <span class="bold blueSlate">Nuevo</span></h2>

		<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m">
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>1</h1></div>
        </li>
        <li>
            <img src="img/accesorios.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>2</h1></div>
        </li>
        <li>
            <img src="img/collares.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>3</h1></div>
        </li>
        <li>
            <img src="img/relojes.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>4</h1></div>
        </li>
        <li>
            <img src="img/pulseras.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>5</h1></div>
        </li>
        <li>
            <img src="img/anillos.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>6</h1></div>
        </li>
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>7</h1></div>
        </li>
        <li>
            <img src="img/aros.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>8</h1></div>
        </li>
        <li>
            <img src="img/accesorios.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>9</h1></div>
        </li>
        <li>
            <img src="img/relojes.jpg" alt="">
            <div class="uk-position-center uk-panel"><h1>10</h1></div>
        </li>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

	</section>

	<section id="info" class="uk-background-muted p-4">

		<div class="uk-section uk-section-small">
    <div class="uk-container">

        <div class="uk-grid-match uk-child-width-1-2 uk-child-width-1-4@m align-items-start" uk-grid>
            <div class="text-center">
								<p class="blueSlate bold">FREE SHIPPING</p>
								<i class="material-icons md-36 blueSlate">local_shipping</i>
                <p class="blueSlate regular">Free shipping on all US order or order above $200</p>
            </div>
            <div class="text-center">
							<p class="blueSlate bold">SUPPORT 24/7</p>
							<i class="material-icons md-36 blueSlate">face</i>
							<p class="blueSlate regular">Contact us 24 hours a day, 7 days a week</p>
            </div>
            <div class="text-center">
							<p class="blueSlate bold">30 DAYS RETURN</p>
							<i class="material-icons md-36 blueSlate">assignment_return</i>
							<p class="blueSlate regular">Simply return it within 30 days for an exchange.</p>
            </div>
						<div class="text-center">
								<p class="blueSlate bold">100% PAYMENT SECURE</p>
								<i class="material-icons md-36 blueSlate">security</i>
                <p class="blueSlate regular">We ensure secure payment with PEV</p>
            </div>
        </div>

    </div>
</div>


	</section>

	<section id="social" class="p-4">

		<h2 class="regular text-center pb-3">Seguinos en <span class="bold blueSlate">Instagram</span></h2>

		{{-- <!-- SnapWidget Galeria desktop--> https://snapwidget.com/widgets --}}
		<script src="https://snapwidget.com/js/snapwidget.js"></script>
		<iframe src="https://snapwidget.com/embed/819103" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:100%; "></iframe>

		{{-- <div class="w-25"> --}}

		<!-- SnapWidget Galeria mobile -->
		{{-- <script src="https://snapwidget.com/js/snapwidget.js"></script> --}}
		{{-- <iframe src="https://snapwidget.com/embed/819110" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:100%; "></iframe> --}}

		{{-- </div> --}}


		<!-- SnapWidget 1 foto que pasa-->
		{{-- <iframe src="https://snapwidget.com/embed/819107" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:500px; height:500px"></iframe> --}}

		{{-- <div class='embedsocial-instagram' data-ref="548d196cc5fceb820adf4a47e830ff6ca19c5c4d"></div>
		<script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/embedscript/in.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialInstagramScript"));</script> --}}

	</section>



@endsection
