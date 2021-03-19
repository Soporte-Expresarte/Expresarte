<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información de Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información del perfil de tu cuenta y dirección de email.') }}
    </x-slot>
    
    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Selecciona una nueva foto') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Borrar foto') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- RUT -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="rut" value="{{ __('Rut') }}" />
            <x-jet-input id="rut" type="text" class="mt-1 block w-full" wire:model.defer="state.rut" autocomplete="rut" />
            <x-jet-input-error for="rut" class="mt-2" />
        </div>

        <!-- Nombre -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nombre') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="apellido" value="{{ __('Apellido') }}" />
            <x-jet-input id="apellido" type="text" class="mt-1 block w-full" wire:model.defer="state.apellido" autocomplete="apellido" />
            <x-jet-input-error for="apellido" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="telefono" value="{{ __('Teléfono (formato: 932345678)') }}" />
            <x-jet-input id="telefono" type="tel" class="mt-1 block w-full" pattern="9[3-9][0-9]{7}" wire:model.defer="state.telefono" autocomplete="telefono"/>
            <x-jet-input-error for="telefono" class="mt-2" />
        </div>

        <!-- Fecha de nacimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fecha_nacimiento" value="{{ __('Fecha de nacimiento') }}" />
            <x-jet-input id="fecha_nacimiento" type="date" class="mt-1 block w-full" wire:model.defer="state.fecha_nacimiento" autocomplete="fecha_nacimiento"/>
            <x-jet-input-error for="fecha_nacimiento" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar cambios') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
