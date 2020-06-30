<?php

namespace App\Http\Controllers;
use App\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
  public function index(){
    $genders = Gender::all();
    $vac = compact('genders');
    return view('editgenders',$vac);
  }
  public function edit(Request $req){
    $gender = Gender::find($req->gender_id);
    $gender->name = $req->name;
    $gender->save();
    return back()->with('status', 'Genero editado exitosamente!');;
  }
  public function store(Request $req){
    $gender = New Gender;
    $gender->name = $req->name;
    $gender->save();
    return back()->with('status', 'Genero guardado exitosamente!');;
  }
  public function delete(Request $req){
    $gender = Gender::find($req->gender_id);
    $gender->delete();
    return back()->with('status', 'Genero borrado exitosamente!');;
  }
}
