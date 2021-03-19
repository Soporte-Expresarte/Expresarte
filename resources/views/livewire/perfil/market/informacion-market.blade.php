<div>
    <div class="max-w-full mx-auto py-8 sm:px-2">
        <div class="mx-8 mb-8">
            <!-- Mensajes de reporte enviado satisfactoriamente -->
            @if (session()->has('success'))
                <div class="my-4 p-3 bg-green-300 text-green-700 rounded shadow-sm">
                    {{ session('success') }} ✔️
                </div>
            @endif
        </div>
        <!--Reportes-->
        @if (Auth::user()->current_team_id == 1 )
            <div class="mx-8">
                <h2 class="text-xl font-bold text-gray-500">Reportes</h2>
                @livewire("perfil.market.ver-reportes")
                <x-jet-section-border/>
            </div>
        @endif

        <!--Productos en venta-->
        @if (Auth::user()->current_team_id == 2 )
            <div class="mx-8">
                <h2 class="text-xl font-bold text-gray-500">Productos en Venta</h2>
                @livewire("perfil.market.ver-productos")
                <x-jet-section-border/>
            </div>
        @endif
        <!--Gestion de ordenes a despachar a compradores-->
        @if (Auth::user()->current_team_id == 2)
            <div class="mt-5 mx-8">
                <h2 class="text-xl font-bold text-gray-500">&Oacute;rdenes pendientes de despacho</h2>
                @livewire("perfil.market.gestion-despachos-ordenes")
                <x-jet-section-border/>
            </div>
        @endif
        <!--Historial de compras-->
        @if (Auth::user()->current_team_id == 2 || Auth::user()->current_team_id == 3)
            <div class="mt-5 mx-8">
                <h2 class="text-xl font-bold text-gray-500">&Oacute;rdenes Realizadas</h2>
            </div>
            <div class="mt-5 sm:mt-0 flex justify-center">
                @livewire("perfil.market.ver-ordenes")
            </div>
            <div class="mx-8">
                <x-jet-section-border/>
            </div>
        @endif
    </div>
</div>
