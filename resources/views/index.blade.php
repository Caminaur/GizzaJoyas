@extends('layouts.plantilla')
@section('titulo')
Gizza Joyas Home
@endsection
@section('main')

	<section id="hero">

		<div class="uk-height-large uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="img/extras/4.jpg" uk-img>
			<h1 class="bold">Background Image</h1><br>
		</div>

	</section>

	<section id="categories" class="container">

		<h1 class="bold">Probando letras</h1>
		<h1 class="medium">Probando letras</h1>
		<h1 class="regular">Probando letras</h1>

			<div class="uk-grid-medium uk-child-width-1-2@s uk-child-width-1-3@m uk-flex-center uk-margin-top" uk-grid>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/aros.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Aros</h4></div>
	          </div>
	        </div>
	      </div>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/pulseras.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Pulseras</h4></div>
	          </div>
	        </div>
	      </div>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/collares.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Collares</h4></div>
	          </div>
	        </div>
	      </div>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/anillos.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Anillos</h4></div>
	          </div>
	        </div>
	      </div>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/relojes.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Relojes</h4></div>
	          </div>
	        </div>
	      </div>

				<div class="uk-text-center">
	        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
	          <img class="asd3 uk-transition-scale-up uk-transition-opaque" src="img/accesorios.jpg" alt="">
	          <div class="uk-position-center">
	              <div class="uk-light"><h4 class="uk-margin-remove">Accesorios</h4></div>
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
