@extends('layouts.plantilla')
@section('titulo')
Gizza Joyas Home
@endsection
@section('main')

	<section id="hero" class="container-fluid">


		<div class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-background-cover uk-light" uk-height-viewport ="offset-top: true" data-src="img/extras/4.jpg" uk-img>
			<h1 class="bold mb-3">Background Image</h1>
			<h3 class="medium mb-5">Descripcion de lo que vamos a poner aca, 50% off Sale</h3>
				<div class="">
					<a class="btn bg-dandelion mx-1" href="#">Dandelion</a>
					<a class="btn bg-ashBlue mx-1" href="#">Ash Blue</a>
				</div>

			<a class="btn bg-blueSlate mt-1" href="#">Blue Slate</a>
		</div>

	</section>

	<section id="categories" class="uk-container-extend uk-background-muted px-4 pt-3">

		<h2 class="medium text-center">Categorías</h2>

			<div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/aros.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="medium uk-margin-remove">Aros</h3></div>
	          </div>
	        </div>
	      </div>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/pulseras.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="uk-margin-remove">Pulseras</h3></div>
	          </div>
	        </div>
	      </div>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/collares.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="uk-margin-remove">Collares</h3></div>
	          </div>
	        </div>
	      </div>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/anillos.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="uk-margin-remove">Anillos</h3></div>
	          </div>
	        </div>
	      </div>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/relojes.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="uk-margin-remove">Relojes</h3></div>
	          </div>
	        </div>
	      </div>

				<div>
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/accesorios.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h3 class="uk-margin-remove">Accesorios</h3></div>
	          </div>
	        </div>
	      </div>

			</div>

	</section>

	<section id="info">

		<div class="uk-section uk-section-muted">
    <div class="uk-container">

        <div class="uk-grid-match uk-child-width-1-2@s uk-child-width-1-4@m align-items-start" uk-grid>
            <div class="text-center">
								<p class="blueSlate light">FREE SHIPPING</p>
								<span uk-icon="heart"></span>
                <p class="blueSlate light">Free shipping on all US order or order above $200</p>
            </div>
            <div class="text-center">
							<p class="blueSlate regular">SUPPORT 24/7</p>
							<span uk-icon="heart"></span>
							<p class="blueSlate regular">Contact us 24 hours a day, 7 days a week</p>
            </div>
            <div class="text-center">
							<p class="blueSlate bold">30 DAYS RETURN</p>
							<span uk-icon="heart"></span>
							<p class="blueSlate bold">Simply return it within 30 days for an exchange.</p>
            </div>
						<div class="text-center">
								<p class="blueSlate bold">100% PAYMENT SECURE</p>
								<span uk-icon="heart"></span>
                <p class="blueSlate regular">We ensure secure payment with PEV</p>
            </div>
        </div>

    </div>
</div>

	</section>



@endsection
