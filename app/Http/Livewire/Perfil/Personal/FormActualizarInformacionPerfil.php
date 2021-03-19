<?php

namespace App\Http\Livewire\Perfil\Personal;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * Clase reciclada de vendor\laravel\jetstream\src\Http\Livewire\UpdateProfileInformationForm.php.
 * Es para cambiar la redirección de updateProfileInformation(), 
 * de "return redirect()->route('profile.show')" a "return redirect()->route("vista-perfil")".
 */
class FormActualizarInformacionPerfil extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        
        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            //return redirect()->route('profile.show'); Esto se usaba en el archivo original.
            return redirect()->route("vista-perfil");
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-dropdown');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        $this->emit('refresh-navigation-dropdown');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.perfil.personal.form-actualizar-informacion-perfil');
    }
}
