@if (count($errors) > 0)
    <div x-data="{ isVisible: true}" x-init="
    setTimeout(()=>{
        isVisible = false
    }, 5000)
    " x-show.transition.duration.1000ms="isVisible" class="alert alert-danger">
        <p>Corrige los siguientes errores: <a href="#" class="close" data-dismiss="alert"
                aria-label="close">&times;</a></p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                    class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
