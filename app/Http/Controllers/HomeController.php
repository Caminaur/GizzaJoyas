<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $categories = Category::all();

      // Nos tiene que traer X cantidad de productos ordenados por fecha
      $loNuevo = Product::where();

      $oferta = Product::where('OnSale','=',1)->take(5);
      // Nos tiene que traer X cantidad de productos en oferta aleatoriamente

      return view('index', compact('categories'));
    }

}
