<div class="row">
    <div class="col-sm-3 form-group required">
        <label>Força de Origem:</label> 
        <select name="usuTipoForca" id="usuTipoForca" class="form-control @error('usuTipoForca') is-invalid @enderror">
            <option value="">Selecione</option> 
            @foreach ((\App\Dominios\TipoForca::getDominio()) as $key => $value)
                <option @if(old('usuTipoForca', $usuario[0]->usutipoforca)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
                    {{$value}}
                </option>
            @endforeach
        </select>
        
        @error('usuTipoForca')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <div class="col-sm-2">
        <div class="form-group required">
            <label>Sou Oficial?</label>
            <div class="form-check @error('usuIndOficial') is-invalid @enderror" style="padding-top: 6px;">
                @foreach ((\App\Dominios\SimNao::getDominio()) as $key => $value)
                    <input type="radio" name="usuIndOficial" id="usuIndOficial" class="form-check-input" style="" value="{{$key}}" {{old('usuIndOficial', $usuario[0]->usuindoficial) == $key ? 'checked' : ''}}>
                    {{$value}}&nbsp;&nbsp; &nbsp;&nbsp;                         							
                @endforeach
            </div>
            
            @error('usuIndOficial')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <label>Certificado de Reservista:</label> 
            <input type="text" name="usuCertReservista" id="usuCertReservista" class="form-control @error('usuCertReservista') is-invalid @enderror" placeholder="Digite o Número do Certificado" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" data-mask="" value="{{old('usuCertReservista', $usuario[0]->usucertreservista)}}">
            
            @error('usuCertReservista')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group required">
            <label>Post/Grad:</label> 
            <select name="usuPostoGrad" id="usuPostoGrad" class="form-control @error('usuPostoGrad') is-invalid @enderror" >
                <option value="">Selecione</option> 
                @foreach ((\App\Dominios\PostoGraduacao::getDominio()) as $key => $value)
                    <option @if(old('usuPostoGrad', $usuario[0]->usupostograd)==$key) {{'selected="selected"'}} @endif value="{{$key}}">
                        {{$value}}
                    </option>
                @endforeach
            </select>
            
            @error('usuPostoGrad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-7">
        <div class="form-group required">
            <label>Nome de Guerra:</label> 
            <input type="text" name="usuNomeGuerra" id="usuNomeGuerra" class="form-control @error('usuNomeGuerra') is-invalid @enderror" placeholder="Digite o nome de guerra" value="{{old('usuNomeGuerra', $usuario[0]->usunomeguerra)}}">
            
            @error('usuNomeGuerra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-9">
        <div class="form-group required">
            <label>Última Organização Militar que serviu:</label> 
            <input type="text" name="usuNomeUltBtl" id="usuNomeUltBtl" class="form-control @error('usuNomeUltBtl') is-invalid @enderror" placeholder="Digite o nome do último batalhão que serviu" value="{{old('usuNomeUltBtl', $usuario[0]->usunomeultbtl)}}">
            
            @error('usuNomeUltBtl')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>