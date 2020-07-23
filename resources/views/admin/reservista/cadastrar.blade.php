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
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Cadastrar Reservista</h3>

		<div class="card-tools">
			<button type="button" class="btn btn-tool"data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
			<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fas fa-times"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
			<!-- Campo select -->
			<div class="col-sm-12  mb-3">
        		<div class="col-sm-2">
        			<label>Tipo Usuario</label> <select class="form-control">
        				<option value="">Selecione</option> 
        					@foreach ((\App\Dominios\PermissoesUsuario::getDominio()) as $key => $value)
        						<option value="{{$key}}">{{$value}}</option> 
        					@endforeach
        			</select>
        		</div>
			</div>

			<div class="col-sm-12  mb-3">
        		<div class="col-sm-2">
        			<label>Força de Origem</label> 
        		</div>
			</div>

	</div>
	<div class="card-footer">Esta funcionalidade permite que você cadastre um reservista no sistema.</div>
</div>
@stop 

@section('js')
<script> 
    $(function(){
    	    
    }); 
</script>
@stop