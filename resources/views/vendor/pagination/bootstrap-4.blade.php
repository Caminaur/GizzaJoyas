{{-- https://stackoverflow.com/questions/28240777/custom-pagination-view-in-laravel-5 --}}

{{-- Following commands will generate Pagination template in resources/views/vendor/pagination
artisan vendor:publish --tag=laravel-pagination
artisan vendor:publish --}}

{{-- para ver todas las funciones de paginacion visitar https://laravel.com/docs/7.x/pagination --}}

@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
         {{-- Determina si estamos en la primera pagina del paginador --}}
        @if ($paginator->onFirstPage())
        {{-- Si estamos en la 1ra pagina desactivamos la posibilidad de hacer previous con atributo aria-disabled true  --}}
            <li class="pages-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
              <span class="pages-link" aria-hidden="true"><</span>   {{-- Aqui se customizamos la flechita previous y su capsula --}}
            </li>
        @else
        {{-- Si no estamos en la primer pagina del paginador hacemos funcional la etiqueta previous --}}
            <li class="pages-item">
                <a class="pages-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><</a>
            </li>
        @endif

        {{-- Pagination Elements --}}

        {{--cada elemento seria un array con los enlaces correspondientes de cada pagina,
        ej: en un paginador de 2 paginas:
         array:2 [▼
                      1 => "http://localhost:8000/productos?page=1"
                      2 => "http://localhost:8000/productos?page=2"
                    ] --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="pages-item disabled" aria-disabled="true"><span class="pages-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
              {{-- Recorro cada pagina del array --}}
                @foreach ($element as $page => $url)
                  {{-- Busco si la pagina recorrida es la pagina actual en nuestra URL --}}
                    @if ($page == $paginator->currentPage())
                      {{-- TRUE, entonces le damos la clase active y la hacemos span en lugar de link --}}
                        <li class="pages-item active" aria-current="page"><span class="pages-link">{{ $page }}</span></li>
                    @else
                      {{-- FALSE, la hacemos link con su respectiva $url y su numero de $page --}}
                        <li class="pages-item"><a class="pages-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        {{-- Si el paginador tiene mas paginas --}}
        @if ($paginator->hasMorePages())
          {{-- TRUE, mostramos activo el simbolo &rsaquo (">" en idioma utf-8) https://www.w3schools.com/charsets/ref_utf_punctuation.asp y le damos el link de la siguiente pagina --}}
            <li class="pages-item">
                <a class="pages-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">></a>
            </li>
        @else
          {{-- FALSE, le damos clase disabled para que no puedan seguir avanzando y la hacemos span en lugar de etiqueta a --}}
            <li class="pages-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="pages-link" aria-hidden="true">></span>
            </li>
        @endif
    </ul>
@endif
