<div class="row">
    <div class="col-sm-12">
        <div class="form-group required">
            <label>Resumo:</label> 
            <textarea 
                name="usuResumo" 
                id="textarea" 
                class="form-control @error('usuResumo') is-invalid @enderror tamanhoMaxlenght" 
                placeholder="Descreva de forma resumida suas habilidades, interesses profissionais e o que deseja para seu futuro profissional" 
                rows="10"
                maxlength="1024">{{old('usuResumo')}}</textarea>
            
            @error('usuResumo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span id="chars">1024</span> caracteres restantes.
        </div>
    </div>	
</div>