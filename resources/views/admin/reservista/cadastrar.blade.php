@extends('adminlte::page')
@section('title', 'Cadastrar Reservista')

@section('content_header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Administração</a></li>
				<li class="breadcrumb-item active">Cadastrar Reservista</li>
			</ol>
		</div>
	</div>
</div>
@stop

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Cadastrar Reservista</h3>
	</div>

	<form name="cadastrarUsuarioReservista" id="cadastrarUsuarioReservista" method="post" action="{{route('reservista.insert')}}">
    	<div class="card-body">
    			@csrf

				{{--@include('utils.erro')--}}

                <div class="row">
                	<div class="col-5 col-sm-3">
                		<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                			<a class="nav-link" id="tabs-d-pessoais-tab"  data-toggle="pill" href="#tabs-d-pessoais"  role="tab" aria-controls="tabs-d-pessoais"  aria-selected="false">Dados Pessoais</a>
							<a class="nav-link" id="tabs-d-locgeo-tab" 	  data-toggle="pill" href="#tabs-d-locgeo"    role="tab" aria-controls="tabs-d-locgeo"    aria-selected="false">Localização Geográfica</a>
							<a class="nav-link" id="tabs-d-militares-tab" data-toggle="pill" href="#tabs-d-militares" role="tab" aria-controls="tabs-d-militares" aria-selected="false">Dados Militares</a>
							<a class="nav-link" id="tabs-d-resumo-tab" 	  data-toggle="pill" href="#tabs-d-resumo" 	  role="tab" aria-controls="tabs-d-resumo"    aria-selected="false">Resumo Profissional</a>
							<a class="nav-link" id="tabs-d-idiomas-tab"   data-toggle="pill" href="#tabs-d-idiomas"	  role="tab" aria-controls="tabs-d-idiomas"   aria-selected="false">Idiomas</a>
                			<a class="nav-link" id="tabs-d-social-tab" 	  data-toggle="pill" href="#tabs-d-social" 	  role="tab" aria-controls="tabs-d-social"    aria-selected="false">Redes Sociais</a>
                			<a class="nav-link" id="tabs-d-logs-tab"   	  data-toggle="pill" href="#vert-tabs-logs"   role="tab" aria-controls="vert-tabs-logs"   aria-selected="false">Logs</a>
                		</div>
                	</div>

            		<div class="col-7 col-sm-9">
            			<div class="tab-content" id="vert-tabs-tabContent">
            				<div class="tab-pane fade" id="tabs-d-pessoais" role="tabpanel" aria-labelledby="tabs-d-pessoais-tab">
								@include('admin.reservista.abaDadosPessoaisCad')
							</div>

							<div class="tab-pane fade" id="tabs-d-locgeo" role="tabpanel" aria-labelledby="tabs-d-locgeo-tab">
								@include('admin.reservista.abaLocalizacaoGeograficaCad')
							</div>

							<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								@include('admin.reservista.abaDadosMilitaresCad')
							</div>

							<div class="tab-pane fade" id="tabs-d-resumo" role="tabpanel" aria-labelledby="tabs-d-resumo-tab">
								@include('admin.reservista.abaResumoProfissionalCad')
							</div>

							<div class="tab-pane fade" id="tabs-d-idiomas" role="tabpanel" aria-labelledby="tabs-d-idiomas-tab">
								@include('admin.reservista.abaIdiomasCad')
							</div>

							<div class="tab-pane fade" id="tabs-d-social" role="tabpanel" aria-labelledby="tabs-d-social-tab">
								@include('admin.reservista.abaRedesSociaisCad')
							</div>

							<div class="tab-pane fade" id="vert-tabs-logs" role="tabpanel" aria-labelledby="tabs-d-logs-tab">
								@include('admin.reservista.abaLogsCad')
							</div>

							<!-- exemplo de aba
								<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
								</div>
							-->
					</div>
				</div>
        	</div>

        	<div class="card-footer">
			  <button id="enviarFormReservista" type="submit" class="btn btn-primary">Salvar</button>
			  <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
	</form>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            // validacao de campos
    		$("#cadastrarUsuarioReservista").validate({
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
					//console.log(value);
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
				var oldCidade = "{{session()->get('oldCidade') ?? '0'}}";

					if (oldCidade == "0" && $("#logCep").val() == ""){
						$('select[name=idIbgeCidade]').append('<option value="">Selecione</option>');
					}

					$('select[name=estUf]').change(function () {
                        var uf = $(this).val();
                        var urlCidadesByUf = '{{route("logradouro.getcidadesbyuf", ":uf") }}';
                        urlCidadesByUf = urlCidadesByUf.replace(':uf', uf);

						if(uf!=0){
							$.getJSON(urlCidadesByUf, function (cidades) {
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
                    var oldUrlCidadesByUf = '{{route("logradouro.getcidadesbyuf", ":uf") }}';
                    oldUrlCidadesByUf = oldUrlCidadesByUf.replace(':uf', oldUf);

					if(oldUf!=0){
						$.getJSON(oldUrlCidadesByUf, function (cidades) {
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

			$.getJSON('{{route("idioma.getidiomaorderby")}}').done(
				function( data ) {
					data = $.map(data, function(item) {
						return { id: item.ididioma, text: item.idnome };
					});

					$("#idIdioma").select2({
						placeholder: 'Selecione',
						data: data,
						language: {
							noResults: function () {
								return 'Nenhum Resultado foi encontrado.';
							},
						},
					});
				}
			);

			$("#idNivelIdioma").select2({
				placeholder: 'Selecione',
				language: {
					noResults: function () {
						return 'Nenhum Resultado foi encontrado.';
					},
				},
			});

			/*
			* Iniciando as configurações do crud para a lista de idiomas selecionados
			*/


			if($("#jsonIdiomas").val() == ""){
                localStorage.clear();
            }

			//"A"=Adicionar; "E"=Editar
			var operation = "A";

			//Index of the selected list item
			var selected_index = -1;

			//Retrieve the stored data
			var tbIdiomasUsuarios = localStorage.getItem("idiomasUsuarios");

			//Convertendo string em objeto json
			tbIdiomasUsuarios = JSON.parse(tbIdiomasUsuarios);

			if(tbIdiomasUsuarios == null){
				tbIdiomasUsuarios = [];
			}

			validarConteudoListaIdiomasSelecionados();
            listar();

			function adicionar(){
				var idiomaUsuario = JSON.stringify({
					//ididiomausuario : $("#idIdiomaUsuario").val(),
					ididioma 		: $.trim($("#idIdioma").val()),
					nomeTxtIdioma	: $.trim($("#idIdioma option:selected").text()),
					idnivelidioma 	: $.trim($("#idNivelIdioma").val()),
					txtNivelIdioma	: $.trim($("#idNivelIdioma option:selected").text()),
				});
				tbIdiomasUsuarios.push(idiomaUsuario);
				localStorage.setItem("idiomasUsuarios", JSON.stringify(tbIdiomasUsuarios));
				$('#idIdioma option:selected').prop('disabled', true);
				$('#idIdioma').select2("val", "0");
                $('#idNivelIdioma').select2("val", "0");
                $('#listaIdiomasSelecionados > table').show();
                $('#listaIdiomasSelecionados > p').hide();

				return true;
			}

			function  editar(){
			}

			function  excluir(){
				tbIdiomasUsuarios.splice(selected_index,1);
				localStorage.setItem("idiomasUsuarios", JSON.stringify(tbIdiomasUsuarios));
			}

			function  listar(){
				$('#listaIdiomasSelecionados').append('<ul class="list-group list-group-flush">');
					for(var i in tbIdiomasUsuarios){
						var iu = JSON.parse(tbIdiomasUsuarios[i]);

                        $('#listaIdiomasSelecionados >table >tbody').append(
                            '<tr>'
                                +'<td>'+iu.nomeTxtIdioma+'</td>'
                                +'<td>'+iu.txtNivelIdioma+'</td>'
                                +'<td align="center"><a href="#" alt="excluir'+i+'" title="Excluir Item" class="btnExcluir close">×</a></td>'
                            +'</tr>'
                        );
					}
				$('#listaIdiomasSelecionados').append('</ul>');
			}

			function validarConteudoListaIdiomasSelecionados(){
				if(tbIdiomasUsuarios == null || tbIdiomasUsuarios ==""){
					$("#listaIdiomasSelecionados").append('<p style="color:red; ">Nenhum registro selecionado</p>');
					$('#listaIdiomasSelecionados > table').hide();
				}else{
                    $('#listaIdiomasSelecionados > table > tbody').html('');
				}
			}

			function liberarItemComboIdiomas(){
				for(var i in tbIdiomasUsuarios){
					var iu = JSON.parse(tbIdiomasUsuarios[i]);
					if(i == selected_index){
						$("#idIdioma > option[value='"+iu.ididioma+"']").removeAttr('disabled').removeProp('disabled');
						console.log("Teste para buscar item excluido: "+iu.ididioma);
					}
				}
			}

			$("#adicionarIdioma").click(function(){
				var varIdIdioma = $("#idIdioma").val();
				var varIdNivelIdioma = $("#idNivelIdioma").val();
				if(operation == "A"){
					if(( varIdIdioma == null || varIdIdioma == "")|| ( varIdNivelIdioma == null || varIdNivelIdioma == "")){
						$('.erroIdiomas').append(
							'<div class="alert alert-danger alert-dismissible desaparecer">'
								+ '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
								+ '<i class="icon fas fa-ban"></i>'
								+ '<span>Para adicionar um idioma, preencha os campos abaixo.</span>'
							+'</div>');
					}else{
						adicionar();
						validarConteudoListaIdiomasSelecionados();
						listar();
					}
				}
			});

			$(document).on("click", ".btnExcluir", function(){
				selected_index = parseInt($(this).attr("alt").replace("excluir", ""));
				liberarItemComboIdiomas();
				excluir();
				validarConteudoListaIdiomasSelecionados();
				listar();
			});

            $("#enviarFormReservista").click(function(){
                $("#jsonIdiomas").val(localStorage.getItem("idiomasUsuarios"));
                validarConteudoListaIdiomasSelecionados();
                listar();
                $('#idIdioma').select2("val", "0");
				$('#idNivelIdioma').select2("val", "0");
			});


        });


	</script>

	{{session()->forget('activeTab')}}
	{{session()->forget('oldCidade')}}
@stop
