<div class="swiper-container s2 border bg-gray-50 rounded-md">
    <div class="swiper-wrapper mb-5">
        @if ($productos->count() != 0)
            @foreach ($productos as $producto)
                <div class="swiper-slide mb-15 mx-7">
                    <a href="{{ route('ver-producto', ['slug' => $producto->slug]) }}">
                        <img class="flex content-around" id={{$producto->id}}
                            src="{{isset($producto->imagenes[0])? asset($producto->imagenes[0]->ruta) : asset('images/imagen-default.jpg')}}"
                             alt="img-{{$producto->slug}}">
                        <div class="flex flex-col justify-center items-center">
                            <p class="text-center text-gray-900">{{$producto->nombre}}</p>
                            <p class="text-center text-gray-900">Artista: {{$producto->artista->name}}</p>
                            <p class="text-center text-sm leading-5 font-medium text-gray-900">Precio:
                                ${{number_format($producto->precio, 0, ",", ".")}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <h1 class="text-xl font-bold italic mb-10 mx-auto">No se encontraron coincidencias</h1>
        @endif
    </div>

    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
