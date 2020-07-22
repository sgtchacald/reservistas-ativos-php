@extends('adminlte::page') 

@section('title', 'Selecionar Reservista')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Módulo de Reservista</h1>
          </div>
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
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Seleção de Reservistas</h3>
	</div>
	
	<div class="card-footer">
		<a href="{{route('reservista.cadastrar')}}" class="btn btn-primary"><i class="far fa-file"></i>&nbsp;&nbsp; Cadastrar Novo Registro</a>
	</div>

	<div class="card-body">
		<table id="selecionarReservista"
			class="dataTableInit table table-bordered table-striped">
			<thead>
				<tr>
					<th>Ações</th>
					<th>Nome</th>
					<th>Posto/Graduação</th>
					<th>Nome de Guerra</th>
					<th>Email</th>
					<th>Criado Em</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Diego Dos Santos</td>
					<td>3º Sargento</td>
					<td>Diego Santos</td>
					<td>sgt.chacal.d@gmail.com</td>
					<td>18/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Alexandre Fragoso</td>
					<td>3º Sargento</td>
					<td>Fragoso</td>
					<td>fox@gmail.com</td>
					<td>19/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Leno da Silva Sauro</td>
					<td>3º Sargento</td>
					<td>Leno</td>
					<td>leno@gmail.com</td>
					<td>18/06/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Jamilton Alves dos Santos</td>
					<td>3º Sargento</td>
					<td>Diego Santos</td>
					<td>sgt.chacal.d@gmail.com</td>
					<td>18/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Mara Cristiane Silveira da Silva</td>
					<td>1º Tenente</td>
					<td>Cristiane Silveira</td>
					<td>cs@gmail.com</td>
					<td>18/03/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Rafael Roberto dos Santos</td>
					<td>Cabo</td>
					<td>Roberto</td>
					<td>rrs@gmail.com</td>
					<td>01/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Nelcinei Valente</td>
					<td>Major</td>
					<td>Valente</td>
					<td>valente@gmail.com</td>
					<td>18/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Jorge da silva sauro</td>
					<td>Cabo</td>
					<td>Jorge</td>
					<td>pnt@gmail.com</td>
					<td>05/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Rodrigo Del Guerso Soares</td>
					<td>Cabo</td>
					<td>Del Guerso</td>
					<td>dguerso@gmail.com</td>
					<td>15/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Anderson Mendes Souza</td>
					<td>Cabo</td>
					<td>Mendes Souza</td>
					<td>ms@gmail.com</td>
					<td>05/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Rodrigo Conceição Lourenço</td>
					<td>Soldado</td>
					<td>Conceição</td>
					<td>curirim@gmail.com</td>
					<td>13/07/2020</td>
				</tr>
				
				<tr>
					<td align="center">
						<span style="fontsize: 25px">
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;
							<a href="" data-toggle="tooltip" data-placement="bottom" title="visualizar Currículo"><i class="far fa-file-pdf"></i></a>
						</span>
					</td>

					<td>Jader da Silva</td>
					<td>Soldado</td>
					<td>Jader</td>
					<td>jader@gmail.com</td>
					<td>18/07/2020</td>
				</tr>
			
			
			</tfoot>
		</table>
	</div>
	<div class="card-footer">
	</div>
</div>
@stop 

@section('js')
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
