<div class="bg-white">
    @section('title')
        Perfil
    @endsection

    @section('styles')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- Icons --}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @endsection

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
    </x-slot>

    <div class="px-6">
        <div class="lg:max-w-6xl w-full mx-auto lg:mb-10 mb-4">

            <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
            <div class="text-center desaparece_5_segs">
                @if (session()->has('success'))
                    <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                        ✔️{{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="h-8"></div>

            <div class="grid border-none outline-none md:grid-cols-4 grid-cols-2 font-sans text-white text-xl">
                <button type="button" wire:click="$set('vista', 'informacion_personal')"
                        class="text-center @if($vista == "informacion_personal") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-6 md:rounded-l-lg rounded-tl-lg transition duration-500">
                    Cuenta
                </button>

                <button type="button" wire:click="$set('vista', 'informacion_galeria')"
                        class="text-center @if($vista == "informacion_galeria") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-6 md:rounded-none rounded-tr-lg transition duration-500">
                    Galería
                </button>

                <button type="button" wire:click="$set('vista', 'informacion_market')"
                        class="text-center @if($vista == "informacion_market") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-6 md:rounded-none rounded-bl-lg transition duration-500">
                    Market
                </button>

                <button type="button" wire:click="$set('vista', 'informacion_crowdfunding')"
                        class="text-center @if($vista == "informacion_crowdfunding") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-6 md:rounded-r-lg rounded-br-lg rounded-r-lg transition duration-500">
                    Crowdfunding
                </button>
            </div>

            @if ($vista == "informacion_personal")
                @livewire('perfil.informacion-personal')
            @elseif ($vista == "informacion_galeria")
                @livewire('perfil.informacion-galeria')
            @elseif ($vista == "informacion_market")
                @livewire('perfil.market.informacion-market')
            @elseif ($vista == "informacion_crowdfunding")
                @livewire('perfil.informacion-crowdfunding')
            @endif

        </div>
    </div>
</div>
