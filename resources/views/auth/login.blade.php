<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Session Status -->
    <x-auth-session-status class="float-left" :status="session('status')" />
    <div class="login-container">
        <div class="login-box-img">
            <img src="{{ asset('estoque.jpg') }}">
        </div>
        <div class="login-box">
            <!-- <h2>Bem-vindo de volta</h2> -->
            <div class="text-center">
                <img src="{{ asset('logo.jpeg') }}">
            </div>
            <br>
            <p class="subtitle">Se você já possui uma conta, preencha seus dados de acesso à plataforma.</p>
            <!-- <form method="POST" action="{{ route('login') }}"> -->
            <form method="POST" action="/login">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Digite seu e-mail" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 form-group">
                    <x-input-label for="password" :value="__('Senha')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="Digite sua senha" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Lembre de mim') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="btn btn-success">
                        {{ __('Entrar') }}
                    </x-primary-button>
                    <br>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>