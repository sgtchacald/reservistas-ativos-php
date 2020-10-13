@extends('adminlte::page') 
@section('title', Config::get('label.logradouro_editar'))

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">{{Config::get('label.logradouro_editar')}}</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{Config::get('label.logradouro_editar')}}</h3>
	</div>
	
	<form name="formEditar" id="formEditar" method="post" action="{{route('logradouro.update')}}">
    	<div class="card-body">
				@csrf
				@method('PUT')
				{{--@include('utils.erro')--}}
				
				<div class="row ocultar">
					<div class="col-sm-12">
						<div class="alert alert-warning alert-dismissible desaparecer" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							
							<b><i class="icon fas fa-exclamation-triangle"></i> DICA IMPORTANTE: </b>
							Digite o <b>CEP</b> e logo após pressione <b>TAB</b> ou preencha normalmente os campos <b>[NÚMERO] e [COMPLEMENTO]</b>. <br>
							Todos os demais campos serão preenchidos automaticamente.
							
							@include('admin.localizacao.logradouro.modalAtualizarCEP')
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-1">
						<div class="form-group required">
							<label>{{Config::get('label.id')}}:</label> 
							<input 	type="text" 
									name="idLogradouro" 
									id="idLogradouro" 
									class="form-control @error('idLogradouro') is-invalid @enderror" 
									placeholder="{{Config::get('label.id_placeholder')}}" 
									maxlength="100"
									value="{{old('idLogradouro', $logradouro[0]->idlogradouro)}}" readonly>
						</div>
					</div>

					<div class="col-sm-1 ocultar">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_origem_registro')}}:</label> 
							<input 	type="text" 
									name="logIndOrigemCad" 
									id="logIndOrigemCad" 
									class="form-control @error('logIndOrigemCad') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_origem_registro_placeholder')}}" 
									maxlength="1"
									value="{{old('logIndOrigemCad', $logradouro[0]->logindorigemcad)}}">
						</div>
					</div>

					<div class="col-sm-10"></div>
				</div>
    			
                <div class="row">
					<div class="col-sm-2">
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
									value="{{old('logCep', $logradouro[0]->logcep)}}"
									readonly>
							@error('logCep')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>					
               	</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_tipo')}}</label> 
							<select name="logTipo" id="logTipo" class="form-control @error('logTipo') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\TipoLogradouro::getDominio()) as $key => $value)
									<option @if(old('logTipo', $logTipo)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('logTipo')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_nome')}}:</label> 
							<input 	type="text" 
									name="logNome" 
									id="logNome" 
									class="form-control @error('logNome') is-invalid @enderror readyOnly" 
									placeholder="{{Config::get('label.logradouro_nome_placeholder')}}" 
									maxlength="100"
									value="{{old('logNome', $logNome)}}"
									readonly>
							@error('logNome')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_nr')}}:</label> 
							<input 	type="text" 
									name="logNr" 
									id="logNr" 
									class="form-control @error('logNr') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_nr_placeholder')}}" 
									maxlength="10"
									data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" 
									data-mask=""
									value="{{old('logNr', $logNumero)}}">
							@error('logNr')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label>{{Config::get('label.logradouro_complemento')}}:</label> 
							<input 	type="text" 
									name="logComplemento" 
									id="logComplemento" 
									class="form-control @error('logComplemento') is-invalid @enderror" 
									placeholder="{{Config::get('label.logradouro_complemento_placeholder')}}" 
									maxlength="100"
									value="{{old('logComplemento', $logradouro[0]->logcomplemento)}}">

							@error('logComplemento')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_uf')}}:</label> 
							<select name="estUf" id="estUf" class="form-control @error('estUf') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ($estados as $estado)
									<option @if(old('estUf', $logradouro[0]->ciduf)== $estado->estuf) {{'selected="selected"'}} @endif value="{{$estado->estuf}}">
										{{$estado->estnome}}
									</option>
								@endforeach
							</select>
							
							@error('estUf')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-4">

							<div class="form-group required">
								<label>{{Config::get('label.logradouro_cidade')}}:</label> 
								<select name="idIbgeCidade" id="idIbgeCidade" class="form-control @error('idIbgeCidade') is-invalid @enderror readyOnly" readonly>
									{{--<option value="">Selecione</option>--}}
								</select>
								
								@error('idIbgeCidade')
									<span class="invalid-feedback desaparecer" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror

								<div class="loading">
									<strong>Carregando...</strong>
									<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
								</div>
							</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group required">
							<label>{{Config::get('label.logradouro_bairro')}}:</label> 
							<input 	type="text" 
									name="logNomeBairro" 
									id="logNomeBairro" 
									class="form-control @error('logNomeBairro') is-invalid @enderror readyOnly" 
									placeholder="{{Config::get('label.logradouro_bairro_placeholder')}}" 
									maxlength="100"
									value="{{old('logNomeBairro', $logradouro[0]->lognomebairro)}}"
									readonly >
							@error('logNomeBairro')
								<span class="invalid-feedback desaparecer" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group required">
							<label>{{Config::get('label.status')}}:</label> 
							<select name="logIndStatus" id="logIndStatus" class="form-control @error('logIndStatus') is-invalid @enderror readyOnly" readonly>
								<option value="">Selecione</option> 
								@foreach ((\App\Dominios\IndStatus::getDominio()) as $key => $value)
									<option @if(old('logIndStatus', $logradouro[0]->logindstatus)==$key || $key == 'A') {{'selected="selected"'}} @endif value="{{$key}}">
										{{$value}}
									</option>
								@endforeach
							</select>
							
							@error('logIndStatus')
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
			$('.loading').hide();

			atualizaCep();

			gerenciaCombosLogradouro();

			fazIntegracaoViaCepPreencheCamposLogradouro();

			function gerenciaCombosLogradouro(){
				$('select[name=idIbgeCidade]').append('<option value="{{$logradouro[0]->idibgecidade}}">{{$logradouro[0]->lognomecid}}</option>');
				$('#idIbgeCidade').fadeIn();
				$('.loading').hide();

				var oldCidade = "{{session()->get('oldCidade') ?? '0'}}";

					if (oldCidade == "0" && $("#logCep").val() == ""){
						$('select[name=idIbgeCidade]').append('<option value="">Selecione</option>');
					}

					$('select[name=estUf]').change(function () {
						var uf = $(this).val();

						if(uf!=0){
							$.getJSON('/admin/localizacao/logradouro/getcidadesbyuf/' + uf, function (cidades) {
								$('select[name=idIbgeCidade]').empty();
								$('select[name=idIbgeCidade]').html("");
								$('select[name=idIbgeCidade]').append('<option value="">Selecione</option>');
								//$('select[name=idIbgeCidade]').removeAttr('disabled');
								
								$.each(cidades, function (key, value) {
									$('select[name=idIbgeCidade]').append('<option value=' + value.cididibge + '>' + value.cidnome + '</option>');
								});
								getValorCidadeIbge();
								$('#idIbgeCidade').fadeIn();
								$('.loading').hide();
							});
						}else{
							$('select[name=idIbgeCidade]').attr('readyonly', true);
						}
					});

					oldCidade = "{{session()->get('oldCidade') ?? '0'}}";
					var oldUf = "{{old('estUf') ?? '0'}}";	

					if(oldUf!=0){
						$.getJSON('/admin/localizacao/logradouro/getcidadesbyuf/' + oldUf, function (cidades) {
							$('select[name=idIbgeCidade]').empty();
							$('select[name=idIbgeCidade]').html("");
							$('select[name=idIbgeCidade]').append('<option value="">Selecione</option>');
							//$('select[name=idIbgeCidade]').removeAttr('disabled');
							
							$.each(cidades, function (key, value) {
								$('select[name=idIbgeCidade]').append('<option value=' + value.cididibge + '>' + value.cidnome + '</option>');
							});

							$('select[name=idIbgeCidade]').val(oldCidade).change();
							
							if(oldCidade == 0){
								var opt = $('select[name=idIbgeCidade] option').filter(function(el) { 
									return $(this).text().trim() === "Selecione"; 
								});
								opt.attr('selected', true);
							}  
						});
					}else{
						$('#idIbgeCidade option:first').attr('selected','selected');
					}
			}



			function limpaFormCep() {
				// Limpa valores do formulário de cep.
				$("#logCep").val("");
				$("#logNome").val("");
				$("#logNomeBairro").val("");
				$("#estUf").val("");
				$("#idIbgeCidade").val("");
				$("#logTipo").val("");
			}

			function loading() {				
				$("#logNome").val("...");
				$("#logNomeBairro").val("...");
				$("#estUf").val("...");
				$("#idIbgeCidade").val("...");
				$("#logTipo").val("...");
			}

			function fazIntegracaoViaCepPreencheCamposLogradouro(){
				return new Promise((resolve, reject) =>{
					//Quando o campo cep perde o foco.
					$("#logCep").blur(function() {
						//Nova variável "cep" somente com dígitos.
						var cep = $(this).val().replace(/\D/g, '');
						//Verifica se campo cep possui valor informado.
						if (cep != "") {
							//Expressão regular para validar o CEP.
							var validacep = /^[0-9]{8}$/;
							//Valida o formato do CEP.
							if(validacep.test(cep)) {
								//Consulta o webservice viacep.com.br/
								$('#idIbgeCidade').hide();
								$('.loading').show();
								$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
									if (!("erro" in dados)) {
										var logTipo = (dados.logradouro).split(' ')[0];
										
										if(logTipo!=""){
											var optLogTipo = $('#logTipo option').filter(function(el) { 
												return $(this).text().trim() === logTipo; 
											});
											optLogTipo.attr('selected', true);
										}

										$("#logNome").val(dados.logradouro);
										$("#logNomeBairro").val(dados.bairro);
										$('#estUf').val(dados.uf).trigger('change');		
										$("#logIndOrigemCad").val("W");
										setValorCidadeIbge(dados.ibge);
									
									}else {
										limpaFormCep();
										$('#modaAtualizarCep').modal('show');
									}
								});
							}else {
								limpaFormCep();
								alert("Formato de CEP inválido.");
							}
						}else {	
							limpaFormCep();		
							$('select[name=idIbgeCidade]').empty();
							$('select[name=idIbgeCidade]').html("");
							$('select[name=idIbgeCidade]').append('<option value="">Selecione</option>');
						}
					});
				});
			}				

			function setValorCidadeIbge(dados){
				setTimeout(() =>{
					$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

					$.ajax({
						method:'POST',
						url:'{{route("logradouro.setDadosIbge")}}',
						data: {'dadosIbge': dados}
					});
				}, 100);
			}

			function getValorCidadeIbge(){
				setTimeout(() =>{
					$.get( '{{route("logradouro.getdadosibge")}}', function( data ) {
						$("#idIbgeCidade").val(data).trigger('change');
					});
				}, 100);
			}

			function atualizaCep(){
				//atribui elemento com ID "viacep-embed" no documento.
                var elemento_pai = document.getElementById("viacep-embed");
                //cria um novo elemento "iframe".
                var iframe = document.createElement('iframe');
                //insere o novo elemento "iframe" como filho do elemento "viacep-embed".
                elemento_pai.appendChild(iframe);
                //define atributos do "iframe".
                iframe.setAttribute('src', 'https://viacep.com.br/embed/');
                iframe.setAttribute('id', 'viacep-iframe');
                iframe.setAttribute('scrolling', 'no');
                iframe.style.width = '210px';
                iframe.style.height = '190px';       
                iframe.style.border = '1px dotted #888';
                iframe.style.background = '#fcfcfc';
			}

		});
	</script>
	{{session()->forget('oldCidade')}} 	
@stop