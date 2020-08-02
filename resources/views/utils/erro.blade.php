@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	@if(Session::has('alert-' . $msg))
		<div class="alert alert-{{ $msg }}" role="alert">
			{!! Session::get('alert-' . $msg) !!}
		</div>
	@endif
@endforeach

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif