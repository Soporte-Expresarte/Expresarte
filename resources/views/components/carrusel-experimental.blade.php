<div>
    <div class="carousel relative bg-center container max-w-full mx-auto">
        <div class="carousel-inner relative overflow-hidden max-w-full">

            <!--Slide 1-->
            <input class="carousel-open is-actual" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden=""
                   checked="checked">
            <div class="carousel-item absolute opacity-0" style="height:60vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url('https://eu02.edcwb.com/img/web/header/tema/22.jpg'); background-repeat: no-repeat;">

                    <div class="grid grid-cols-1 py-4">
                        <div
                            class="rounded-lg bg-black bg-opacity-50 flex flex-col w-full xs:h-3/5 md:h-4/5 lg:h-full sm:w-2/6 md:w-2/5 lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide relative">
                            <div class="text-white font-bold sm:text-xl md:text-xl lg:text-xl xl:text-4xl my-3">
                                APOYA A L@S ARTISTAS LOCALES
                                <div>
                                    <p class="sm:text-xs md:text-sm lg:text-sm xl:text-2xl text-white my-3 mx-4">
                                        La cuarentena aún continúa. La coyuntura nos hace reflexionar acerca de como cada
                                        vez es más la imperiosa la forma de conectarnos.
                                    </p>
                                    <div class="w-full p-4 sm:w-1/2 lg:w-1/3">
                                        <a href="{{route('index-artistas')}}"
                                           class="button rounded-lg hover:bg-gray-700 p-3 bg-gray-800 text-white font-semibold sm:text-xs md:text-sm lg:text-sm xl:text-xl">
                                            Leer más
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <label for="carousel-3" id="for-carousel-3" onclick="updateSlider3()"
                   class="prev control-1 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2" id="for-carousel-2" onclick="updateSlider2()"
                   class="next control-1 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>


            <!--Slide 2-->
            <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:60vh;">

                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url('https://live.staticflickr.com/65535/50936447977_06b4a64de4_h.jpg'); background-repeat: no-repeat;">
                </div>

            </div>
            <label for="carousel-1" id="for-carousel-1" onclick="updateSlider1()"
                   class="prev control-2 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3" id="for-carousel-3" onclick="updateSlider3()"
                   class="next control-2 bg-opacity-50 hover:bg-opacity-50 transition duration-500 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>


            <!--Slide 3-->
            <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:60vh;">

                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                     style="background-image: url('https://live.staticflickr.com/65535/50936632626_275da082d3_h.jpg'); background-repeat: no-repeat;">
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
            }, 4000);
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
            reinitLoop(4000);
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
            reinitLoop(4000);
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
            reinitLoop(4000);
        }

        $(window).ready(function () {
            loopSlider();
        });

    </script>
</div>
