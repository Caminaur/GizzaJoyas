@extends('layouts.plantilla')
@section('titulo')
Checkout
@endsection
@section('main')

  {{-- @if ($total == 0)
    <label>No tienes productos en tu carrito, <a href="/productos">continuar comprando</a></label>
  @endif --}}

  <div>
      @if (isset($errors) && $errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  </div>

  @php
    $contador = 1;
  @endphp

  <div class="row">

    <section id="formulario" class="col-lg-7 p-5">

      <ul class="uk-breadcrumb pb-5 py-2">
        <li><a href="/">Seguir comprando</a></li>
        <li><a href="/">Volver al carrito</a></li>
        <li><span class="dandelion">Checkout</span></li>
      </ul>

      <h3 class="regular text-center pb-3">Elige una forma de <span class="bold blueSlate">pago</span></h3>

      <div class="text-center">
        {{-- Mercado Pago --}}
        <button href="#toggle-animation" class="uk-button uk-button-default mercadopago-payment-button" type="button" uk-toggle="target: #toggle-animation; animation: uk-animation-fade">Mercado Pago <img src=/img/mpicono.jpeg style="padding-bottom: 2px; width: 30px;"></button>
        {{-- Whatsapp --}}
        <a class="uk-button uk-button-default whatsapp-payment-button"
        href="https://api.whatsapp.com/send?phone=5491124821816&text=Hola, estoy contactandolos desde *Gizza Joyas y Relojes Tienda Online* para ordenarles lo siguiente:@foreach ($carts as $cart) *Producto Nº{{$contador}}*@if(isset($cart->product->brand->name)) _Marca:_ {{$cart->product->brand->name}}@endif, _Nombre:_ {{$cart->product->name}}, _Modelo:_ {{$cart->product->model}}, _Cantidad:_ {{$cart->quantity}}, _Talle:_ {{$cart->size->name}} @php $contador++ @endphp @endforeach
*Total de la compra: ${{$total}}*" target="_blank">Whatsapp <i class="fab fa-whatsapp" target="_blank" style="font-size: 19px; color:#25D366;"></i></a>
      </div>

      {{-- Despliegue de mercadopago form --}}
      <div id="toggle-animation" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>

        <form class="text-center" action="/payments/pay" method="post" id="paymentForm" style="text-align-last: center;">
        @csrf
                  <label class="mt-3">Detalles de la compra:</label><br>

          <div class="form-group-checkout form-row" style="text-align: -webkit-center;">
            <div class="col-12 col-md-6 mb-3">
                <input class="form-control-checkout" type="text" id="cardNumber" data-checkout="cardNumber" placeholder="Numero de tarjeta" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                <small class="fomr-text text-muted">Ej: 4509 9535 6623 3704	</small>
            </div>


            {{-- <div class="col-1"></div> --}}

            <div class="col-12 col-md-6 mb-3">
                <input class="form-control-checkout" type="text" id="cardholderName" data-checkout="cardholderName" placeholder="Nombre completo" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                <small class="fomr-text text-muted">Titular de la tarjeta</small>
            </div>

          </div>

          <div class="justify-content-center form-group-checkout form-row mb-3" style="text-align: -webkit-center;">
            <div class="col-4 col-md-4 justify-content-center" style="text-align: -webkit-center;">
                <input class="form-control-checkout" id="cardExpirationMonth" type="text" data-checkout="cardExpirationMonth" placeholder="MM" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Mes de expiración</small> --}}
            </div>

            <div class="col-4 col-md-4" style="text-align: -webkit-center;">
                <input class="form-control-checkout" id="cardExpirationYear" type="text" data-checkout="cardExpirationYear" placeholder="AA" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Año de expiración</small> --}}
            </div>

            <div class="col-4 col-md-4" style="text-align: -webkit-center;">
                <input class="form-control-checkout" type="text" id="securityCode" data-checkout="securityCode" placeholder="CVC" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false">
                {{-- <small class="fomr-text text-muted">Cód. de seguridad</small> --}}
            </div>


            <small class="text-center fomr-text text-muted mt-1">Fecha de expiración, Mes - Año y Código de Seguridad</small>

          </div>

          <div class="form-group-checkout form-row" style="text-align: -webkit-center;">
            <div class="col-12 col-md-2 mb-3">
                <select class="custom-select" id="docType" data-checkout="docType" style="padding: 0px !important;"></select>
                {{-- <small class="invisible text-center fomr-text text-muted">Elija una identificación</small> --}}
            </div>
            <div class="col-12 col-md-2 mb-3">
                <input class="form-control-checkout" type="text" id="docNumber" data-checkout="docNumber" placeholder="N°">
                {{-- <small class="invisible text-center fomr-text text-muted">Identificacion</small> --}}
            </div>
            <div class="col-12 col-md-3 mb-3">
                <input class="form-control-checkout" type="text" placeholder="Teléfono" name="number" value="">
                {{-- <small class="text-center fomr-text text-muted">Tel. de contacto</small> --}}
            </div>
            <div class="col-12 col-md-5 mb-3">
                <input class="form-control-checkout" type="email" placeholder="Email" name="email" value="{{--{{Auth::user()->email}}--}}">
                {{-- <small class="text-center fomr-text text-muted">Ejemplo@ejemplo.com</small> --}}
            </div>

            <div class="d-flex flex-row justify-content-around col-12" style="text-align: -webkit-center;">

              <div class="justify-content-start">
                <label for="si">Envío a domicilo:</label>
                <input type="radio" id="si" name="envio" value="">
              </div>

              <div class="justify-content-end">
                <label for="no">Retiro en sucursal:</label>
                <input type="radio" id="no" name="envio" value="false" checked>
              </div>

            </div>

          <br>


          <div class="form-group-checkout form-row hidden justify-content-center" id='deliveryAddress' style="text-align: -webkit-center;">
            <span class="h6 light text-center">Para saber más sobre los gastos de envío haz{{--{{$shipment}}--}} <a href="/preguntas" class="text-info">click aquí</a></span>
            <div class="col-12 col-md-6 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Dirección" name="address" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input id="codigo_postal" class="form-control-checkout" type="text" placeholder="CP" name="zipcode" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Piso" name="floor" value="">
            </div>
            <div class="col-12 col-md-2 mb-3">
              <input class="form-control-checkout" type="text" placeholder="Dpto." name="apartment" value="">
            </div>

          </div>

            <div class="col-12">
              <label for="installments">Cuotas:</label>
              <select id="installments" class="form-control-checkout" name="installments"></select>
            </div>
            <div hidden id="errores_cp" class="col-12"></div>
            <input type="hidden" name="amount" id="total" value={{getTotalPrice($carts)}} />
            <input type="hidden" name="description"/>
            <input type="hidden" name="paymentMethodId"/>
            <input type="hidden" name="shipment" id="shipment" value="">
          </div>

          {{-- Aqui se muestran los error que puedan existir y va a ser establecido desde el JS --}}
          <div class="form-group-checkout form-row">
            <div class="col">
                <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
            </div>
          </div>

          <input type="hidden" id="cardNetwork" name="card_network">
          {{-- Input oculto que se usa para el JS --}}

          <input type="hidden" id="cardToken" name="card_token">
          {{-- Input oculto que se usa para el JS --}}

          <div class="text-center mt-3">
            <button type="submit" id="payButton" class=" btn bg-dandelion">Comprar</button>
          </div>

          <div class="col-auto" hidden>
            {{-- <label>Moneda</label> --}}
            <select class="custom-select" name="currency" required hidden>
                    <option value="ars">
                      ARS
                    </option>
            </select>
          </div>
        </form>


      </div>
    </section>

    <section id="carrito" class="col-lg-5 p-5 uk-background-muted">

      <h3 class="regular text-center pb-3">Carrito de <span class="bold blueSlate">compras</span></h3>

      @foreach ($carts as $cart)
        <div class="producto row">
          <div class="img col-12 col-lg-6">
            {{-- Como imagen del producto en el carrito utilizo la primera --}}
            <img class="checkout-cart-img" src="/storage/{{$cart->product->images->first()->path}}" alt="Imagen de producto">
            <article class="">
              <h6>{{$cart->product->name}}</h6>
              <h6 class="light">Talle {{$cart->size->name}} / {{$cart->quantity}} uni.</h6>
            </article>
          </div>

          <div class="product-info col-12 col-lg-6">
            <h6 class="p-2 ">${{number_format((getRealPrice($cart->product)*$cart->quantity), 0, '.', '.')}}</h6>
            <h6 class="p-2 ">${{number_format((getRealPrice($cart->product)*$cart->quantity), 0, '.', '.')}}</h6>
          </div>
        </div> {{-- producto --}}
      @endforeach


      <div class="calculos pt-4">
        <div class="d-flex justify-content-between">
          <h6>Subtotal</h6>
          <h6>${{number_format((getTotalPrice($carts)), 0, '.', '.')}}</h6>
        </div>
        <div id="shipment_div" hidden class="d-flex justify-content-between">
          <h6>Envío</h6>
          <input id="costo_de_envio_fijo" type="hidden" value="{{$shipment}}">
          <h6 id="costos_de_envio">${{$shipment}}</h6>
        </div>
        <div class="d-flex justify-content-between">
          <h4 class="bold">Total</h4>
          <h4 id="total_h4" class="bold">${{number_format((getTotalPrice($carts)), 0, '.', '.')}}</h4>
        </div>
      </div>
    </section>

  </div>
