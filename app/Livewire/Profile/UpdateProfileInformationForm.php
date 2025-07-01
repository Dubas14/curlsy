<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UpdateProfileInformationForm extends Component
{
    public $name;
    public $email;
    public $isDirty = false;

    protected $listeners = ['profileUpdated' => '$refresh'];

    public function mount()
    {
        $this->fill([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email
        ]);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['name', 'email'])) {
            $this->isDirty = $this->name != Auth::user()->name || $this->email != Auth::user()->email;
        }
    }

    public function updateProfileInformation()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id())
            ],
        ]);

        $user = Auth::user();

        // Якщо email змінився - скидаємо підтвердження email
        if ($user->email !== $validated['email']) {
            $user->forceFill([
                'email_verified_at' => null
            ]);
        }

        $user->update($validated);

        $this->isDirty = false;
        $this->dispatch('profile-updated');
        session()->flash('profile-status', 'Профіль успішно оновлено!');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
