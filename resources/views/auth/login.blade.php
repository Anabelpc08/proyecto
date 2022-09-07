
<x-guest-layout>

    <x-jet-authentication-card>

        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <x-jet-label value="{{ __('Usuario:') }}" />

                    <x-jet-input class="{{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                                 name="identity" :value="old('email')" autofocus required autocomplete="off" />
                    <x-jet-input-error for="username"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Contraseña:') }}" />

                    <!-- <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" /> -->

                <!-- Added HIDE/SHOW button -->
                <div class="input-group" id="show_hide_password">
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                            name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                                <a href="">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </a>
                        </span>
                    </div>
                </div>
                                    
                <x-jet-input-error for="password"></x-jet-input-error>
                                    
                </div>

                <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div> -->

                <div class="-mb-1">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <!-- @if (Route::has('password.request'))
                            <a class="text-muted mr-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif -->

                        <x-jet-button>
                            {{ __('Entrar') }}
                        </x-jet-button>
                       
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
    
 

</x-guest-layout>

