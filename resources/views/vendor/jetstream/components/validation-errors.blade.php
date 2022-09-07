@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger text-sm p-1']) !!} role="alert">

        <ul>
            @foreach ($errors->all() as $error)
                <li>Usuario y/o contraseña incorrectos.</li>
            @endforeach
        </ul>
    </div>
@endif
