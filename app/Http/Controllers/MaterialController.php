<?php

namespace App\Http\Controllers;
use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
  public function index(){
    $materials = Material::all();
    $vac = compact('materials');
    return view('editmaterials',$vac);
  }
  public function edit(Request $req){
    $material = Material::find($req->material_id);
    $material->name = $req->name;
    $material->save();
    return back();
  }
  public function store(Request $req){
    $material = New Material;
    $material->name = $req->name;
    $material->save();
    return back();
  }
  public function delete(Request $req){
    $material = Material::find($req->material_id);
    $material->delete();
    return back();
  }
}
