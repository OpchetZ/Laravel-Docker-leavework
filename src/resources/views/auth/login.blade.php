<x-guest-layout title="Login">
    <x-auth-card>
        <x-slot name="logo">
           
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="login" :value="__('อีเมล / ชื่อ')" />

                <x-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('รหัสผ่าน')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            

                <x-button class="ml-3">
                    {{ __('เข้าสู่ระบบ') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
