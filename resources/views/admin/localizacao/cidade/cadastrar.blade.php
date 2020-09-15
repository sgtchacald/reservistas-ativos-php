@extends('adminlte::page') 
@section('title', Config::get('label.cidade_cadastrar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.cidade_cadastrar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.cidade_cadastrar')}}</h3>
	</div>
	
	<form name="formCadastrar" id="formCadastrar" method="post" action="{{route('cidade.insert')}}">
    	<div class="card-body">
    			@csrf
				@include('utils.erro')

				<div class="row ocultar">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label> 
							<input 	type="text" 
									name="idCidade" 
									id="idCidade" 
									class="form-control @error('idCidade') is-invalid @enderror" 
									placeholder="{{Config::get('label.id_placeholder')}}" 
									maxlength="100"
									value="{{old('idCidade')}}">
						</div>
					</div>

					<div class="col-sm-10"></div>
				</div>

    			
                <div class="row">
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.nome')}}:</label> 
							<input 	type="text" 
									name="cidNome" 
									id="cidNome" 
									class="form-control @error('cidNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.nome_placeholder')}}" 
									maxlength="100"
									value="{{old('cidNome')}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_uf')}}:</label> 
							<select name="cidUf" id="cidUf" class="form-control @error('cidUf') is-invalid @enderror">
								<option value="">Selecione</option> 
								@foreach ($estados as $estado)
									<option @if(old('cidUf')== $estado->estuf) {{'selected="selected"'}} @endif value="{{$estado->estuf}}">
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
							<label>{{Config::get('label.cidade_id_ibge')}}:</label> 
							<input 	type="text" 
									name="cidIdIbge" 
									id="cidIdIbge" 
									class="form-control @error('cidIdIbge') is-invalid @enderror" 
									placeholder="{{Config::get('label.cidade_id_ibge_placeholder')}}" 
									maxlength="5"
									data-inputmask="'mask': '9', 'repeat': 5, 'greedy' : false" 
									data-mask=""
									value="{{old('cidIdIbge')}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_ddd')}}:</label> 
							<input 	type="text" 
									name="cidDdd" 
									id="cidDdd" 
									class="form-control @error('cidDdd') is-invalid @enderror" 
									placeholder="{{Config::get('label.cidade_ddd_placeholder')}}" 
									maxlength="2"
									data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false" 
									data-mask=""
									value="{{old('cidDdd')}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label> 
							<select name="cidIndStatus" id="cidIndStatus" class="form-control @error('cidIndStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('cidIndStatus')==$key || $key == 'A') {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('cidIndStatus')
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
        });     
	</script>
@stop
