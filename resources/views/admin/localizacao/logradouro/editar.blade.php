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

			@include('admin.localizacao.logradouro.logradouroCamposFormEdit')        	
			
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