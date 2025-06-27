<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if (\Illuminate\Support\Facades\Auth::user()->is_admin) {
            $this->redirectIntended(default: '/admin', navigate: true);
            return;
        }

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col items-center justify-center min-h-[70vh]">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl px-8 py-10 border border-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Вхід у Curlsy</h2>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input wire:model="form.email" id="email" type="email" required autofocus
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                <input wire:model="form.password" id="password" type="password" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-400" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm">
                    <input wire:model="form.remember" type="checkbox" class="rounded border-gray-300">
                    Запам'ятати мене
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-yellow-600">Забули пароль?</a>
                @endif
            </div>
            <button type="submit"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-lg text-lg shadow transition">
                Увійти
            </button>
        </form>
        <div class="text-center text-gray-500 mt-6 text-sm">
            Ще немає аккаунту?
            <a href="{{ route('register') }}" class="text-yellow-700 hover:underline font-medium">Реєстрація</a>
        </div>
    </div>
</div>
