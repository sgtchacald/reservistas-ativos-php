@extends('adminlte::page') 
@section('title', 'Cadastrar Reservista')


@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">Cadastrar Reservista</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
	<!-- Campo select -->
	<div class="col-sm-6">
		<label>Label Campo</label>
		<select class="form-control">
			<option value="">Selecione</option> 
			@foreach ($permissoesUsuario as $key => $value)
			<option value="{{$key}}">{{$value}}</option> 
			@endforeach
		</select>
	</div
	
	<!-- Campo radioButton -->
	<div class="col-sm-6">
		<!-- radio -->
		<div class="form-group">
			<label>Label Campo</label>
			<div class="form-check" style="padding-top: 6px;">
				@foreach ($simNao as $key => $value)     <input class="form-check-input" type="radio" name="souOficial" value="{{$key}}">     
				<label class="form-check-label" style="padding-right: 35px;">{{$value}}</label> 
				@endforeach
			</div>
		</div>
	</div>
	
	<!-- Campo ... -->
@stop 

@section('js')
<script> 
    $(function(){
    	//jquery ou javascript aqui 
    }); 
</script>
@stop
