<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Favourite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LiveSearch extends Controller
{
  // live search
  public function search_product(Request $request, $id=0)
  {
   if($request->ajax())
   {
    $output = '';
    $id = intval($id);
    $test = $id;
    if ( isset($request->query) ) {
      $query = $request->get('query');
    } else {
      $query = false;
    }

    if(!empty($query) || $query!='' || $query==false)
    {
     $data = Product::where('name', 'LIKE', "%$query%")
       ->orWhere('description', 'LIKE', "%$query%")
       ->orWhere('model', 'LIKE', "%$query%")
       ->get();
     $chunk = $data->chunk(6);
     $paginas_counter = count($chunk);
     $data = $chunk[$id];
    }
    else
    {
     $data = Product::all();
     $data = $data->chunk(6)[$id];
    }
    $total_row =  $paginas_counter;
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
           <img class="uk-transition-scale-up uk-position-cover producto" src="/storage/'.$row->images[1]->path.'" alt="">
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
         ';
         // <li>
         // <!-- This is a anchor toggling the modal -->
         // <a class="rounded-icon ico" href="#confirm'.$row->id.'" uk-toggle>
         // <span class="hvr-pulse-shrink" uk-icon="icon: trash"></span>
         // </a>
         // </li>
         // <!-- This is the modal -->
         // <div id="confirm'.$row->id.'" uk-modal>
         //
         // <div class="uk-modal-dialog">
         // <button class="uk-modal-close-default" type="button" uk-close></button>
         //
         // <div class="uk-modal-header">
         // <h2 class="uk-modal-title">Confirmación</h2>
         // </div>
         //
         // <div class="uk-modal-body">
         // <p>"Esta seguro que desea eliminar el producto?"</p>
         // </div>
         //
         // <div class="uk-modal-footer uk-text-right">
         // <form action="/deleteproduct/'.$row->id.'" method="get">
         // <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
         // <input type="hidden" name="product_id" value="'.$row->id.'">
         // <button class="uk-button uk-button-primary" type="submit">Borrar</button>
         // </form>
         // </div>
         // </div>
         // </div>
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

       if(!empty($row->brand->name)){
             $brand = '_Marca:_ ' + $row->brand->name;
         } else{
             $brand = '';
         }
         if(!empty($row->model)){
             $model =  strval($row->model);
         } else{
             $model = '';
         }
         // Stock
         if (!hasStock($row)) {
           $texto_stock = '
             <a class="btn border-ashBlue"
             href="https://api.whatsapp.com/send?phone=5491124821816&text=Hola, estoy contactandolos desde *Gizza Joyas y Relojes Tienda Online* para pedirles stock del siguiente producto:'. $brand . ', _Nombre:_ ' . $row->name . ', _Modelo:_ ' . $model . '">Solicitar stock</a>';
       }
       else {
         $texto_stock = '';
       }
       $output .= '

               <div>
                 <div class="product uk-text-center pb-4">

                   <div class="uk-inline-clip uk-transition-toggle inside" tabindex="0">
                     <a href="/producto/'.$row->id.'">
                       <img class="producto" src="/storage/'.$row->images->first()->path.'" alt="">
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
         ';
     } // foreach data as row

     // preparamos el previos y el next
     $previus = '';

       $previus = '
                 <li class="pages-item disabled">
                   <a id="previous_page" name="pages" class="pages-link">
                    <
                   </a>
                 </li>';

     $next = '';
     $next = '
               <li class="pages-item">
                 <a id="last_page" name="pages" class="pages-link" href="/product/page/2">
                  >
                 </a>
               </li>';

     // calculamos la paginacion
     $paginas = '';
     $paginas .= $previus;
//   $paginas_counter += 1;
     for ($i=1; $i < ($paginas_counter+1) ; $i++) {
       if ($i==1) {
         $paginas .= '
         <li class="pages-item active">
           <a name="pages" value="'.$i.'" class="pages-link" href="/product/page/'.$i.'">
            '.$i.'
           </a>
         </li>
         ';
       }
       else {
         $paginas .= '
         <li class="pages-item">
           <a name="pages" value="'.$i.'" class="pages-link" href="/product/page/'.$i.'">
            '.$i.'
           </a>
         </li>
         ';
       }
     } // ciclo for
     $paginas .= $next;
     $paginas =
                '<ul class="pagination">
                  '.$paginas.'
                </ul class="pagination">';

    // lo transformamos en un array
    $data = array(
      'table_data'  => $output,
      'paginas' => $paginas,
      'pagina_id' => 1,
      'id' => $test,
    );

    }
    else
    {

     $output = '
      <tr>
        <td align="center" colspan="5">No hay productos</td>
      </tr>
     ';

     $data = array(
       'table_data'  => $output,
       'paginas' => '',
       'pagina_id' => 1,
     );

    }
    // lo transformamos en json y lo imprimimos
    echo json_encode($data);
    } // if ajax
  } // function
  // add favourite
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
  public function paginate_search(Request $request, $id)
  {
    if($request->ajax())
    {
      $id_pagina = intval($id);
      $id = (intval($id)) - 1;
      $output = '';
      $query = $request->get('query');
      // Si la query no esta vacia
      if(!empty($query))
      {
        // traemos los productos
       $data = Product::where('name', 'like', "%$query%")
         ->orWhere('description', 'like', "%$query%")
         ->orWhere('model', 'like', "%$query%")
         ->get();
       // lo separamos en chunks y traemos el que tiene el id enviado
       $count_pages = count($data->chunk(6));
       $data = $data->chunk(6)[$id];
      }
      else
      {
       $data = Product::all();
       $count_pages = count($data->chunk(6));
       $data = $data->chunk(6)[$id];
      }
      $total_row = $count_pages;
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
             <img class="uk-transition-scale-up uk-position-cover producto" src="/storage/'.$row->images[1]->path.'" alt="">
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
           ';
           // <li>
           // <a class="rounded-icon ico" href="/copy">
           // <span class="hvr-pulse-shrink" uk-icon="icon: copy">
           // </span>
           // </a>
           // </li>
           // <li>
           // <!-- This is a anchor toggling the modal -->
           // <a class="rounded-icon ico" href="#confirm'.$row->id.'" uk-toggle>
           // <span class="hvr-pulse-shrink" uk-icon="icon: trash"></span>
           // </a>
           // </li>
           // <!-- This is the modal -->
           // <div id="confirm'.$row->id.'" uk-modal>
           //
           // <div class="uk-modal-dialog">
           // <button class="uk-modal-close-default" type="button" uk-close></button>
           //
           // <div class="uk-modal-header">
           // <h2 class="uk-modal-title">Confirmación</h2>
           // </div>
           //
           // <div class="uk-modal-body">
           // <p>"Esta seguro que desea eliminar el producto?"</p>
           // </div>
           //
           // <div class="uk-modal-footer uk-text-right">
           // <form action="/deleteproduct/'.$row->id.'" method="get">
           // <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
           // <input type="hidden" name="product_id" value="'.$row->id.'">
           // <button class="uk-button uk-button-primary" type="submit">Borrar</button>
           // </form>
           // </div>
           // </div>
           // </div>
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
         if(!empty($row->brand->name)){
             $brand = $row->brand->name;
         } else{
             $brand = '';
         }
         if(!empty($row->model)){
             $model = $row->model;
         } else{
             $model = '';
         }
         // Stock
         if (!hasStock($row)) {
           $texto_stock = '
             <a class="btn border-ashBlue"
             href="https://api.whatsapp.com/send?phone=5491124821816&text=Hola, estoy contactandolos desde *Gizza Joyas y Relojes Tienda Online* para pedirles stock del siguiente producto:'. '_Marca:_ ' .$brand . ', _Nombre:_ '.$row->name.', '. '_Modelo:_ ' . $model . '"
             >Solicitar stock</a>
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
                         <img class="producto" src="/storage/'.$row->images->first()->path.'" alt="">
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
           ';
       } // foreach data as row

       // preparamos el previos y el next
       $previus = '';

       if ($id_pagina == 1) {
         $previus = '
                   <li class="pages-item disabled">
                     <a name="pages" class="pages-link">
                      <
                     </a>
                   </li>';
       }
       else {
         $previus = '
                   <li class="pages-item">
                     <a id="previous_page" name="pages" class="pages-link" href="/product/page/'.($id_pagina-1).'">
                      <
                     </a>
                   </li>';
       }

       $next = '';

       $next = '
                 <li class="pages-item">
                   <a id="last_selector" name="pages" class="pages-link" href="/product/page/'.($id_pagina+1).'">
                    >
                   </a>
                 </li>';

       // calculamos la paginacion
       $paginas = '';
       $paginas .= $previus;
       $paginas_counter = count($data->chunk(6)) + 1;
       for ($i=1; $i < $paginas_counter; $i++) {
         $paginas .= '
                    <li class="pages-item">
                      <a name="pages" value="'.$i.'" class="pages-link" href="/product/page/'.$i.'">
                        '.$i.'
                      </a>
                    </li class="pages-item">
                      ';
       }
       $paginas .= $next;
       $paginas =
                  '<ul class="pagination">
                    '.$paginas.'
                  </ul class="pagination">';
      } // end if
      else
      {
       $output = '
        <tr>
          <td align="center" colspan="5">No hay productos</td>
        </tr>
       ';
      }
      if(isset($paginas)){
        // lo transformamos en un array
          $data = array(
           'table_data'  => $output,
           'paginas' => $paginas,
           'paginas_cantidad' => count($data),
           'pagina_actual' => $id_pagina,
          );
      } else {
        // lo transformamos en un array
          $data = array(
           'table_data'  => $output,
           'paginas_cantidad' => count($data),
           'pagina_actual' => $id_pagina,
          );
      }

      // lo transformamos en json y lo imprimimos
      echo json_encode($data);
    } // request ajax
  } // paginate search
  public function add_favourite_from_product(Request $request)
  {
    if($request->ajax())
    {
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
        if (!count($favourites)) {
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
          'cantidad_favs' => count($user_favs),
          'message' => "Producto agregado a favoritos!"
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
          'cantidad_favs' => count($user_favs),
          'message' => "Producto eliminado de favoritos!"
          );
          // lo transformamos en json y lo imprimimos
          echo json_encode($data);
        }
      } // end if empty product_id
    } // if request is ajax
  }
}
