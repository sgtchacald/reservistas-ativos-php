<div class="erroIdiomas">
</div>

<div class="row">
</div>

<div class="row">
    <div class="col-sm-1 idIdiomaUsuario ocultar">
        <div class="form-group required">
            <label>Id:</label>
            <input type="text" name="idIdiomaUsuario" id="idIdiomaUsuario" class="form-control" title="Id do idioma vinculado ao usuário" readonly>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group required">
            <label>Idioma:</label>
            <select name="idIdioma" id="idIdioma">
                <option value="">Selecione</option>
                @if (is_array(old('idIdioma')))
                    @foreach (old('idIdioma') as $tag)
                        <option value="{{ $tag }}" selected="selected">{{ $idiomaController->getIdiomaById($tag)[0]->idnome }}</option>
                    @endforeach
                @endif
            </select>
            @error('idIdioma')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group required">
            <label>Nível Idioma:</label>
            <select name="idNivelIdioma" id="idNivelIdioma" class="form-control @error('idNivelIdioma') is-invalid @enderror">
                <option value="">Selecione</option>
                @foreach ((\App\Dominios\NivelIdioma::getDominio()) as $key => $value)
                    <option @if(old('idNivelIdioma')==$key) {{'selected="selected"'}} @endif value="{{ trim($key) }}">
                        {{ trim($value) }}
                    </option>
                @endforeach
            </select>

             @error('idNivelIdioma')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label class="botao">Adicionar Botão:</label><br>
            <button type="button" id="adicionarIdioma" class="btn btn-primary" title="Adicionar">
                <i class="fas fa-plus-circle"></i>
                &nbsp;
                Adicionar
            </button>
        </div>
    </div>
</div>


<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Idiomas Selecionados</h1>
    </div>

    <div class="card-body">
        <div class="col-sm-9">
            <div id="listaIdiomasSelecionados">
                <table  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50%">Idioma</th>
                            <th style="width: 45%">Nível</th>
                            <th style="width: 5%">Exc</th>
                        </tr>
                    </thead>
                    <tbody class="tbListaIdiomasSelecionados">
                    </tbody>
                </table>
            </div>
        </div>
        <input name="jsonIdiomas" id="jsonIdiomas" type="hidden" value="{{ old('jsonIdiomas', '') }}">
    </div>
</div>


