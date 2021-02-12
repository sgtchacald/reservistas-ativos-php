<div class="row ocultar">
    <div class="col-sm-1">
        <div class="form-group required">
            <label>{{Config::get('label.id')}}:</label>
            <input 	type="text"
                    name="idLogradouro"
                    id="idLogradouro"
                    class="form-control @error('idLogradouro') is-invalid @enderror"
                    placeholder="{{Config::get('label.id_placeholder')}}"
                    maxlength="100"
                    value="{{old('idLogradouro')}}">
        </div>
    </div>

    <div class="col-sm-1">
        <div class="form-group required">
            <label>{{Config::get('label.logradouro_origem_registro')}}:</label>
            <input 	type="text"
                    name="logIndOrigemCad"
                    id="logIndOrigemCad"
                    class="form-control @error('logIndOrigemCad') is-invalid @enderror"
                    placeholder="{{Config::get('label.logradouro_origem_registro_placeholder')}}"
                    maxlength="1"
                    value="{{old('logIndOrigemCad')}}">
        </div>
    </div>

    <div class="col-sm-10"></div>
</div>

<div class="row">
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
                    value="{{old('logCep')}}">
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
            <select name="logTipo" id="logTipo" class="form-control @error('logTipo') is-invalid @enderror readyOnly" readonly >
                <option value="">Selecione</option>
                @foreach ((\App\Dominios\TipoLogradouro::getDominio()) as $key => $value)
                    <option @if(old('logTipo')==$key) {{'selected="selected"'}} @endif value="{{$key}}">
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
                    value="{{old('logNome')}}"
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
                    value="{{old('logNr')}}">
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
                    value="{{old('logComplemento')}}">

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
                    <option @if(old('estUf')== $estado->uf) {{'selected="selected"'}} @endif value="{{$estado->uf}}">
                        {{$estado->nome}}
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
                    value="{{old('logNomeBairro')}}"
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
                    <option @if(old('logIndStatus')==$key || $key == 'A') {{'selected="selected"'}} @endif value="{{$key}}">
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
