<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Favourite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LiveSearch extends Controller
{
  public function action(Request $request)
  {
   if($request->ajax())
   {
    $output = '';
    $query = $request->get('query');
    if(!empty($query))
    {
     $data = Product::where('name', 'like', '%'.$query.'%')
       ->orWhere('description', 'like', '%'.$query.'%')
       ->orWhere('model', 'like', '%'.$query.'%')
       ->get();
    }
    else
    {
     $data = Product::all();
    }
    $total_row = $data->count();
    if($total_row > 0)
    {
     $texto1 = '';
     $texto_discount = '';
     $texto_oferta = '';
     $texto_authenticate = '';
     $texto_usuario_admin = '';
     $texto_carbon = '';
     $texto_stock = '';
     foreach($data as $row)
     {

       if (count($row->images)>1) {
         $texto1 = '
           <img class="uk-transition-scale-up uk-position-cover" src="/storage/'.$row->images[1]->path.'" alt="">
         ';
       }
       else {
         $texto1 = '';
       }

       // discount
       if ($row->discount) {
         $texto_discount = '
           <div class="onSale-label">
             <ul>
               <li class="sale">
                 <h4>'.$row->discount.'% off</h4>
               </li>
             </ul>
           </div>
         ';
       }
       else {
         $texto_discount = '';
       }

       // on sale
       if ($row->onSale) {
         $texto_oferta = '
           <h3 class="dandelion mx-1 sinOferta">$'.number_format($row->price, 0, '.', '.').'</h3>
           <h3 class="doveGrey mx-1">$'.number_format((getRealPrice($row)), 0, '.', '.').'</h3>
         ';
       }
       else {
         $texto_oferta = '
           <h3 class="doveGrey mx-1">$'.number_format($row->price, 0, '.', '.').'</h3>
         ';
       }

       if (Auth::user() && isFavourite($row, Auth::user())) {
         $texto_authenticate = '
             <div class="">
              <span class="hvr-pulse-shrink isFavourite" uk-icon="icon: heart;"></span>
             </div>
            ';
       }
       else {
         $texto_authenticate = '
         <div class="">
          <span class="hvr-pulse-shrink" uk-icon="icon: heart;"></span>
         </div>';
       }


       if (Auth::user() && Auth::user()->isAdmin == true) {
         $texto_usuario_admin = '<li>
           <a class="rounded-icon ico" href="/editproduct/'.$row->id.'"><span class="hvr-pulse-shrink" uk-icon="icon: pencil"></span>
           </a>
         </li>
         <li>
           <a class="rounded-icon ico" href="/copy">
             <span class="hvr-pulse-shrink" uk-icon="icon: copy">
             </span>
           </a>
         </li>
         <li>
           <!-- This is a anchor toggling the modal -->
           <a class="rounded-icon ico" href="#confirm" uk-toggle>
             <span class="hvr-pulse-shrink" uk-icon="icon: trash"></span>
           </a>
         </li>
         <!-- This is the modal -->
         <div id="confirm" uk-modal>
             <div class="uk-modal-dialog uk-modal-body">
                 <h2 class="uk-modal-title">Confirmacion</h2>
                 <p>¿Desea eliminar el producto?</p>
                 <p class="uk-text-right">
                     <a class="uk-button uk-button-default uk-modal-close" type="button">Cancel</a>
                     <a class="uk-button uk-button-primary" href="/deleteproduct/'. $row->id .'" type="button">Eliminar</a>
                 </p>
             </div>
         </div>
         ';
       }
       else {
         $texto_usuario_admin = "";
       }

       // Carbon
       if ($row->created_at->diffInDays( Carbon::now() ) <= 20) {
         $texto_carbon = '
           <div class="new-label">
             <ul>
               <li class="new"><h4>Nuevo</h4></li>
             </ul>
           </div>
         ';
       }
       else {
         $texto_carbon = '';
       }

       // Stock
       if (!hasStock($row)) {
         $texto_stock = '
           <a class="btn border-ashBlue" href="#">Solicitar stock</a>
         ';
       }
       else {
         $texto_stock = '';
       }

       $output .= '

               <div>
                 <div class="product uk-text-center pb-4">

                   <div class="uk-inline-clip uk-transition-toggle inside" tabindex="0">
                     <a href="/producto/'.$row->id.'">
                       <img class="producto" src="/'.$row->images->first()->path.'" alt="">
                       '.$texto1.'

                     '.$texto_discount.'
                   </a>

                     <div class="uk-visible-toggle icons-product" tabindex="-1">
                       <div class="uk-flex-center pt-3" uk-grid>
                         <div class="uk-width-auto">
                           <ul class="uk-iconnav justify-content-center">
                             <li>
                               <input id="product'.$row->id.'" type="hidden" name="" value="'.$row->id.'">
                               <a class="rounded-icon ico favourite_icon_ajax" href="/live_search/add_favourite">
                                 '.$texto_authenticate.'
                               </a>
                             </li>
                             <li><a class="rounded-icon ico" href="/cart"><span class="hvr-rotate" uk-icon="icon: cart"></span></a></li>
                             '.$texto_usuario_admin.'
                           </ul>
                         </div>
                       </div>
                     </div>


                 </div>

                 <h3 class="product-desc uk-margin-small-top mb-3">'.$row->category->name.'</h3>

                 <h3 class="product-desc uk-margin-small-top mb-3">'.$row->name.'</h3>

                 <div class="uk-flex uk-flex-center mb-3">
                   '.$texto_oferta. '
                 </div>

                   '.$texto_carbon.'
                 '.$texto_stock.'
               </div>
             </div>
          </div>
       </section>
         ';
     }
    }
    else
    {
     $output = '
     <tr>
      <td align="center" colspan="5">No hay productos</td>
     </tr>
     ';
    }
    // lo transformamos en un array
    $data = array(
     'table_data'  => $output,
    );
    // lo transformamos en json y lo imprimimos
    echo json_encode($data);
   }
  }
  public function add_favourite(Request $request)
  {
    if($request->ajax())
    {
      // declaramos el output vacio
      $output = '';
      // guardamos la query en una variable
      $product_id = $request->product_id;
      // si la query no esta vacia
      if(!empty($product_id))
      {
        // buscamos si existe un fav del usuario con ese product_id
        $favourites = Favourite::where('product_id','=',$product_id)
        ->where('user_id','=',Auth::user()->id)
        ->get();
        // verificamos que el producto no este seleccionado como favorito
        if (!count($favourites)>0) {
          // creamos y guardamos la relacion
          $favourite = New Favourite;
          $favourite->product_id = $product_id;
          $favourite->user_id = Auth::user()->id;
          $favourite->save();
          // buscamos nuevamente la cantidad de favoritos enviar la cantidad total
          $user_favs = Favourite::where('user_id','=',Auth::user()->id)
          ->get();
          // lo transformamos en un array
          $data = array(
          'isFave' => true,
          'selected_class' => 'hvr-pulse-shrink isFavourite',
          'product_id' => $product_id,
          'cantidad_favs' => count($user_favs),
          );
          // lo transformamos en json y lo imprimimos
          echo json_encode($data);
        }
        else {
          $favourites->first()->delete();
          // buscamos nuevamente la cantidad de favoritos enviar la cantidad total
          $user_favs = Favourite::where('user_id','=',Auth::user()->id)
          ->get();
          // lo transformamos en un array
          $data = array(
          'isFave' => false,
          'selected_class' => 'hvr-pulse-shrink',
          'product_id' => $product_id,
          'cantidad_favs' => count($user_favs),
          );
          // lo transformamos en json y lo imprimimos
          echo json_encode($data);
        }
      } // end if empty product_id
    } // if request is ajax
  }
}
