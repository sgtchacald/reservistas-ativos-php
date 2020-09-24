@extends('adminlte::page') 
@section('title', Config::get('label.logradouro_cadastrar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.logradouro_cadastrar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.logradouro_cadastrar')}}</h3>
	</div>
	
	<form name="formCadastrar" id="formCadastrar" method="post" action="{{route('logradouro.insert')}}">
    	<div class="card-body">
    			@csrf
				{{--@include('utils.erro')--}}

				<div class="row ocultar">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label> 
							<input 	type="text" 
									name="idLogradouro" 
									id="idLogradouro" 
									class="form-control @error('idLogradouro') is-invalid @enderror" 
									placeholder="{{Config::get('label.id_placeholder')}}" 
									maxlength="100"
									value="{{old('idLogradouro')}}">
						</div>
					</div>

					<div class="col-sm-10"></div>
				</div>

    			
                <div class="row">
					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_cep')}}:</label> 
							<input 	type="text" 
									name="logCep" 
									id="logCep" 
									class="form-control @error('logCep') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_cep_placeholder')}}" 
									maxlength="8"
									data-inputmask="'mask': '9', 'repeat': 8, 'greedy' : false" 
									data-mask=""
									value="{{old('logCep')}}">
							@error('logCep')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
					</div>
						
					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_tipo')}}</label> 
							<select name="logTipo" id="logTipo" class="form-control @error('logTipo') is-invalid @enderror" >
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\TipoLogradouro::getDominio()) as $key => $value)
									<option @if(old('logTipo')==$key) {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('logTipo')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
                </div>

				<div class="row">
					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_nome')}}:</label> 
							<input 	type="text" 
									name="logNome" 
									id="logNome" 
									class="form-control @error('logNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_nome_placeholder')}}" 
									maxlength="100"
									value="{{old('logNome')}}">
							@error('logNome')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_nome_sem_numero')}}:</label> 
							<input 	type="text" 
									name="logNomeSemNr" 
									id="logNomeSemNr" 
									class="form-control @error('logNomeSemNr') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_nome_sem_numero_placeholder')}}" 
									maxlength="100"
									value="{{old('logNomeSemNr')}}">

							@error('logNomeSemNr')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_complemento')}}:</label> 
							<input 	type="text" 
									name="logComplemento" 
									id="logComplemento" 
									class="form-control @error('logNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_complemento_placeholder')}}" 
									maxlength="100"
									value="{{old('logNome')}}">

							@error('logComplemento')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_uf')}}:</label> 
							<select name="estUf" id="estUf" class="form-control @error('estUf') is-invalid @enderror">
								<option value="">Selecione</option> 
								@foreach ($estados as $estado)
									<option @if(old('estUf')== $estado->estuf) {{'selected="selected"'}} @endif value="{{$estado->estuf}}">
										{{$estado->estnome}}
									</option>
								@endforeach
							</select>
							
							@error('estUf')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_cidade')}}:</label> 
							<select name="idCidade" id="idCidade" class="form-control @error('idCidade') is-invalid @enderror">
								<option value="">Selecione</option>
								<option>{{ old('idCidade') }}</option> 
							</select>
							
							@error('idCidade')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_bairro')}}:</label> 
							<input 	type="text" 
									name="logNomeBairro" 
									id="logNomeBairro" 
									class="form-control @error('logNomeBairro') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_bairro_placeholder')}}" 
									maxlength="100"
									value="{{old('logNomeBairro')}}">
							@error('logNomeBairro')
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
			  <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
	</form>		
@stop 

@section('js')
    <script> 
        $(document).ready(function(){
			$('select[name=idCidade]').attr('disabled', 'disabled');
			$('select[name=estUf]').change(function () {
				var uf = $(this).val();
				
				$.getJSON('/admin/localizacao/logradouro/getcidadesbyuf/' + uf, function (cidades) {
					$('select[name=idCidade]').empty();
					$('select[name=idCidade]').append('<option>Selecione</option>');
					$('select[name=idCidade]').removeAttr('disabled');
					
					//console.log(cidades);
					$.each(cidades, function (key, value) {
						$('select[name=idCidade]').append('<option value=' + value.idcidade + '>' + value.cidnome + '</option>');
					});
				});
        	});

        });     
	</script>
@stop
