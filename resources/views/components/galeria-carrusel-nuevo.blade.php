<div>
    <div>
        <div class="sliderAx bg-center max-w-full mx-auto relative">
            @php
                $plana_1 = \App\Models\Carrusel::find(1);
               $plana_2 = \App\Models\Carrusel::find(2);
               $plana_3 = \App\Models\Carrusel::find(3);
            @endphp

            <div id="slider-1" class="bg-cover bg-center" style="height:60vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url({{ isset($plana_1->banner)? asset($plana_1->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                    <div>
                        @if($plana_1->titulo !=null || $plana_1->descripcion != null)
                            <div
                                class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                                <div class="grid md:grid-cols-2 grid-cols-1">
                                    <div class="md:col-span-2 col-span-1">
                                        <div class="md:text-3xl text-xl text-center font-semibold">
                                            {{ $plana_1->titulo }}
                                        </div>

                                        <div class="mt-2 md:text-xl text-sm">
                                            {{ $plana_1->descripcion }}
                                        </div>

                                        @if( $plana_1->link)
                                            <div class="md:h-8 h-6"></div>
                                            <a href="{{ $plana_1->link }}"
                                               class="bg-purple-700 transition duration-500 m-4 py-4 px-8 mx-auto text-white font-light md:text-xl text-sm rounded-lg hover:bg-purple-600">
                                                Leer más
                                            </a>
                                            <div class="h-4"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <br>
            </div>

            <div id="slider-2" class="bg-cover bg-center" style="height:60vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url({{ isset($plana_2->banner)? asset($plana_2->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                    <div>
                        @if($plana_2->titulo !=null || $plana_2->descripcion != null)
                            <div
                                class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                                <div class="grid md:grid-cols-2 grid-cols-1">
                                    <div class="md:col-span-2 col-span-1">
                                        <div class="md:text-3xl text-xl text-center font-semibold">
                                            {{ $plana_2->titulo }}
                                        </div>

                                        <div class="mt-2 md:text-xl text-sm">
                                            {{ $plana_2->descripcion }}
                                        </div>

                                        @if( $plana_2->link)
                                            <div class="md:h-8 h-6"></div>
                                            <a href="{{ $plana_2->link }}"
                                               class="bg-purple-700 transition duration-500 m-4 py-4 px-8 mx-auto text-white font-light md:text-xl text-sm rounded-lg hover:bg-purple-600">
                                                Leer más
                                            </a>
                                            <div class="h-4"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <br>
            </div>

            <div id="slider-3" class="bg-cover bg-center" style="height:60vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url({{ isset($plana_3->banner)? asset($plana_3->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                    <div>
                        @if($plana_3->titulo !=null || $plana_3->descripcion != null)
                            <div
                                class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                                <div class="grid md:grid-cols-2 grid-cols-1">
                                    <div class="md:col-span-2 col-span-1">
                                        <div class="md:text-3xl text-xl text-center font-semibold">
                                            {{ $plana_3->titulo }}
                                        </div>

                                        <div class="mt-2 md:text-xl text-sm">
                                            {{ $plana_3->descripcion }}
                                        </div>

                                        @if( $plana_3->link)
                                            <div class="md:h-8 h-6"></div>
                                            <a href="{{ $plana_3->link }}"
                                               class="bg-purple-700 transition duration-500 m-4 py-4 px-8 mx-auto text-white font-light md:text-xl text-sm rounded-lg hover:bg-purple-600">
                                                Leer más
                                            </a>
                                            <div class="h-4"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <br>
            </div>

            <div class="flex justify-between w-12 mx-auto pb-2 absolute inset-x-0 bottom-0">
                <button id="sButton1" onclick="sliderButton1()"
                        class="bg-purple-400 rounded-full w-5 p-2.5 mx-2"></button>
                <button id="sButton2" onclick="sliderButton2()"
                        class="bg-purple-400 rounded-full w-5 p-2.5 mx-2"></button>
                <button id="sButton3" onclick="sliderButton3()"
                        class="bg-purple-400 rounded-full w-5 p-2.5 mx-2"></button>
            </div>
        </div>

    </div>

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script>
        var cont = 0;
        var xx;

        function loopSlider() {
            xx = setInterval(function () {
                switch (cont) {
                    case 0: {
                        $("#slider-1").fadeOut(400);
                        //$("#slider-3").fadeOut(400);
                        //$("#slider-1").addClass('hidden');
                        //$("#slider-3").addClass('hidden');

                        $("#slider-2").delay(400).fadeIn(400);
                        //$("#slider-2").removeClass('hidden');

                        $("#sButton1").removeClass("bg-purple-800");
                        $("#sButton3").removeClass("bg-purple-800");
                        $("#sButton2").addClass("bg-purple-800");
                        cont = 1;
                        break;
                    }
                    case 1: {
                        //$("#slider-1").fadeOut(400);
                        $("#slider-2").fadeOut(400);
                        //$("#slider-1").addClass('hidden');
                        //$("#slider-2").addClass('hidden');

                        $("#slider-3").delay(400).fadeIn(400);
                        //$("#slider-3").removeClass('hidden');

                        $("#sButton2").removeClass("bg-purple-800");
                        $("#sButton1").removeClass("bg-purple-800");
                        $("#sButton3").addClass("bg-purple-800");
                        cont = 2;
                        break;
                    }
                    case 2: {
                        //$("#slider-2").fadeOut(400);
                        $("#slider-3").fadeOut(400);
                        //$("#slider-2").addClass('hidden');
                        //$("#slider-3").addClass('hidden');

                        $("#slider-1").delay(400).fadeIn(400);
                        //$("#slider-1").removeClass('hidden');

                        $("#sButton3").removeClass("bg-purple-800");
                        $("#sButton2").removeClass("bg-purple-800");
                        $("#sButton1").addClass("bg-purple-800");
                        cont = 0;
                        break;
                    }
                }
            }, 6000);
        }

        function reinitLoop(time) {
            clearInterval(xx);
            setTimeout(loopSlider(), time);
        }

        function sliderButton1() {
            $("#slider-2").fadeOut(400);
            $("#slider-3").fadeOut(400);
            //$("#slider-2").addClass('hidden');
            //$("#slider-3").addClass('hidden');

            $("#slider-1").delay(400).fadeIn(400);
            //$("#slider-1").removeClass('hidden');

            $("#sButton2").removeClass("bg-purple-800");
            $("#sButton3").removeClass("bg-purple-800");
            $("#sButton1").addClass("bg-purple-800");
            reinitLoop(6000);
            cont = 0
        }

        function sliderButton2() {
            $("#slider-3").fadeOut(400);
            $("#slider-1").fadeOut(400);
            //$("#slider-3").addClass('hidden');
            //$("#slider-1").addClass('hidden');

            $("#slider-2").delay(400).fadeIn(400);
            //$("#slider-2").removeClass('hidden');

            $("#sButton3").removeClass("bg-purple-800");
            $("#sButton1").removeClass("bg-purple-800");
            $("#sButton2").addClass("bg-purple-800");
            reinitLoop(6000);
            cont = 1
        }

        function sliderButton3() {
            $("#slider-1").fadeOut(400);
            $("#slider-2").fadeOut(400);
            //$("#slider-1").addClass('hidden');
            //$("#slider-2").addClass('hidden');

            $("#slider-3").delay(400).fadeIn(400);
            //$("#slider-3").removeClass('hidden');

            $("#sButton1").removeClass("bg-purple-800");
            $("#sButton2").removeClass("bg-purple-800");
            $("#sButton3").addClass("bg-purple-800");
            reinitLoop(6000);
            cont = 2
        }

        $(window).ready(function () {
            $("#slider-2").hide();
            $("#slider-3").hide();
            $("#sButton1").addClass("bg-purple-800");
            loopSlider();
        });
    </script>
</div>
