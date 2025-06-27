<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col items-center justify-center min-h-[70vh]">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl px-8 py-10 border border-gray-100">
        <div class="flex justify-center mb-6">

        </div>
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Реєстрація у Curlsy</h2>
        <form wire:submit="register" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ім'я</label>
                <input wire:model="name" id="name" type="text" required autofocus
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input wire:model="email" id="email" type="email" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                <input wire:model="password" id="password" type="password" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Підтвердіть пароль</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <button type="submit"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-lg text-lg shadow transition">
                Зареєструватися
            </button>
        </form>
        <div class="text-center text-gray-500 mt-6 text-sm">
            Вже маєте акаунт?
            <a href="{{ route('login') }}" class="text-yellow-700 hover:underline font-medium">Увійти</a>
        </div>
    </div>
</div>
