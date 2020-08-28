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
              <li class="breadcrumb-item active">{{Config::get('label.nivel_estudo_selecionar')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
@stop 

@section('content')

@include('utils.erro')

<div class="card">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.nivel_estudo_selecionar')}}</h3>
	</div>
	
	<div class="card-footer">
		<a href="{{route('nivel.estudo.cadastrar')}}" class="btn btn-primary"><i class="far fa-file"></i>&nbsp;&nbsp; {{Config::get('label.btn_novo')}}</a>
	</div>

	<div class="card-body">
		<table id="selecionarReservista"  class="dataTableInit table table-bordered table-hover">
			<thead>
				<tr>
					<th class="colunaAcao">{{Config::get('label.acoes')}}</th>
					<th class="colunaId">{{Config::get('label.id')}}</th>
					<th class="">{{Config::get('label.nome')}}</th>
					<th class="colunaStatus">{{Config::get('label.status')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($niveisEstudo as $nivelEstudo)
       				<tr>
    					<td>
							<table>
								<tr align="center">
									<a href="{{route('nivel.estudo.editar', $nivelEstudo->idnivelestudo)}}" data-toggle="tooltip" data-placement="bottom" title="Editar" style="margin-right: 10%"><i class="fas fa-edit"></i></a>
									
									<form class="excluirRegistro" action="{{route('nivel.estudo.excluir', $nivelEstudo->idnivelestudo)}}" method="POST">
										@csrf
										@method('PUT')
										<button type="submit" class="retiraEstilos" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></button>
									</form>
									
								</tr>
							</table>	
    					</td>
    						
    					<td>{{$nivelEstudo->idnivelestudo}}</td>
						<td>{{$nivelEstudo->nienome}}</td>
						<td>{{(\App\Dominios\IndStatus::getDominio())[$nivelEstudo->nieindstatus]}}</td>
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
		$(function(){}); 
	</script>
@stop
