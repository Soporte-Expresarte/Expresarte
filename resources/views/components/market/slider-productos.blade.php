<div>
    <!-- top gallery -->
    <div class="swiper-container gallery">
        <div class="swiper-wrapper">
            @foreach ($imagenes as $img)
                <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                        <img src="{{isset($img)? asset($img->ruta) : asset('images/imagen-default.jpg')}}">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- thumbs -->
    <div class="hidden md:block gallery-thumbs overflow-hidden">
        <div class="swiper-wrapper custom-wrapper-transform">
            @foreach ($imagenes as $img)
                <div class="swiper-slide custom-slide-height">
                    <img src="{{isset($img)? asset($img->ruta) : asset('images/imagen-default.jpg')}}">
                </div>
            @endforeach
        </div>
    </div>
</div>