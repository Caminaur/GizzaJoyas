<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function cpanel(){
    return view('adminpanel');
  }

  public function favoritos(){
    return view('/favoritos');
  }
}
