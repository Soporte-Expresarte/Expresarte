<div class="carousel relative bg-center container max-w-full mx-auto">
    <div class="carousel-inner relative overflow-hidden max-w-full">

        <!--Slide 1-->
        <input class="carousel-open is-actual" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden=""
               checked="checked">
        <div class="carousel-item absolute opacity-0" style="height:60vh;">
            <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                 style="background-image: url({{ isset($plana_19->banner)? asset($plana_19->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                @if($plana_19->titulo || $plana_19->descripcion)
                    <div
                        class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                        <div class="grid md:grid-cols-2 grid-cols-1">
                            <div class="md:col-span-2 col-span-1">
                                <div class="md:text-3xl text-lg text-center">
                                    {{ $plana_19->titulo }}
                                </div>

                                <div class="mt-2 md:text-xl text-sm">
                                    {{ $plana_19->descripcion }}
                                </div>

                                @if($plana_19->link)
                                    <div class="h-4"></div>
                                    <a href="{{ $plana_19->link }}" class="mt-6">
                                        <div
                                            class="rounded-lg md:text-xl text-sm px-4 py-2 mx-auto hover:bg-purple-600 absolute bg-purple-700 transition duration-500 text-white font-semibold">
                                            Leer más
                                        </div>
                                    </a>
                                    <div class="md:h-12 h-9"></div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <label for="carousel-3" id="for-carousel-3" onclick="updateSlider3()"
               class="prev control-1 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-2" id="for-carousel-2" onclick="updateSlider2()"
               class="next control-1 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 2-->
        <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0 bg-cover bg-center" style="height:60vh;">

            <div class="block h-full w-full mx-auto flex py-6 md:pt-0 md:items-center bg-cover bg-center"
                 style="background-image: url({{ isset($plana_20->banner)? asset($plana_20->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                @if($plana_20->titulo || $plana_20->descripcion)
                    <div
                        class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                        <div class="grid md:grid-cols-2 grid-cols-1">
                            <div class="md:col-span-2 col-span-1">
                                <div class="md:text-3xl text-lg text-center">
                                    {{ $plana_20->titulo }}
                                </div>

                                <div class="mt-2 md:text-xl text-sm">
                                    {{ $plana_20->descripcion }}
                                </div>

                                @if($plana_20->link)
                                    <div class="h-4"></div>
                                    <a href="{{ $plana_20->link }}" class="mt-6">
                                        <div
                                            class="rounded-lg md:text-xl text-sm px-4 py-2 mx-auto hover:bg-purple-600 absolute bg-purple-700 transition duration-500 text-white font-semibold">
                                            Leer más
                                        </div>
                                    </a>
                                    <div class="md:h-12 h-9"></div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <label for="carousel-1" id="for-carousel-1" onclick="updateSlider1()"
               class="prev control-2 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-3" id="for-carousel-3" onclick="updateSlider3()"
               class="next control-2 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 3-->
        <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0 bg-cover bg-center" style="height:60vh;">

            <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                 style="background-image: url({{ isset($plana_21->banner)? asset($plana_21->banner): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">

                @if($plana_21->titulo || $plana_21->descripcion)
                    <div
                        class="py-4 bg-gray-800 bg-opacity-50 text-white my-auto max-w-3xl p-4 sm:mx-16 mx-4 my-4 rounded-md">
                        <div class="grid md:grid-cols-2 grid-cols-1">
                            <div class="md:col-span-2 col-span-1">
                                <div class="md:text-3xl text-lg text-center">
                                    {{ $plana_21->titulo }}
                                </div>

                                <div class="mt-2 md:text-xl text-sm">
                                    {{ $plana_21->descripcion }}
                                </div>

                                @if($plana_21->link)
                                    <div class="h-4"></div>
                                    <a href="{{ $plana_21->link }}" class="mt-6">
                                        <div
                                            class="rounded-lg md:text-xl text-sm px-4 py-2 mx-auto hover:bg-purple-600 absolute bg-purple-700 transition duration-500 text-white font-semibold">
                                            Leer más
                                        </div>
                                    </a>
                                    <div class="md:h-12 h-9"></div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <label for="carousel-2" id="for-carousel-2" onclick="updateSlider2()"
               class="prev control-3 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-1" id="for-carousel-1" onclick="updateSlider1()"
               class="next control-3 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!-- Add additional indicators for each slide-->
        <ol class="carousel-indicators">
            <li class="inline-block mr-3">
                <label for="carousel-1" onclick="updateSlider1()"
                       class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
            </li>
            <li class="inline-block mr-3">
                <label for="carousel-2" onclick="updateSlider2()"
                       class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
            </li>
            <li class="inline-block mr-3">
                <label for="carousel-3" onclick="updateSlider3()"
                       class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
            </li>
        </ol>

    </div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.1.min.js"></script>
<script>
    var theloop;

    function loopSlider() {
        theloop = setInterval(function () {

            if ($('#carousel-1').hasClass('is-actual')) {
                $('#carousel-1').removeClass('is-actual');

                $("#for-carousel-2").trigger("click");

                $('#carousel-2').addClass('is-actual');
                $('#carousel-3').removeClass('is-actual');

            } else if ($('#carousel-2').hasClass('is-actual')) {
                $('#carousel-2').removeClass('is-actual');

                $("#for-carousel-3").trigger("click");

                $('#carousel-3').addClass('is-actual');
                $('#carousel-1').removeClass('is-actual');

            } else {
                $('#carousel-3').removeClass('is-actual');

                $("#for-carousel-1").trigger("click");

                $('#carousel-1').addClass('is-actual');
                $('#carousel-2').removeClass('is-actual');
            }
        }, 5000);
    }

    function reinitLoop(time) {
        clearInterval(theloop);
        setTimeout(loopSlider(), time);
    }

    function updateSlider1() {
        if ($('#carousel-1').hasClass('is-actual')) {
            $('#carousel-2').removeClass('is-actual');
            $('#carousel-3').removeClass('is-actual');
        } else {
            $('#carousel-1').addClass('is-actual');
            $('#carousel-2').removeClass('is-actual');
            $('#carousel-3').removeClass('is-actual');
        }
        reinitLoop(5000);
    }

    function updateSlider2() {
        if ($('#carousel-2').hasClass('is-actual')) {
            $('#carousel-1').removeClass('is-actual');
            $('#carousel-3').removeClass('is-actual');
        } else {
            $('#carousel-2').addClass('is-actual');
            $('#carousel-1').removeClass('is-actual');
            $('#carousel-3').removeClass('is-actual');
        }
        reinitLoop(5000);
    }

    function updateSlider3() {
        if ($('#carousel-3').hasClass('is-actual')) {
            $('#carousel-1').removeClass('is-actual');
            $('#carousel-2').removeClass('is-actual');
        } else {
            $('#carousel-3').addClass('is-actual');
            $('#carousel-1').removeClass('is-actual');
            $('#carousel-2').removeClass('is-actual');
        }
        reinitLoop(5000);
    }

    $(window).ready(function () {
        loopSlider();
    });

</script>
