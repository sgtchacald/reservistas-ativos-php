<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Linked In:</label> 
            <input type="url" name="usuLinkedinUrl" id="usuLinkedinUrl" class="form-control @error('usuLinkedinUrl') is-invalid @enderror addUrl" placeholder="Digite sua URL do perfil do Linked In" value="{{old('usuLinkedinUrl', $usuario[0]->usulinkedinurl)}}">
            
            @error('usuLinkedinUrl')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>	

    <div class="col-sm-6">
        <div class="form-group">
            <label>Facebook:</label> 
            <input type="url" name="usuFacebookUrl" id="usuFacebookUrl" class="form-control addUrl" placeholder="Digite sua URL do perfil do Facebook" value="{{old('usuFacebookUrl', $usuario[0]->usufacebookurl)}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Instagram:</label> 
            <input type="url" name="usuInstagramUrl" id="usuInstagramUrl" class="form-control addUrl" placeholder="Digite sua URL do perfil do Instagram" value="{{old('usuInstagramUrl', $usuario[0]->usuinstagramurl)}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Twitter:</label> 
            <input type="url" name="usuTwitterUrl" id="usuTwitterUrl" class="form-control addUrl" placeholder="Digite sua URL do perfil do Twitter" value="{{old('usuTwitterUrl', $usuario[0]->usutwitterurl)}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Youtube:</label> 
            <input type="url" name="usuYoutubeUrl" id="" class="form-control addUrl" placeholder="Digite sua URL do perfil do Youtube" value="{{old('usuYoutubeUrl', $usuario[0]->usuyoutubeurl)}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Site Pessoal:</label> 
            <input type="url" name="usuBlogSiteUrl" id="usuBlogSiteUrl" class="form-control addUrl" placeholder="Digite sua URL do perfil do seu website" value="{{old('usuBlogSiteUrl', $usuario[0]->usublogsiteurl)}}">
        </div>
    </div>
</div>