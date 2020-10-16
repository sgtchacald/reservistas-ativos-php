@inject('carbon', \Carbon\Carbon)
@extends('adminlte::page') 
@section('title', 'Editar Reservista')

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">Editar Reservista</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Editar Reservista</h3>
	</div>
	
	<form name="editarUsuarioReservista" id="editarUsuarioReservista" method="post" action="{{route('reservista.update')}}">
    	<div class="card-body">
    			@csrf
				@method('PUT')
				{{--@include('utils.erro')--}}
                <div class="row">
                	<div class="col-5 col-sm-3">
                		<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                			<a class="nav-link" id="tabs-d-pessoais-tab"  data-toggle="pill" href="#tabs-d-pessoais"  role="tab" aria-controls="tabs-d-pessoais"  aria-selected="false">Dados Pessoais</a>
							<a class="nav-link" id="tabs-d-locgeo-tab" 	  data-toggle="pill" href="#tabs-d-locgeo"    role="tab" aria-controls="tabs-d-locgeo"    aria-selected="false">Localização Geográfica</a> 
							<a class="nav-link" id="tabs-d-militares-tab" data-toggle="pill" href="#tabs-d-militares" role="tab" aria-controls="tabs-d-militares" aria-selected="false">Dados Militares</a> 
							<a class="nav-link" id="tabs-d-resumo-tab"	  data-toggle="pill" href="#tabs-d-resumo" 	  role="tab" aria-controls="tabs-d-resumo"    aria-selected="false">Resumo Profissional</a>
							<a class="nav-link" id="tabs-d-social-tab"	  data-toggle="pill" href="#tabs-d-social" 	  role="tab" aria-controls="tabs-d-social"    aria-selected="false">Redes Sociais</a>
                			<a class="nav-link" id="tabs-d-logs-tab"   	  data-toggle="pill" href="#vert-tabs-logs"   role="tab" aria-controls="vert-tabs-logs"   aria-selected="false">Logs</a>
                		</div>
                	</div>
    
            		<div class="col-7 col-sm-9">
            			<div class="tab-content" id="vert-tabs-tabContent"> 
            				<div class="tab-pane fade" id="tabs-d-pessoais" role="tabpanel" aria-labelledby="tabs-d-pessoais-tab">
								@include('admin.reservista.abaDadosPessoaisEdit') 
							</div>
							
							<div class="tab-pane fade" id="tabs-d-locgeo" role="tabpanel" aria-labelledby="tabs-d-locgeo-tab">
								@include('admin.reservista.abaLocalizacaoGeograficaEdit')
							</div>
            				
							<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								@include('admin.reservista.abaDadosMilitaresEdit')
							</div>

							<div class="tab-pane fade" id="tabs-d-resumo" role="tabpanel" aria-labelledby="tabs-d-resumo-tab">
								@include('admin.reservista.abaResumoProfissionalEdit')
							</div>
            				
							<div class="tab-pane fade" id="tabs-d-social" role="tabpanel" aria-labelledby="tabs-d-social-tab">
								@include('admin.reservista.abaRedesSociaisEdit')
							</div>
            				
							<div class="tab-pane fade" id="vert-tabs-logs" role="tabpanel" aria-labelledby="tabs-d-logs-tab">
								@include('admin.reservista.abaLogsEdit')
							</div>

							<!-- exemplo de aba 
								<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								</div>
							-->
            			</div>
            		</div>
        	</div>
        	<div class="card-footer">
			  <button type="submit" class="btn btn-primary">Salvar</button>
			  <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
	</form>		
@stop 

@section('js')
    <script> 
        $(document).ready(function(){
            // validacao de campos
    		$("#editarUsuarioReservista").validate({
    			rules: {
                    usuCPF: { cpfBR: true },
                    email: {email: true },
    			},
    			messages: {
					//colocar as mensagens aqui
    			},
				
				errorElement: 'span',
                errorPlacement: function (error, element) {
                  error.addClass('invalid-feedback');
                  element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                  $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                  $(element).removeClass('is-invalid');
                }
			});

			arrayObjetos = [];

			$("#vert-tabs-tab").find('a').each(function(){
				var id = $(this).attr("id");
				arrayObjetos.push(id);
			});

			var tabActive = {{session()->get('activeTab') ?? '0'}};

			$(arrayObjetos).each(function (key, value) {
				if (key == tabActive){
					console.log(value);
					idTabActive = value;
				}
			});

			$("#"+idTabActive).addClass("active" );
			$("#"+idTabActive.substring(0, idTabActive.length-4)).addClass("show active");
        });     
	</script>
	
	{{session()->forget('activeTab')}}
@stop