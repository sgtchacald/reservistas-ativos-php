@extends('adminlte::page') 
@section('title', Config::get('label.nivel_estudo_editar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.nivel_estudo_editar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.nivel_estudo_editar')}}</h3>
	</div>
	
	<form name="formEditar" id="formEditar" method="post" action="{{route('nivel.estudo.update')}}">
    	<div class="card-body">
				@csrf
				@method('PUT')
				@include('utils.erro')

				<div class="row">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label> 
							<input 	type="text" 
									name="idNivelEstudo" 
									id="idNivelEstudo" 
									class="form-control @error('idNivelEstudo') is-invalid @enderror " 
									placeholder="{{Config::get('label.id_placeholder')}}" 
									maxlength="100"
									value="{{old('idNivelEstudo', $nivelEstudo[0]->idnivelestudo)}}" readonly>
						</div>
					</div>

					<div class="col-sm-11"></div>
				</div>

    			
                <div class="row">
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.nome')}}:</label> 
							<input 	type="text" 
									name="nieNome" 
									id="nieNome" 
									class="form-control @error('nieNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.nome_placeholder')}}" 
									maxlength="100"
									value="{{old('nieNome', $nivelEstudo[0]->nienome)}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-2">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label> 
							<select name="nieIndStatus" id="nieIndStatus" class="form-control @error('nieIndStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('nieIndStatus', $nivelEstudo[0]->nieindstatus)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('usuPostoGrad')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<br><br><br><br><br>
				</div>
        	
        	<div class="card-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
	</form>		
@stop 

@section('js')
    <script> 
        $(document).ready(function(){
            // validacao de campos
    		$("#cadastrarUsuarioReservista").validate({
    			rules: {},
    			messages: {},
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

			//Validação do form caso status do registro seja INATIVO
			if('{{$nivelEstudo[0]->nieindstatus}}' == 'I'){
				$("input").attr("disabled", true);
				$("button").attr("disabled", true);
			}
			
        });     
	</script>
@stop
