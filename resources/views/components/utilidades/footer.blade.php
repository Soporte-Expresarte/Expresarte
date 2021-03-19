<div>
    <footer class="bg-gray-900">
        <div class="px-6">
            <div class="lg:max-w-6xl w-full mx-auto text-white">
                <div class="text-center text-3xl pt-8">
                    Sobre Nosotros
                </div>

                <div class="grid md:grid-cols-3 grid-cols-1 mt-6">
                    <div class="p-4">
                        <div class="text-center text-xl capitalize">
                            Compartir por RRSS
                        </div>
                        <div class="grid grid-cols-3 mt-6">
                            <div class="mx-auto hover:text-gray-300 transition duration-500">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=https://expresarte.cl"
                                   target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                         class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="mx-auto hover:text-gray-300 transition duration-500">
                                <a href="https://twitter.com/intent/tweet?text=Se%20parte%20de%20una%20gran%20idea&url=https://expresarte.cl"
                                   target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                         class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="mx-auto hover:text-gray-300 transition duration-500">
                                <a href="https://api.whatsapp.com/send?text=Se%20parte%20de%20una%20gran%20idea%20https://expresarte.cl"
                                   target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                         class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="px-4">
                            <img class="object-contain h-32 w-full "
                                 src="{{asset('images/logo.png')}}">
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="text-center text-xl capitalize">
                            Secciones principales
                        </div>
                        <div class="grid grid-cols-2 ml-4 mt-6">
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('root') }}">Inicio</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-artistas') }}">Artistas</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-exposiciones') }}">Obras</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-expo') }}">Exposiciones</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-noticias') }}">Noticias</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-eventos') }}">Eventos</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-market') }}">Market</a></div>
                            <div class="mt-2 mx-auto hover:text-gray-300 transition duration-500"><a
                                    href="{{ route('index-crowdfunding') }}">Crowdfunding</a></div>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="text-center text-xl">
                            Acerca De Expresarte.cl
                        </div>

                        <div>
                            <a href="{{ route('politicas-privacidad') }}">
                                <div class="mt-8 pl-4 hover:text-gray-300 transition duration-500">
                                    Pol&iacute;ticas de privacidad
                                </div>
                            </a>

                            <a href="{{ route('politicas-privacidad') }}">
                                <div class="mt-2 pl-4 hover:text-gray-300 transition duration-500">
                                    Terminos y condiciones
                                </div>
                            </a>

                            <a href="#">
                                <div class="mt-2 pl-4 hover:text-gray-300 transition duration-500">
                                    Preguntas frecuentes
                                </div>
                            </a>

                            <a href="#">
                                <div class="mt-2 pl-4 hover:text-gray-300 transition duration-500">
                                    Ayuda y asistencia
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

                <div class="text-center font-light pb-8 md:mt-0 mt-4">
                    Expresarte | Copyright &copy; {{ date("Y") }}
                </div>
            </div>
        </div>

    </footer>
</div>
