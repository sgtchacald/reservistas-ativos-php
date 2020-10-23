<div class="row">
    <div class="col-sm-12">
        <div class="form-group required">
            <label>Idiomas:</label> 
            <p></p>
            <select class="select2bs4" multiple="multiple">
                <option>Português</option>
                <option>Espanhol</option>
                <option>Italiano</option>
                <option>Japonês</option>
                <option>Polonês</option>
                <option>Francês</option>
                <option>Inglês</option>
            </select>           
            
            @error('usuResumo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>	
</div>