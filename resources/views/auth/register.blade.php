<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href={{ route("root") }}>
                <img src="{{asset('images/logoConSombra.png')}}" style="width: 600px; height: 100px;" />
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @livewire('formulario-registro')


    </x-jet-authentication-card>

    <div class="h-16 bg-gray-100"></div>

</x-guest-layout>
