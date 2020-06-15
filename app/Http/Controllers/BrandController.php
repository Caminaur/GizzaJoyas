<?php

namespace App\Http\Controllers;
use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
  public function index(){
    $brands = Brand::all();
    $vac = compact('brands');
    return view('editbrands',$vac);
  }
  public function edit(Request $req){
    $brand = Brand::find($req->brand_id);
    $brand->name = $req->name;
    $brand->save();
    return back();
  }
  public function store(Request $req){
    $brand = New Brand;
    $brand->name = $req->name;
    $brand->save();
    return back();
  }
  public function delete(Request $req){
    $brand = Brand::find($req->brand_id);
    $brand->delete();
    return back();
  }
}
