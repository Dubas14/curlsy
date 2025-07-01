<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteUserForm extends Component
{
    public $password = '';

    public function deleteUser()
    {
        $user = Auth::user();

        // Перевіряємо, що введений пароль правильний
        if (!\Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Пароль невірний.');
            return;
        }

        // Виходимо з системи, видаляємо користувача
        Auth::logout();
        $user->delete();

        // Перенаправляємо на головну (можна на /, або як треба)
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}
