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
				@include('utils.erro')

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
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_nome')}}:</label> 
							<input 	type="text" 
									name="logNome" 
									id="logNome" 
									class="form-control @error('logNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_nome_placeholder')}}" 
									maxlength="100"
									value="{{old('logNome')}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_uf')}}:</label> 
							<select name="estados" id="estados" class="form-control @error('estados') is-invalid @enderror">
								<option value="">Selecione</option> 
								@foreach ($estados as $estado)
									<option @if(old('estados')== $estado->estuf) {{'selected="selected"'}} @endif value="{{$estado->estuf}}">
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

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_cidade')}}:</label> 
							<select name="cidade" id="cidade" class="form-control @error('cidade') is-invalid @enderror">
								<option value="">Selecione</option>
								<option>{{ old('cidade') }}</option> 
							</select>
							
							@error('cidade')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-9"></div>
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
			$('select[name=cidade]').attr('disabled', 'disabled');
			$('select[name=estados]').change(function () {
				var uf = $(this).val();
				
				$.getJSON('/admin/localizacao/logradouro/getcidadesbyuf/' + uf, function (cidades) {
					$('select[name=cidade]').empty();
					$('select[name=cidade]').append('<option>Selecione</option>');
					$('select[name=cidade]').removeAttr('disabled');
					
					//console.log(cidades);
					$.each(cidades, function (key, value) {
						$('select[name=cidade]').append('<option value=' + value.idcidade + '>' + value.cidnome + '</option>');
					});
				});
        	});

        });     
	</script>
@stop
