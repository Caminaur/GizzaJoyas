<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Material;
use App\Models\Age;
use App\Models\Gender;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // https://www.youtube.com/watch?v=7QWZxjgvEQc
      // Especificamos las vistas donde queremos compartir estas variables
      View::composer(['partials.navbar','layouts.plantilla','searchproduct'], function($view){

        // Traemos todo lo que queremos imprimir en la navbar
        $categories = Category::all();
        $materials = Material::all();
        $ages = Age::all();
        $genders = Gender::all();
        // Especificamos los nombres y valores de las variables a compartir
        $view->with('categories',$categories)
             ->with('materials',$materials)
             ->with('genders',$genders)
             ->with('ages',$ages);
      });
    }
}
