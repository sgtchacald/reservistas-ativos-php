@extends('adminlte::page')
@section('title', Config::get('label.pais_cadastrar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.pais_cadastrar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.pais_cadastrar')}}</h3>
	</div>

	<form name="formCadastrar" id="formCadastrar" method="post" action="{{route('pais.insert')}}">
    	<div class="card-body">
    			@csrf
				@include('utils.erro')

				<div class="row ocultar">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label>
							<input 	type="text"
									name="id"
									id="id"
									class="form-control @error('id') is-invalid @enderror"
									placeholder="{{Config::get('label.id_placeholder')}}"
									maxlength="100"
									value="{{old('id')}}">
						</div>
					</div>

					<div class="col-sm-10"></div>
				</div>


                <div class="row">
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.pais_nome_global')}}:</label>
							<input 	type="text"
									name="nome"
									id="nome"
									class="form-control @error('nome') is-invalid @enderror"
									placeholder="{{Config::get('label.pais_nome_global_placeholder')}}"
									maxlength="100"
									value="{{old('nome')}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.pais_nome_nacional')}}:</label>
							<input 	type="text"
									name="nomePt"
									id="nomePt"
									class="form-control @error('nomePt') is-invalid @enderror"
									placeholder="{{Config::get('label.pais_nome_nacional_placeholder')}}"
									maxlength="100"
									value="{{old('nomePt')}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.pais_sigla')}}:</label>
							<input 	type="text"
									name="sigla"
									id="sigla"
									class="form-control @error('sigla') is-invalid @enderror"
									placeholder="{{Config::get('label.pais_sigla_placeholder')}}"
									size="2"
									maxlength="2"
									value="{{old('sigla')}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.pais_bacen')}}:</label>
							<input 	type="number"
									name="bacen"
									id="bacen"
									class="form-control @error('bacen') is-invalid @enderror"
									placeholder="{{Config::get('label.pais_bacen_placeholder')}}"
									maxlength="5"
									value="{{old('bacen')}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label>
							<select name="indStatus" id="indStatus" class="form-control @error('indStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option>
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('indStatus')==$key || $key == 'A') {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>

							@error('indStatus')
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
