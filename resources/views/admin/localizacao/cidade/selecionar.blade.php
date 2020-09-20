@inject('carbon', \Carbon\Carbon)

@extends('adminlte::page') 

@section('title', Config::get('label.cidade_selecionar'))


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administração</a></li>
              <li class="breadcrumb-item active">{{Config::get('label.cidade_selecionar')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
@stop 

@section('content')

@include('utils.erro')

<div class="card">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.cidade_selecionar')}}</h3>
	</div>
	
	<div class="card-footer">
		<a href="{{route('cidade.cadastrar')}}" class="btn btn-primary"><i class="far fa-file"></i>&nbsp;&nbsp; {{Config::get('label.btn_novo')}}</a>
	</div>

	<div class="card-body">
		<table id="tableSelecionar" class="table table-bordered table-hover">
			<thead class="">
				<tr>
					{{--<th class="colunaId">{{Config::get('label.id')}}</th>--}}
					<th class="colunaAcao">{{Config::get('label.acoes')}}</th>
					<th class="">{{Config::get('label.nome')}}</th>
					<th class="">{{Config::get('label.cidade_uf')}}</th>
					{{--<th class="">{{Config::get('label.status')}}</th>--}}
					
				</tr>
			</thead>
		</table>
	</div>
	
	<div class="card-footer"></div>
</div>
@stop 

@section('js')
	<script>
		$(function(){
			$("#tableSelecionar").DataTable({
				"processing":true,
				"serverSide": true,
                "ajax": "{{ route('cidades.show') }}",
                "columns": [
					{"data": 'btn'},
					//{"data": 'idcidade'},
					{"data": 'cidnome'},
					{"data": 'ciduf'}
				],
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
		});
	</script>
@stop
