<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

  // Esta es la vista que ve el usuario de las preguntas frecuentes
  public function view()
  {
    $faqs = Faq::all();
    return view('preguntas', compact('faqs'));
  }

  public function editView(){
    $faqs = Faq::all();
    return view('editpreguntas', compact('faqs'));
  }

  public function editFaq(Request $req){

    $reglas = [
      'title' => 'required|string|min:1|max:50',
      'description' => 'nullable|max:1500',
      "image.*" => 'image|mimes:jpg,jpeg,png|max:2048',
    ];

    $mensajes = [
      "title.required" => "El titulo es obligatorio",
      "title.max" => "El campo :attribute tiene un minimo de :max caracteres",
      "title.min" => "El campo :attribute tiene un minimo de :min caracteres",
      "string" => "El campo debe ser un string",
      "image.*.image" => "Debe ser un formato de imagen",
      "image.*.max" => 'La imagen es muy pesada',
    ];

    $this->validate($req, $reglas, $mensajes);

    $faq = Faq::find($req->id);
    $faq->title = $req->title;
    $faq->description = $req->description;

    if (!empty($req['image'])) {

      // Capturo la imagen vieja, si es que tiene una
      $imagen_vieja = $faq->image_path;

      // Si ya posee una imagen, la borro
      if (!empty($imagen_vieja)) {
        // elimina las imagenes de storage
        unlink(storage_path('app/public/').$imagen_vieja);
      }

      // Capturo la imagen nueva que viene por request
      $imagen_nueva = $req->image;
      // Lo guardo en storage
      $file = $imagen_nueva->store('public');
      // Obtengo el nombre final del archivo
      $path = basename($file);
      // La coloco en la posicion correcta dentro de su objeto
      $faq->image_path = $path;
      // Guardo el objeto modificado en la base de datos con la nueva imagen
  }

    // guardo el objeto faq instanciado en la base de datos
    $faq->save();

    $faqs = Faq::all();
    $vac = compact('faqs');
      return back()
        ->with('status', 'Pregunta actualizada exitosamente');
  }

  public function deleteFaq(Request $req){
    $faq = Faq::find($req->faqid);
    $faq->delete();
    $faqs = Faq::All();
    return back()
    ->with('status', 'Pregunta eliminada exitosamente');
  }

  public function deleteImage(Request $req){
    // Capturo la pregunta en la cual se va a eliminar la imagen
    $faq = Faq::where('id', '=', $req->faqid)->first();
    // Capturo la imagen
    $imagenParaBorrar = $faq->image_path;
    // elimina la imagen de storage
    unlink(storage_path('app/public/').$imagenParaBorrar);
    // borramos la imagen de la bd haciendo el valor null
    $faq->image_path = null;
    // guardamos los cambios
    $faq->save();
    // nos retorna a la ruta anterior
    return back()->with('status', 'Imagen eliminada');
  }

  public function createFaq(Request $req){
    $reglas = [
      'title' => 'required|string|min:1|max:50',
      'description' => 'nullable|max:1500',
      "image" => 'image|mimes:jpg,jpeg,png|max:2048',
    ];

    $mensajes = [
      "title.required" => "El titulo es obligatorio",
      "title.max" => "El campo :attribute tiene un minimo de :max caracteres",
      "title.min" => "El campo :attribute tiene un minimo de :min caracteres",
      "string" => "El campo debe ser un string",
      "image.image" => "Debe ser un formato de imagen",
      "image.max" => 'La imagen es muy pesada',
    ];

    $this->validate($req, $reglas, $mensajes);

    // instancio un objeto faq
    $faq = New Faq;
    $faq->title = $req->title;
    $faq->description = $req->description;

    // si suben alguna imagen
    if (!empty($req['image'])){

      $faq->image_path = $req->file('image');
      // guardo la imagen en storage/public (no en la base de datos)
      $file = $faq->image_path->store('public');
      // obtengo sus nombres
      $path = basename($file);
      $faq->image_path = $path;
    }
    // guardo el objeto faq instanciado en la base de datos
    $faq->save();

    // redirijo
    return back()
      ->with('status', 'Pregunta creada exitosamente');
  }
}
