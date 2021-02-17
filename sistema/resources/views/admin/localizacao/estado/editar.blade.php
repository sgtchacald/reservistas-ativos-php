@extends('adminlte::page')
@section('title', Config::get('label.estado_editar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.estado_editar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.estado_editar')}}</h3>
	</div>

	<form name="formEditar" id="formEditar" method="post" action="{{route('estado.update')}}">
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
									value="{{old('id', $estado[0]->id)}}" readonly>
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
									value="{{old('nome', $estado[0]->nome)}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_uf')}}:</label>
							<input 	type="text"
									name="uf"
									id="uf"
									class="form-control @error('uf') is-invalid @enderror"
									placeholder="{{Config::get('label.estado_uf_placeholder')}}"
									size="2"
									maxlength="2"
									data-inputmask="'mask': 'a', 'repeat': 5, 'greedy' : false"
									data-mask=""
									onkeyup="this.value = this.value.toUpperCase();"

									value="{{old('uf', $estado[0]->uf)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_id_ibge')}}:</label>
							<input 	type="text"
									name="idIbge"
									id="idIbge"
									class="form-control @error('idIbge') is-invalid @enderror"
									placeholder="{{Config::get('label.estado_id_ibge_placeholder')}}"
									maxlength="5"
									data-inputmask="'mask': '9', 'repeat': 5, 'greedy' : false"
									data-mask=""
									value="{{old('idIbge',$estado[0]->idibge)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_ddd')}}:</label>
							<input 	type="text"
									name="ddd"
									id="ddd"
									class="form-control @error('ddd') is-invalid @enderror"
									placeholder="{{Config::get('label.estado_ddd_placeholder')}}"
									maxlength="50"
									value="{{old('ddd', $estado[0]->ddd)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_pais')}}:</label>
							<select name="idPais" id="idPais" class="form-control @error('idPais') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option>
								@foreach ($paises as $pais)
									<option @if(old('idPais',  $estado[0]->idpais)== $pais->id || $pais->id == 1) {{'selected="selected"'}} @endif value="{{$pais->id}}">
										{{$pais->nomept}}
									</option>
								@endforeach
							</select>

							@error('idPais')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-2">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label>
							<select name="indStatus" id="indStatus" class="form-control @error('indStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option>
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('indStatus', $estado[0]->indstatus)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
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
			if('{{$estado[0]->indstatus}}' == 'I'){
				$("input").attr("disabled", true);
				$("button").attr("disabled", true);
			}

        });
	</script>
@stop
