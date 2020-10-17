@inject('carbon', \Carbon\Carbon)
@extends('adminlte::page') 
@section('title', 'Editar Reservista')

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">Editar Reservista</li>
			</ol>
		</div>
	</div>
</div>
@stop 

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Editar Reservista</h3>
	</div>
	
	<form name="editarUsuarioReservista" id="editarUsuarioReservista" method="post" action="{{route('reservista.update')}}">
    	<div class="card-body">
    			@csrf
				@method('PUT')
				{{--@include('utils.erro')--}}
                <div class="row">
                	<div class="col-5 col-sm-3">
                		<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                			<a class="nav-link" id="tabs-d-pessoais-tab"  data-toggle="pill" href="#tabs-d-pessoais"  role="tab" aria-controls="tabs-d-pessoais"  aria-selected="false">Dados Pessoais</a>
							<a class="nav-link" id="tabs-d-locgeo-tab" 	  data-toggle="pill" href="#tabs-d-locgeo"    role="tab" aria-controls="tabs-d-locgeo"    aria-selected="false">Localização Geográfica</a> 
							<a class="nav-link" id="tabs-d-militares-tab" data-toggle="pill" href="#tabs-d-militares" role="tab" aria-controls="tabs-d-militares" aria-selected="false">Dados Militares</a> 
							<a class="nav-link" id="tabs-d-resumo-tab"	  data-toggle="pill" href="#tabs-d-resumo" 	  role="tab" aria-controls="tabs-d-resumo"    aria-selected="false">Resumo Profissional</a>
							<a class="nav-link" id="tabs-d-social-tab"	  data-toggle="pill" href="#tabs-d-social" 	  role="tab" aria-controls="tabs-d-social"    aria-selected="false">Redes Sociais</a>
                			<a class="nav-link" id="tabs-d-logs-tab"   	  data-toggle="pill" href="#vert-tabs-logs"   role="tab" aria-controls="vert-tabs-logs"   aria-selected="false">Logs</a>
                		</div>
                	</div>
    
            		<div class="col-7 col-sm-9">
            			<div class="tab-content" id="vert-tabs-tabContent"> 
            				<div class="tab-pane fade" id="tabs-d-pessoais" role="tabpanel" aria-labelledby="tabs-d-pessoais-tab">
								@include('admin.reservista.abaDadosPessoaisEdit') 
							</div>
							
							<div class="tab-pane fade" id="tabs-d-locgeo" role="tabpanel" aria-labelledby="tabs-d-locgeo-tab">
								@include('admin.reservista.abaLocalizacaoGeograficaEdit')
							</div>
            				
							<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								@include('admin.reservista.abaDadosMilitaresEdit')
							</div>

							<div class="tab-pane fade" id="tabs-d-resumo" role="tabpanel" aria-labelledby="tabs-d-resumo-tab">
								@include('admin.reservista.abaResumoProfissionalEdit')
							</div>
            				
							<div class="tab-pane fade" id="tabs-d-social" role="tabpanel" aria-labelledby="tabs-d-social-tab">
								@include('admin.reservista.abaRedesSociaisEdit')
							</div>
            				
							<div class="tab-pane fade" id="vert-tabs-logs" role="tabpanel" aria-labelledby="tabs-d-logs-tab">
								@include('admin.reservista.abaLogsEdit')
							</div>

							<!-- exemplo de aba 
								<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								</div>
							-->
            			</div>
            		</div>
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
			$( "#logCep" ).removeAttr("readonly");
			$( ".logIndStatus" ).addClass("ocultar");

            // validacao de campos
    		$("#editarUsuarioReservista").validate({
    			rules: {
                    usuCPF: { cpfBR: true },
                    email: {email: true },
    			},
    			messages: {
					//colocar as mensagens aqui
    			},
				
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

			arrayObjetos = [];

			$("#vert-tabs-tab").find('a').each(function(){
				var id = $(this).attr("id");
				arrayObjetos.push(id);
			});

			var tabActive = {{session()->get('activeTab') ?? '0'}};

			$(arrayObjetos).each(function (key, value) {
				if (key == tabActive){
					console.log(value);
					idTabActive = value;
				}
			});

			$("#"+idTabActive).addClass("active" );
			$("#"+idTabActive.substring(0, idTabActive.length-4)).addClass("show active");

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
	
	{{session()->forget('activeTab')}}
	{{session()->forget('oldCidade')}}
@stop