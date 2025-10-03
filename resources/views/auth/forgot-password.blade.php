<x-guest-layout>
    <div class="center">
        <div class="box form-group">
            <div class="text-center logo-div">
                <img src="{{ asset('logo.jpeg') }}">
            </div>
            <br>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link para redefinição de senha que permitirá que você escolha uma nova.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('E-mail:')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus placeholder="Informe seu e-mail" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <br>
                <div class="form-group">
                    <x-primary-button class="btn btn-success">
                        {{ __('Enviar e-mail') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>