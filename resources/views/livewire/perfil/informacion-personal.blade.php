<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
            {{-- @livewire('profile.update-profile-information-form') --}}
            {{-- Ahora busca el componente creado en App\Http\Livewire\UpdateProfileInformationForm --}}
            @livewire('perfil.personal.form-actualizar-informacion-perfil')

            <x-jet-section-border/>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('perfil.personal.form-actualizar-contrasena')
            </div>

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('perfil.personal.form-autentificacion-dos-factores')
            </div>

            <x-jet-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('perfil.personal.form-cerrar-sesiones-otros-navegadores')
        </div>

        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('perfil.personal.form-borrar-usuario')
        </div>
    </div>
</div>
