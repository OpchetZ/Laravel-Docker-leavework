<x-guest-layout title="ลางาน">
    <x-auth-card>
        <x-slot name="logo">

            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

        </x-slot>
        @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <span class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <a href="{{ route('login') }}"style="font-size: 20px;color: white;">Log in</a>
                    </span>
                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif --}}
                @endauth
            </div>
        @endif
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


    </x-auth-card>
</x-guest-layout>
