@extends('adminlte::page') @section('title', 'Cadastrar Reservista')


@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1>Módulo de Reservista</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">Cadastrar Reservista</li>
			</ol>
		</div>
	</div>
</div>
@stop @section('content')
<!-- Default box -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Cadastrar Reservista</h3>

		<div class="card-tools">
			<button type="button" class="btn btn-tool"
				data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
			<button type="button" class="btn btn-tool" data-card-widget="remove"
				data-toggle="tooltip" title="Remove">
				<i class="fas fa-times"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<form action="" method="post">
			<div class="row">
				<div class="form-group mb-3 col-6">
					<label>Nome</label> 
					<input type="text" class="form-control" placeholder="Nome Completo">
				</div>

				<div class="form-group mb-3 col-3">
					<!-- select -->
					<label>Tipo de Usuário</label>
					<select class="form-control">
						<option value="">Select</option> 
						@foreach ($permissoesUsuario as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-group mb-3 col-3">
					<div class="custom-control custom-radio">
						<label>Sou Oficial?</label>
						<?php $contRadio = 0; ?>
						<div class="form-check" style="margin-top:6px;">
        					@foreach ($simNao as $key => $value)
    							<input class="form-check-input col-1" type="radio" name="radio{{$contRadio++}}" value="{{$key}}"> 
    							<label class="form-check-label col-3">{{$value}}</label>
    						@endforeach
						</div>
					</div>
				</div>
			</div>
			

			<div class="row">
				<div class="form-group mb-3 col-6">
					<label>E-mail</label> 
					<input type="email" class="form-control" placeholder="E-mail">
				</div>
			</div>

			<div class="row">
				<div class="form-group mb-3 col-4">
					<label>Senha de Usuário</label> 
					<input type="password" class="form-control mb-3" placeholder="Digite a Senha">
					<input type="password" class="form-control" placeholder="Repita a Senha">
				</div>
			</div>

			<div class="row">
				<div class="col-1">
					<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
				</div>
			</div>
		</form>
	</div>
	<div class="card-footer"></div>
</div>
<!-- /.card -->
@stop @section('js')
<script> 
    	
$(function () {
    $(".dataTableInit").DataTable({
      "paging": true,
      "lengthChange": true,
      "pageLength": 6,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "language": {"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"}
    });
    
     $('[data-toggle="tooltip"]').tooltip()
    
  }); 
    </script>
@stop
