<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Видалити акаунт
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Після видалення облікового запису всі дані буде безповоротно втрачено.
        </p>
    </header>

    <form wire:submit.prevent="deleteUser" class="mt-6 space-y-6">
        <div>
            <label for="delete_user_password" class="block text-sm font-medium">Підтвердіть пароль</label>
            <input wire:model.defer="password" type="password" id="delete_user_password" class="input">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-danger mt-4">
            Видалити акаунт
        </button>
    </form>
</section>
