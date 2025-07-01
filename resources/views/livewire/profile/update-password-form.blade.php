<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Оновлення пароля
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Введіть новий пароль для свого облікового запису.
        </p>
    </header>

    @if (session()->has('status'))
        <div class="text-green-600 mt-2">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mt-6 space-y-6">
        <div>
            <label for="current_password" class="block text-sm font-medium">Поточний пароль</label>
            <input wire:model.defer="current_password" type="password" id="current_password" class="input" autocomplete="current-password">
            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium">Новий пароль</label>
            <input wire:model.defer="password" type="password" id="password" class="input" autocomplete="new-password">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium">Підтвердіть пароль</label>
            <input wire:model.defer="password_confirmation" type="password" id="password_confirmation" class="input" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Оновити пароль</button>
    </form>
</section>
