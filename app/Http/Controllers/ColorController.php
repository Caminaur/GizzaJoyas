<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
  public function index(){
    $colors = Color::all();
    $vac = compact('colors');
    return view('editcolors',$vac);
  }
  public function edit(Request $req){
    $color = Color::find($req->color_id);
    $color->name = $req->name;
    $color->save();
    return back()->with('status', 'Color editado exitosamente!');
  }
  public function store(Request $req){
    $color = New Color;
    $color->name = $req->name;
    $color->save();
    return back()->with('status', 'Color guardado exitosamente!');
  }
  public function delete(Request $req){
    $color = Color::find($req->color_id);
    $color->delete();
    return back()->with('status', 'Color borrado exitosamente!');
  }
}
