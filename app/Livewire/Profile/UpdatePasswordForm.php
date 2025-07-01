<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordForm extends Component
{
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function save()
    {
        $validated = Validator::make([
            'current_password' => $this->current_password,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ], [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ])->validate();

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'Поточний пароль невірний.');
            return;
        }

        Auth::user()->update([
            'password' => Hash::make($this->password)
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('status', 'Пароль оновлено!');
    }

    public function render()
    {
        return view('livewire.profile.update-password-form');
    }
}