@endsection


  <script type="text/javascript">
    window.addEventListener('load',function(){
      var costo;
      const codigo_postal = document.getElementById('codigo_postal');
      codigo_postal.addEventListener('change', function(){
        $.ajax({
         url:`https://api.mercadolibre.com/sites/MLA/shipping_options?zip_code_from=1770&zip_code_to=${this.value}&dimensions=16x16x16,1500`,
         method:'GET',
         dataType:'json',
         success:function(data)
         {
          costo = data.options[1].cost;
         } // success
       }); // ajax
      });
    });
  </script>

  <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
  @push('scripts')

  <script>
    // Cuando clickean Con envio o Sin envio  Muestra o esconde los datos del domicilio
    // en el formulario checkout y a su vez le da value true al input de Con Envio. Si conEnvio value es true
    // se va a ejecutar la funcion de MP guessingPaymentMethod que se encarga de calcular el total.
    // Ver linea 232 para seguir entendiendo.
    window.addEventListener('load', function() {
      var conEnvio = document.getElementById("si");
      var sinEnvio = document.getElementById("no");
      var deliveryAddress = document.getElementById("deliveryAddress");
      var inputs = document.getElementById("deliveryAddress").getElementsByTagName('input');
      const codigo_postal = document.getElementById('codigo_postal');
      if (conEnvio.hasAttribute('checked')) {
        deliveryAddress.classList.remove("hidden");
      }
      codigo_postal.addEventListener('change', function(){
        conEnvio.value = "true";
        guessingPaymentMethod('blur');
      });
      conEnvio.addEventListener('click', function(){
        deliveryAddress.classList.remove("hidden");
        conEnvio.value = "true";
        guessingPaymentMethod('blur');
      });
      sinEnvio.addEventListener('click', function(){
        deliveryAddress.classList.add("hidden");
        conEnvio.value = "false";
        // habilitar boton de compra
        document.getElementById('payButton').removeAttribute('disabled');
        guessingPaymentMethod('blur');
        for (input of inputs) {
          input.value="";
        }
      })
    })
    </script>
    <script>
        function setCardNetwork()
        {
            const cardNumber = document.getElementById("cardNumber");
            mercadoPago.getPaymentMethod(
                { "bin": cardNumber.value.substring(0,6) },
                function(status, response) {
                    const cardNetwork = document.getElementById("cardNetwork");
                    cardNetwork.value = response[0].id;
                }
            );
        }
    </script>
    <script hidden>
        const mercadoPago = window.Mercadopago;
        // nos validamos con la llave publica
        mercadoPago.setPublishableKey('{{config('services.mercadopago.key')}}');
        // Nos permite obtener los tipos de documentos disponibles
        mercadoPago.getIdentificationTypes();
        console.log(mercadoPago);
        // agregamos una funcion cuando ingresen un numero para la tarjeta
        window.addEventListener('load',function(){
          var card = document.querySelector('#cardNumber');
          card.addEventListener('blur',function(){
            guessingPaymentMethod('blur');
            setCardNetwork();
          })
        })
    </script>

    <script type="text/javascript">
    // Funcion para darle formato a los precios dinamicos
    // Link: https://stackoverflow.com/questions/19307271/how-to-format-clean-numbers-so-1000-appear-as-1-000-00
    function formatNumber(n, p, ts, dp) {
      var t = [];
      // Get arguments, set defaults
      if (typeof p  == 'undefined') p  = 2;
      if (typeof ts == 'undefined') ts = ',';
      if (typeof dp == 'undefined') dp = '.';

      // Get number and decimal part of n
      n = Number(n).toFixed(p).split('.');

      // Add thousands separator and decimal point (if requied):
      for (var iLen = n[0].length, i = iLen? iLen % 3 || 3 : 0, j = 0; i <= iLen; i+=3) {
        t.push(n[0].substring(j, i));
        j = i;
      }
      // Insert separators and return result
      return t.join(ts) + (n[1]? dp + n[1] : '');
    }
    function addEvent(to, type, fn){
            if(document.addEventListener){
                to.addEventListener(type, fn, false);
            } else if(document.attachEvent){
                to.attachEvent('on'+type, fn);
            } else {
                to['on'+type] = fn;
            }
        };
    addEvent(document.querySelector('#cardNumber'), 'keyup', guessingPaymentMethod);
    addEvent(document.querySelector('#cardNumber'), 'change', guessingPaymentMethod);
    function getBin() {
      const cardnumber = document.getElementById("cardNumber");
      return cardnumber.value.substring(0,6);
    };
    function guessingPaymentMethod(event) {
        var bin = getBin();
        if (event.type == "keyup") {
            if (bin.length >= 6) {
                window.Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        } else {
            setTimeout(function() {
                if (bin.length >= 6) {
                    window.Mercadopago.getPaymentMethod({
                        "bin": bin
                    }, setPaymentMethodInfo);
                }
            }, 100);
        }
    };
    function setPaymentMethodInfo(status, response) {
        if (status == 200) {
            const paymentMethodElement = document.querySelector('input[name=paymentMethodId]');
            if (paymentMethodElement) {
                paymentMethodElement.value = response[0].id;
            } else {
                var form = document.querySelector('#paymentForm');
                const input = document.createElement('input');
                input.setAttribute('name', 'paymentMethodId');
                input.setAttribute('type', 'hidden');
                input.setAttribute('value', response[0].id);
                form.appendChild(input);
            }
            // Obtenemos el value de conEnvio, si es true le sumamos el valor del envio a las cuotas.
            var conEnvio = document.getElementById("si").value;
            if (conEnvio=="true") {
              const codigo_postal = document.getElementById('codigo_postal').value;
              // habilitar boton de compra
              document.getElementById('payButton').removeAttribute('disabled');
              var compra = document.querySelector('#total').value;
              var total = parseInt(document.getElementById('costo_de_envio_fijo').value) + parseInt(compra);
              var precio_total = '$' + formatNumber( (total) , 0 , '.' , ',' );
              $("#shipment_div").removeAttr('hidden');
              console.log(compra,total,precio_total);
              // seteamos el valor del shipment para que funcione correctamente
              document.getElementById('shipment').value = document.getElementById('costo_de_envio_fijo').value;
              $("#total_h4").html(precio_total);
              // modificamos el valor total del envio y le agregamos el number format
            Mercadopago.getInstallments({
                     "bin": getBin(),
                     "amount": parseFloat(total),
                   }, setInstallmentInfo);
                   setCardNetwork();
            }
            else {
              var precio_total = parseInt(document.querySelector('#total').value);
              var precio_total = '$' + formatNumber( (precio_total) , 0 , '.' , ',' );
              document.getElementById('shipment').value = '';
              $("#total_h4").html(precio_total);
              $("#shipment_div").attr('hidden',true);
              Mercadopago.getInstallments({
                "bin": getBin(),
                "amount": parseFloat(document.querySelector('#total').value),
              }, setInstallmentInfo);

            }
        } else {
            alert(`payment method info error: ${response}`);
        }
    };
    doSubmit = false;
    addEvent(document.querySelector('#payButton'), 'click', doPay);
    function doPay(event){
        event.preventDefault();
        if(!doSubmit){
            var $form = document.querySelector('#paymentForm');
            window.Mercadopago.createToken($form, sdkResponseHandler);
            return false;
        }
    };
    function sdkResponseHandler(status, response) {
        if (status != 200 && status != 201) {
            alert("verify filled data");
        }else{
            var form = document.querySelector('#paymentForm');
            var card = document.createElement('input');
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', response.id);
            form.appendChild(card);
            doSubmit=true;
            // Una vez que estamos seguros que no hay error establecemos el token que representa el metodo de pago
            const cardToken = document.getElementById("cardToken");
            // antes de establecer el valor del token, tenemos que asegurarnos que el elemento que contenga la red que represento
            // ese metodo de pago sea establecido, por eso hay que llamar al siguiente metodo para que se establezca esa red a partir de
            // lo que ya el usuario nos ingreso y que ya no hay errores (el numero es correcto y demas).
            setCardNetwork();
            // Le establecemos el valor a ese elemento viniendo directamente de la respuesta, simplemente con el id que representa ese metodo de pago
            cardToken.value = response.id;
            form.submit();
        }
    };
    function setInstallmentInfo(status, response) {
            var selectorInstallments = document.querySelector("#installments"),
            fragment = document.createDocumentFragment();
            selectorInstallments.options.length = 0;
            if (response.length > 0) {
                var option = new Option("Cuotas", '-1'),
                payerCosts = response[0].payer_costs;
                fragment.appendChild(option);
                for (var i = 0; i < payerCosts.length; i++) {
                    fragment.appendChild(new Option(payerCosts[i].recommended_message, payerCosts[i].installments));
                }
                selectorInstallments.appendChild(fragment);
                selectorInstallments.removeAttribute('disabled');
            }
        };
    </script>

    <script>
    window.addEventListener('load',function(){
        // Accedemos al Formulario por el id
        const mercadoPagoForm = document.getElementById("paymentForm");
        // Agregamos un evenoto para realizar operaciones una vez que se haya enviado
        mercadoPagoForm.addEventListener('submit', function(e) {
            // Solo queremos que esto se ejecute unicamente en el caso de enviar un pago con MercadoPago
            // Consiste en que si el elemento actual de este formulario llamado mercadoPagoForm , en el caso particular del valor de la plataforma
            // de pago coincide exactamente con la que tenemos de MP particularmente.
                // Utilizamos el evento y prevenimos que se envie el formulario para poder realizar las acciones adicionales
                e.preventDefault();
                // Ahora si utilizamos la variable mercadoPago y llamamos al metodo createToken
                // Este metodo recibe el formulario con todos los campos, metodos y elementos relacionados con MP
                // y tiene una funcion anonima que recibe el estado de la peticion y la respuesta
                mercadoPago.createToken(mercadoPagoForm, function(status, response) {
                    // Si el estado es un estado no es de exito (200 o 201)
                    if (status != 200 && status != 201) {
                        // Obtenemos el elemento de errores para establecerle un valor
                        const errors = document.getElementById("paymentErrors");
                        // Le establecemos el contenido que viene de la respuesta de un elemento llamado cause (puede haber muchas causas de error) y de alli obtenemos la descripcion de la causa
                        errors.textContent = response.cause[0].description;
                    } else {
                        // Una vez que estamos seguros que no hay error establecemos el token que representa el metodo de pago
                        const cardToken = document.getElementById("cardToken");
                        // antes de establecer el valor del token, tenemos que asegurarnos que el elemento que contenga la red que represento
                        // ese metodo de pago sea establecido, por eso hay que llamar al siguiente metodo para que se establezca esa red a partir de
                        // lo que ya el usuario nos ingreso y que ya no hay errores (el numero es correcto y demas).
                        setCardNetwork();
                        // Le establecemos el valor a ese elemento viniendo directamente de la respuesta, simplemente con el id que representa ese metodo de pago
                        cardToken.value = response.id;
                        // enviamos el formulario.
                        mercadoPagoForm.submit();
                    }
                });
        });
      });
      </script>
