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
    			
    			@include('utils.erro')
    			
                <div class="row">
                	<div class="col-5 col-sm-3">
                		<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                			<a class="nav-link active"  id="tabs-d-pessoais-tab"  data-toggle="pill" href="#tabs-d-pessoais"  role="tab" aria-controls="tabs-d-pessoais"  aria-selected="false">Dados Pessoais</a>
                			<a class="nav-link" 		id="tabs-d-militares-tab" data-toggle="pill" href="#tabs-d-militares" role="tab" aria-controls="tabs-d-militares" aria-selected="false">Dados Militares</a> 
                			<a class="nav-link" 		id="tabs-d-social-tab" 	  data-toggle="pill" href="#tabs-d-social" 	  role="tab" aria-controls="tabs-d-social"    aria-selected="false">Redes Sociais</a>
                			<a class="nav-link" 		id="vert-tabs-logs-tab"   data-toggle="pill" href="#vert-tabs-logs"   role="tab" aria-controls="vert-tabs-logs"   aria-selected="false">Logs</a>
                		</div>
                	</div>
    
            		<div class="col-7 col-sm-9">
            			<div class="tab-content" id="vert-tabs-tabContent"> 
            				<div class="tab-pane fade active show" id="tabs-d-pessoais" role="tabpanel" aria-labelledby="tabs-d-pessoais-tab">
            					<div class="row">
            						<div class="col-sm-3 form-group">
                        				<label>Perfil de Usuário:</label>
                        				<select name="usuPermissao" id="usuPermissao" class="form-control" disabled>
                        					<option value="">Selecione</option> 
                        					@foreach((\App\Dominios\PermissoesUsuario::getDominio()) as $key => $value)
                        					<option value="{{$key}}" @if($key == 'R') selected @endif>{{$value}}</option> 
                        					@endforeach
                        				</select>
                        			</div>
                        			
                    				<div class="col-sm-9">
                    					<div class="form-group">
                        					<label>Nome Completo:</label> 
										<input type="text"  name="name" id="name" class="form-control" placeholder="Digite seu nome" value="{{old('name')}}">
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-3">
                    					<div class="form-group">
                        					<label>CPF:</label> 
                        					<input type="text" name="usuCPF" id="usuCPF" class="form-control" data-inputmask="'mask': ['999.999.999-99']" data-mask="" value="{{old('usuCPF')}}">
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-3">
                    					<div class="form-group">
                        					<label>Dt Nascimento:</label>
                                            <div class="input-group date reservationdate" id="reservationdate" data-target-input="nearest">
                                                <input type="text" name="usuDtNascimento" id="usuDtNascimento" class="form-control initData" data-inputmask-alias="datetime"  data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="false" value="{{old('usuDtNascimento')}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
														<i class="fa fa-calendar"></i>
													</div>
                                           		</div>
                                            </div>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-2">
                    					<div class="form-group">
                        					<label>Estado Civil:</label> 
                                			<select name="usuEstadoCivil" id="usuEstadoCivil" class="form-control">
                            					<option value="">Selecione</option> 
                            					@foreach ((\App\Dominios\EstadoCivil::getDominio()) as $key => $value)
                            						<option value="{{$key}}">{{$value}}</option> 
                            					@endforeach
                                			</select>
                            			</div>
                    				</div>
                    				
                    				<div class="col-sm-2">
                    					<div class="form-group">
                    						<label>Gênero:</label> 
                                			<select name="usuGenero" id="usuGenero" class="form-control">
                            					<option value="">Selecione</option> 
                            					@foreach ((\App\Dominios\Sexo::getDominio()) as $key => $value)
                            						<option value="{{$key}}">{{$value}}</option> 
                            					@endforeach
                                			</select>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-2">
                    					<div class="form-group">
                    						<label>Port. Deficiência?</label> 
                                			<select name="usuIndPortDeficiente" id="usuIndPortDeficiente" class="form-control">
                            					<option value="">Selecione</option> 
                            					@foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                            						<option value="{{$key}}">{{$value}}</option> 
                            					@endforeach
                                			</select>
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-8">
                    					<div class="form-group">
                        					<label>E-mail:</label> 
                        					<input type="text" name="email" id="email" class="form-control" placeholder="Digite seu e-mail">
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-2">
										<div class="form-group">
											<label>Telefone Celular:</label> 
											<input type="text" name="usuTelCelular" id="usuTelCelular" class="form-control" placeholder="" data-inputmask="'mask': ['99 9 9999-9999']" data-mask="">
										</div>
                    				</div>
                    				
                    				<div class="col-sm-2">
                    					<div class="form-group">
                        					<label>Telefone Fixo:</label> 
                        					<input type="text" name="usuTelFixo" id="usuTelFixo" class="form-control" placeholder="" data-inputmask="'mask': ['99 9999-9999']" data-mask="">
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-3">
                    					<div class="form-group">
                    						<label>Disponível para viajar?</label>
                    						<div class="form-check">
                    							@foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                        							<input type="radio" name="usuIndViagem" id="usuIndViagem" class="form-check-input" style="" value="{{$key}}">
                        							{{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                    							@endforeach
                    						</div>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-4">
                    					<div class="form-group">
                    						<label>Disponível para mudar de cidade?</label>
                    						<div class="form-check">
                    							@foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                        							<input type="radio" name="usuIndMudarCidade" id="usuIndMudarCidade" class="form-check-input" style="" value="{{$key}}">
                        							{{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                    							@endforeach
                    						</div>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-1"></div>
                    				
                    				<div class="col-sm-4">
                        				<div class="form-group clearfix">
    										<div class="icheck-danger d-inline">
    											<input type="checkbox" name="usuIndCelWhatsapp" id="checkboxDanger3" class="initCheckboxSN" value="S"> 
    											<label for="checkboxDanger3">Este celular é meu whatsapp.</label><br>
    											<input type="checkbox" name="usuIndMsg" id="checkboxDanger3" class="initCheckboxSN" value="S"> 
    											<label for="checkboxDanger3" style="color:#FF0000;">Desejo receber msgs neste cel.</label>
    										</div>
    									</div>
    								</div>
    
        							<!--  <div class="col-sm-12">
        								<div class="form-group">
        									<label for="exampleInputFile">Inserir Foto</label>
        									<div class="input-group">
        										<div class="custom-file">
        											<input type="file" name="foto" id="foto" class="custom-file-input" id="exampleInputFile"> 
        												<label class="custom-file-label" for="exampleInputFile">Procurar</label>
        										</div>
        										
        										<div class="input-group-append">
        											<span class="input-group-text" id="">Upload</span>
        										</div>
        									</div>
        								</div>
        							</div>-->
    						</div>
            				</div>
            				
            				<div class="tab-pane fade" id="tabs-d-militares" role="tabpanel" aria-labelledby="tabs-d-militares-tab">
            					<div class="row">
                        			<div class="col-sm-3 form-group">
                        				<label>Força de Origem:</label> 
                            			<select name="usuTipoForca" id="usuTipoForca" class="form-control">
                        					<option value="">Selecione</option> 
                        					@foreach ((\App\Dominios\TipoForca::getDominio()) as $key => $value)
                        						<option value="{{$key}}">{{$value}}</option> 
                        					@endforeach
                            			</select>
                        			</div>
                        			
                        			<div class="col-sm-2">
                    					<div class="form-group">
                    						<label>Sou Oficial?</label>
                    						<div class="form-check" style="padding-top: 6px;">
                    							@foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                        							<input type="radio" name="usuIndOficial" id="usuIndOficial" class="form-check-input" style="" value="{{$key}}">
                        							{{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                    							@endforeach
                    						</div>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-4">
                    					<div class="form-group">
                    						<label>Certificado de Reservista:</label> 
                    						<input type="text" name="usuCertReservista" id="usuCertReservista" class="form-control" placeholder="Digite o Número do Certificado">
                    					</div>
                    				</div>
                				</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-2">
                    					<div class="form-group">
                        					<label>Post/Grad:</label> 
                                			<select name="usuPostoGrad" id="usuPostoGrad" class="form-control">
                            					<option value="">Selecione</option> 
                            					@foreach ((\App\Dominios\PostoGraduacao::getDominio()) as $key => $value)
                            						<option value="{{$key}}">{{$value}}</option> 
                            					@endforeach
                                			</select>
                            			</div>
                    				</div>
                    				
                    				<div class="col-sm-7">
                    					<div class="form-group">
                        					<label>Nome de Guerra:</label> 
                        					<input type="text" name="usuNomeGuerra" id="usuNomeGuerra" class="form-control" placeholder="Digite o nome de guerra">
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-9">
                    					<div class="form-group">
                        					<label>Ultimo batalhão que serviu:</label> 
                        					<input type="text" name="usuNomeUltBtl" id="usuNomeUltBtl" class="form-control" placeholder="Digite o nome do último batalhão que serviu">
                    					</div>
                    				</div>
                    			</div>
            				</div>
            				
            				<div class="tab-pane fade" id="tabs-d-social" role="tabpanel" aria-labelledby="tabs-d-social-tab">
            			
        						<div class="row">
            						<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Linked In:</label> 
                        					<input type="text" name="usuLinkedinUrl" id="usuLinkedinUrl" class="form-control" placeholder="Digite sua URL do perfil do Linked In">
                    					</div>
                    				</div>	
                    			
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Facebook:</label> 
                        					<input type="text" name="usuFacebookUrl" id="usuFacebookUrl" class="form-control" placeholder="Digite sua URL do perfil do Facebook">
                    					</div>
                    				</div>
                				</div>
                				
                				<div class="row">
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Instagram:</label> 
                        					<input type="text" name="usuInstagramUrl" id="usuInstagramUrl" class="form-control" placeholder="Digite sua URL do perfil do Instagram">
                    					</div>
                    				</div>
                    			
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Twitter:</label> 
                        					<input type="text" name="usuTwitterUrl" id="usuTwitterUrl" class="form-control" placeholder="Digite sua URL do perfil do Twitter">
                    					</div>
                    				</div>
                				</div>
                				
                				<div class="row">
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Youtube:</label> 
                        					<input type="text" name="usuYoutubeUrl" id="usuYoutubeUrl" class="form-control" placeholder="Digite sua URL do perfil do Youtube">
                    					</div>
                    				</div>

                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Site Pessoal:</label> 
                        					<input type="text" name="usuBlogSiteUrl" id="usuBlogSiteUrl" class="form-control" placeholder="Digite sua URL do perfil do seu website">
                    					</div>
                    				</div>
                    			</div>
            				</div>
            				
            				<div class="tab-pane fade" id="vert-tabs-logs" role="tabpanel" aria-labelledby="vert-tabs-logs-tab">
            					<div class="row">
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Usuário que Cadastrou:</label> 
                        					<input type="text" name="usuCriou" id="usuCriou" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" disabled>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-3">
                    					<div class="form-group">
                        					<label>Dt. Cadastro:</label> 
                        					<input type="text" name="dtCadastro" id="dtCadastro" class="form-control" placeholder="XX/XX/XXXX" disabled>
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Usuário que Editou:</label> 
                        					<input type="text" name="usueditou" id="usueditou" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" disabled>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-3">
                    					<div class="form-group">
                        					<label>Dt. Edição:</label> 
                        					<input type="text" name="dtedicao" id="dtedicao" class="form-control" placeholder="XX/XX/XXXX" disabled>
                    					</div>
                    				</div>
                    			</div>
                    			
                    			<div class="row">
                    				<div class="col-sm-6">
                    					<div class="form-group">
                        					<label>Usuario que Inativou:</label> 
                        					<input type="text" name="usuexcluiu" id="usuexcluiu" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" disabled>
                    					</div>
                    				</div>
                    				
                    				<div class="col-sm-3">
                    					<div class="form-group">
                        					<label>Dt. Inativação:</label> 
                        					<input type="text" name="dtexclusao" id="dtexclusao" class="form-control" placeholder="XX/XX/XXXX" disabled>
                    					</div>
                    				</div>
                    			</div>
            				</div>
            			</div>
            		</div>
        	</div>
        	
        	<div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
    				usuPermissao: "required",
    				name: "required",
                    usuCPF: { required:	true, cpfBR: true },
                    usuDtNascimento: { required: true, dateITA:	true},
                    usuEstadoCivil:	"required",
                    usuGenero: "required",
                    usuIndPortDeficiente: "required",
                    email: {required: true, email: true },
					usuTelCelular: "required",
                    usuTelFixo: "required",
                    usuIndViagem: "required",
                    usuIndMudarCidade:"required",
                    usuImagemUrl: "required",
                    usuTipoForca: "required",
                    usuIndOficial: "required",
                    usuCertReservista: "required",
                    usuPostoGrad: "required",
                    usuNomeGuerra: "required",
                    usuNomeUltBtl: "required",
                    usuLinkedinUrl: "required",
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
        });     
    </script>
@stop
