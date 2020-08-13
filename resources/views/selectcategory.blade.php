@extends('layouts.plantilla')
@section('titulo')
Categorias
@endsection
@section('main')
  <div class="container py-5">
    <h2 class="regular text-center pb-3">Editar <span class="bold blueSlate">Categorías</span></h2>
    <div class="row">
      <div class="uk-child-width-1-2 uk-child-width-1-3@m" uk-grid>
				@forelse ($categories as $category)
					<div>
						<div class="uk-inline-clip uk-transition-toggle" tabindex="0">
              <!-- This is the modal -->
              @include('partials.confirm',['url'=>'/deletecategory', 'message'=>'Seguro quiere eliminar la Categoría?', 'name'=>'categoryId', 'id'=>'{{$categpry->id}}'])

              <a class="hvr-shrink rounded-icon ico" style="border: 1px solid white; border-radius: 30px; position: absolute;  z-index: 1;  color: white;  top: 2%;  right: 3%;" href="#confirm" uk-icon="icon: trash;" uk-toggle></a>
              <a href="/editcategory/{{$category->id}}">
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
        <div class="uk-inline-clip uk-transition-toggle" style="text-align:center;">
          <label for="">Agregar Nueva Categoria</label><br>
          <a class="blueSlate hvr-shrink" href="/addcategory" uk-icon="icon: plus-circle; ratio: 4 ;"></a>
        </div>
			</div>
    </div>
  </div>
@endsection
