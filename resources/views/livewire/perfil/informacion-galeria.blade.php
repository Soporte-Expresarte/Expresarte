<div>
    @if (Auth::user()->currentTeam->name == "Usuarios")
        <div class="text-center"> No hay actividades pendientes</div>
    @elseif (Auth::user()->currentTeam->name == "Artistas")
        @livewire('perfil.galeria.artista.informacion-artista')
    @elseif (Auth::user()->currentTeam->name == "Administradores")
        @livewire('perfil.galeria.admin.perfil-admin')
    @endif
</div>
