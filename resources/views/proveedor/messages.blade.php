@if (count($errors) > 0)
    <div class="alert alert-danger">
    <p><i class="fas fa-times-circle"></i> Corrige los siguientes errores: <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info', 'error'] as $msg)
        @if(Session::has('alert-' . $msg))
          @if ($msg == 'success')
            <p class="alert alert-{{ $msg }}"><i class="fas fa-check-square mr-3"></i>{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @elseif($msg == 'warning')
            <p class="alert alert-{{ $msg }}"><i class="fas fa-pen-square mr-3"></i>{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @elseif($msg == 'danger')
            <p class="alert alert-{{ $msg }}"><i class="fas fa-minus-square mr-3"></i>{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @elseif($msg == 'error')
            <p class="alert alert-danger"><i class="fas fa-1x fa-times-circle mr-3"></i>{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

          @endif
        @endif
      @endforeach
</div>
