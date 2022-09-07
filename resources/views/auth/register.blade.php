<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mt-4">
                <x-jet-label for="n_empleado" value="{{ __('Número de empleado') }}" />
                <x-jet-input id="n_empleado" class="block mt-1 w-full" type="text" name="n_empleado" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="Nombre" value="{{ __('Nombre') }}" />
                <x-jet-input id="Nombre" class="block mt-1 w-full" type="text" name="nombre" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="apellidoPat" value="{{ __('Apellido Paterno') }}" />
                <x-jet-input id="apellidoPat" class="block mt-1 w-full" type="text" name="apellidoPat" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="apellidoMat" value="{{ __('Apellido Materno') }}" />
                <x-jet-input id="apellidoMat" class="block mt-1 w-full" type="text" name="apellidoMat" required/>
            </div>

        
            <div class="mt-4">
                <x-jet-label for="usuario" value="{{ __('Usuario') }}" />
                <x-jet-input id="usuario" class="block mt-1 w-full" type="text" name="user" :value="old('username')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>


                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>