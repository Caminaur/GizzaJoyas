<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
  public function index(){
    $tags = Tag::all();
    $vac = compact('tags');
    return view('edittags',$vac);
  }
  public function edit(Request $req){
    $tag = Tag::find($req->tag_id);
    $tag->name = $req->name;
    $tag->save();
    return back()->with('status', 'Tag editado exitosamente!');;
  }
  public function store(Request $req){
    $tag = New Tag;
    $tag->name = $req->name;
    $tag->save();
    return back()->with('status', 'Tag guardado exitosamente!');;
  }
  public function delete(Request $req){
    $tag = Tag::find($req->tag_id);
    $tag->delete();
    return back()->with('status', 'Tag borrado exitosamente!');;
  }
}
