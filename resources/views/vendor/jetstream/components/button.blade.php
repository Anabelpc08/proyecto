<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn  btn-block col-5 btn-primary cb-primary text-uppercase']) }}>
    {{ $slot }}
</button>
