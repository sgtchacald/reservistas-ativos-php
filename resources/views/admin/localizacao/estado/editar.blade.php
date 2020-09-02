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
									name="idEstado" 
									id="idEstado" 
									class="form-control @error('idEstado') is-invalid @enderror " 
									placeholder="{{Config::get('label.id_placeholder')}}" 
									maxlength="100"
									value="{{old('idEstado', $estado[0]->idestado)}}" readonly>
						</div>
					</div>
					<div class="col-sm-11"></div>
				</div>
    			
                <div class="row">
					<div class="col-sm-6">
						<div class="form-group required">
							<label>{{Config::get('label.nome')}}:</label> 
							<input 	type="text" 
									name="estNome" 
									id="estNome" 
									class="form-control @error('estNome') is-invalid @enderror" 
									placeholder="{{Config::get('label.nome_placeholder')}}" 
									maxlength="100"
									value="{{old('estNome', $estado[0]->estnome)}}">
						</div>
					</div>

					<div class="col-sm-6"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_uf')}}:</label> 
							<input 	type="text" 
									name="estUf" 
									id="estUf" 
									class="form-control @error('estUf') is-invalid @enderror" 
									placeholder="{{Config::get('label.estado_uf_placeholder')}}" 
									size="2"
									maxlength="2"
									data-inputmask="'mask': 'a', 'repeat': 5, 'greedy' : false" 
									data-mask=""
									onkeyup="this.value = this.value.toUpperCase();"
									
									value="{{old('estUf', $estado[0]->estuf)}}">
						</div>
					</div>
					
					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_id_ibge')}}:</label> 
							<input 	type="text" 
									name="estIdIbge" 
									id="estIdIbge" 
									class="form-control @error('estIdIbge') is-invalid @enderror" 
									placeholder="{{Config::get('label.estado_id_ibge_placeholder')}}" 
									maxlength="5"
									data-inputmask="'mask': '9', 'repeat': 5, 'greedy' : false" 
									data-mask=""
									value="{{old('estIdIbge',$estado[0]->estidibge)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_ddd')}}:</label> 
							<input 	type="text" 
									name="estDdd" 
									id="estDdd" 
									class="form-control @error('estDdd') is-invalid @enderror" 
									placeholder="{{Config::get('label.estado_ddd_placeholder')}}" 
									maxlength="50"
									value="{{old('estDdd', $estado[0]->estddd)}}">
						</div>
					</div>

					<div class="col-sm-9"></div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.estado_pais')}}:</label> 
							<select name="estPais" id="estPais" class="form-control @error('estPais') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ($paises as $pais)
									<option @if(old('estPais',  $estado[0]->estpais)== $pais->idpais || $pais->idpais == 1) {{'selected="selected"'}} @endif value="{{$pais->idpais}}">
										{{$pais->pnomept}}
									</option>
								@endforeach
							</select>
							
							@error('estPais')
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
							<select name="estIndStatus" id="estIndStatus" class="form-control @error('estIndStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('estIndStatus', $estado[0]->estindstatus)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('estIndStatus')
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
			if('{{$estado[0]->estindstatus}}' == 'I'){
				$("input").attr("disabled", true);
				$("button").attr("disabled", true);
			}
			
        });     
	</script>
@stop