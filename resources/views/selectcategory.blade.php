@extends('layouts.plantilla')
@section('titulo')
Categorias
@endsection
@section('main')
  <div class="container">
    <div class="row">
      @foreach ($categories as $category)
              <div class="padding col-6 col-md-2 col-lg-3">
                <h1>{{$category->name}}</h1>
                <a href="/editcategory/{{$category->id}}"><img src="/storage/{{$category->image}}" alt=""></a>
              </div>
      @endforeach
    </div>
  </div>
@endsection
