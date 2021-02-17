@extends('adminlte::page')
@section('title', Config::get('label.cidade_editar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.cidade_editar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.cidade_editar')}}</h3>
	</div>

	<form name="formEditar" id="formEditar" method="post" action="{{route('cidade.update')}}">
    	<div class="card-body">
				@csrf
				@method('PUT')
				@include('utils.erro')

				<div class="row">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label>
							<input 	type="text"
									name="id"
									id="id"
									class="form-control @error('id') is-invalid @enderror "
									placeholder="{{Config::get('label.id_placeholder')}}"
									maxlength="100"
									value="{{old('id', $cidade[0]->id)}}" readonly>
						</div>
					</div>
					<div class="col-sm-11"></div>
				</div>

                <div class="row">
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.nome')}}:</label>
							<input 	type="text"
									name="nome"
									id="nome"
									class="form-control @error('nome') is-invalid @enderror"
									placeholder="{{Config::get('label.nome_placeholder')}}"
									maxlength="100"
									value="{{old('nome', $cidade[0]->nome)}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_uf')}}:</label>
							<select name="uf" id="uf" class="form-control @error('uf') is-invalid @enderror">
								<option value="">Selecione</option>
								@foreach ($estados as $estado)
									<option @if(old('uf',  $cidade[0]->uf) == $estado->uf) {{'selected="selected"'}} @endif value="{{$estado->uf}}">
										{{$estado->nome}}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_id_ibge')}}:</label>
							<input 	type="text"
									name="idIbge"
									id="idIbge"
									class="form-control @error('idIbge') is-invalid @enderror"
									placeholder="{{Config::get('label.cidade_id_ibge_placeholder')}}"
									maxlength="9"
									data-inputmask="'mask': '9', 'repeat': 9, 'greedy' : false"
									data-mask=""
									value="{{old('idIbge',$cidade[0]->idibge)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.cidade_ddd')}}:</label>
							<input 	type="text"
									name="ddd"
									id="ddd"
									class="form-control @error('ddd') is-invalid @enderror"
									placeholder="{{Config::get('label.cidade_ddd_placeholder')}}"
									maxlength="50"
									value="{{old('ddd', $cidade[0]->ddd)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-2">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label>
							<select name="indStatus" id="indStatus" class="form-control @error('indStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option>
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('indStatus', $cidade[0]->indstatus)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
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
			//Validação do form caso status do registro seja INATIVO
			if('{{$cidade[0]->indstatus}}' == 'I'){
				$("input").attr("disabled", true);
				$("button").attr("disabled", true);
			}

        });
	</script>
@stop
