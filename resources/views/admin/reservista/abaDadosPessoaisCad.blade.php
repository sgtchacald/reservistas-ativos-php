<div class="row">
    <div class="col-sm-3 form-group required">
        <label>Perfil de Usuário:</label>
        <select class="form-control" disabled>
            <option>Selecione</option> 
            @foreach((\App\Dominios\PermissoesUsuario::getDominio()) as $key => $value)
            <option value="{{$key}}" @if($key == 'R') selected @endif>{{$value}}</option> 
            @endforeach
        </select>
        <input type="hidden" name="usuPermissao" id="usuPermissao" value="R">
    </div>
    
    <div class="col-sm-3">
        <div class="form-group required">
            <label>CPF:</label> 
            <input type="text" name="usuCPF" id="usuCPF" class="form-control @error('usuCPF') is-invalid @enderror" data-inputmask="'mask': ['999.999.999-99']" data-mask="" value="{{old('usuCPF')}}">
            
            @error('usuCPF')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group required" >
            <label>Nome Completo:</label> 
            <input type="text"  name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Digite seu nome" value="{{old('name')}}">
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group required">
            <label>Dt Nascimento:</label>
            <input 	type="date" 
                    name="usuDtNascimento" 
                    id="usuDtNascimento" 
                    class="form-control @error('usuDtNascimento') is-invalid @enderror" 
                    value="{{old('usuDtNascimento')}}">
                
            @error('usuDtNascimento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group required">
            <label>Estado Civil:</label> 
            <select name="usuEstadoCivil" id="usuEstadoCivil" class="form-control @error('usuEstadoCivil') is-invalid @enderror">
                <option value="">Selecione</option> 
                @foreach ((\App\Dominios\EstadoCivil::getDominio()) as $key => $value)
                    <option @if(old('usuEstadoCivil')==$key) {{'selected="selected"'}} @endif value="{{ $key  }}">
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            
            @error('usuEstadoCivil')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group required">
            <label>Gênero:</label> 
            <select name="usuGenero" id="usuGenero" class="form-control @error('usuGenero') is-invalid @enderror">
                <option value="">Selecione</option> 
                @foreach ((\App\Dominios\Sexo::getDominio()) as $key => $value)
                    <option @if(old('usuGenero')==$key) {{'selected="selected"'}} @endif value="{{ $key  }}">
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            
            @error('usuGenero')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group required">
            <label>Port. Deficiência?</label> 
            <select name="usuIndPortDeficiente" id="usuIndPortDeficiente" class="form-control @error('usuIndPortDeficiente') is-invalid @enderror">
                <option value="">Selecione</option> 
                @foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                    <option @if(old('usuIndPortDeficiente')==$key) {{'selected="selected"'}} @endif value="{{ $key  }}">
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            
            @error('usuIndPortDeficiente')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label>E-mail:</label> 
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Digite seu e-mail" value="{{old('email')}}">
            
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            <label>Tel. Fixo:</label> 
            <input type="text" name="usuTelFixo" id="usuTelFixo" class="form-control @error('usuTelFixo') is-invalid @enderror" placeholder="" data-inputmask="'mask': ['99 9999-9999']" data-mask="" value="{{old('usuTelFixo')}}">
            
            @error('usuTelFixo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group required">
            <label>Tel. Celular:</label> 
            <input type="text" name="usuTelCelular" id="usuTelCelular" class="form-control @error('usuTelCelular') is-invalid @enderror" placeholder="" data-inputmask="'mask': ['99 9 9999-9999']" data-mask="" value="{{old('usuTelCelular')}}">

            @error('usuTelCelular')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-sm-4">
        <div class="form-group required">
            <label>Disponível para viajar?</label>
            <div class="form-check @error('usuIndViagem') is-invalid @enderror">
                @foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                    <input type="radio" name="usuIndViagem" id="usuIndViagem" class="form-check-input" style="" value="{{$key}}" {{old('usuIndViagem') == $key ? 'checked' : ''}}>
                    {{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                @endforeach
            </div>
            
            @error('usuIndViagem')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-5">
        <div class="form-group required">
            <label>Disponível para mudar de cidade?</label>
            <div class="form-check @error('usuIndMudarCidade') is-invalid @enderror">
                @foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                    <input type="radio" name="usuIndMudarCidade" id="usuIndMudarCidade" class="form-check-input @error('usuIndMudarCidade') is-invalid @enderror" style="" value="{{$key}}" {{old('usuIndMudarCidade') == $key ? 'checked' : ''}}>
                    {{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                @endforeach
            </div>
            
            @error('usuIndMudarCidade')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group clearfix">
            <div class="icheck-danger d-inline">
                <input type="checkbox" name="usuIndCelWhatsapp" id="checkboxDanger3" class="initCheckboxSN" value="S" {{old('usuIndCelWhatsapp') == 'S' ? 'checked' : ''}}> 
                <label for="checkboxDanger3">É meu whatsapp?</label><br>
                <input type="checkbox" name="usuIndMsg" id="checkboxDanger3" class="initCheckboxSN" value="S" {{old('usuIndMsg') == 'S' ? 'checked' : ''}}> 
                <label for="checkboxDanger3" style="color:#FF0000;">Receber MSG(s)?</label>
            </div>
        </div>
    </div>
</div>

<div class="row">                    				
</div>