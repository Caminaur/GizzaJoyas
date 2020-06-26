<?php

namespace App\Http\Controllers;
use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

  // Esta es la vista que ve el usuario de las preguntas frecuentes
  public function view()
  {
    $faqs = Faq::all();
    return view('preguntas', compact('faqs'));
  }
}
