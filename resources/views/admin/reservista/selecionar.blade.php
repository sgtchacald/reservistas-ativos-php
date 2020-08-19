@inject('carbon', \Carbon\Carbon)

@extends('adminlte::page') 

@section('title', 'Selecionar Reservista')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administração</a></li>
              <li class="breadcrumb-item active">Selecionar Reservista</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
@stop 

@section('content')

@include('utils.erro')

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Seleção de Reservistas</h3>
	</div>
	
	<div class="card-footer">
		<a href="{{route('reservista.cadastrar')}}" class="btn btn-primary"><i class="far fa-file"></i>&nbsp;&nbsp; Cadastrar Novo Registro</a>
	</div>

	<div class="card-body">
		<table id="selecionarReservista"  class="dataTableInit table table-bordered table-hover">
			<thead>
				<tr>
					<th>Ações</th>
					<th>Força</th>
					<th>Graduação</th>
					<th>Nome de Guerra</th>
					<th>Batalhão</th>
					<th>E-mail</th>
					<th>Celular</th>
					<th>Cadastro</th>
				</tr>
			</thead>
			<tbody>
				@foreach($usuarios as $usuario)
       				<tr>
    					<td>
							<table>
								<tr align="center">
									<a href="{{route('reservista.editar', $usuario->idusuario)}}" data-toggle="tooltip" data-placement="bottom" title="Editar" style="margin-right: 10%"><i class="fas fa-edit"></i></a>
									
									<form action="{{route('reservista.excluir', $usuario->idusuario)}}" method="POST">
										@csrf
										@method('PUT')
										<input id="usuPermissao" type="hidden" name="usuPermissao" value="R">
										<button type="submit" class="retiraEstilos" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></button>
									</form>
									
								</tr>
							</table>	
    					</td>
    						
    					<td>{{(\App\Dominios\TipoForca::getDominio())[$usuario->usutipoforca]}}</td>
    					<td>{{(\App\Dominios\PostoGraduacao::getDominio())[$usuario->usupostograd]}}</td>
    					<td>{{$usuario->usunomeguerra}}</td>
    					<td>{{$usuario->usunomeultbtl}}</td>
    					<td>{{$usuario->email}}</td>
						<td>{{$usuario->usutelcelular}}</td>
						<td>{{$carbon::parse($usuario->dtcadastro)->format('d/m/Y')}}</td>
    				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	
	<div class="card-footer"></div>
</div>
@stop 

@section('js')
<script> 
    	
$(function () {
    $(".dataTableInit").DataTable({
      "paging": true,
      "lengthChange": true,
      "pageLength": 5,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {"url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"}
    });
    
     $('[data-toggle="tooltip"]').tooltip()
    
  }); 
    </script>
@stop
