@php($title = __('Profile'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Last login: ') }} {{ Auth::user()->last_login_at?->diffForHumans() ?? __('Never') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Profile Information Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl transition-all hover:shadow-xl hover:-translate-y-1">
                <div class="max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('Profile Information') }}</h3>
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Profile information updated successfully.') }}
                        </div>
                    @endif

                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl transition-all hover:shadow-xl hover:-translate-y-1">
                <div class="max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('Update Password') }}</h3>
                    </div>

                    @if (session('status') === 'password-updated')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Password updated successfully.') }}
                        </div>
                    @endif

                    <livewire:profile.update-password-form />
                </div>
            </div>

            <!-- Account Deletion Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl transition-all hover:shadow-xl">
                <div class="max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('Delete Account') }}</h3>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
