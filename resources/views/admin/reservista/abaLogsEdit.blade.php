<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Usuário que Cadastrou:</label> 
            <input type="text" name="usuCriou" id="usuCriou" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" value="{{old('usuCriou', \App\Http\Controllers\Utils\UtilsController::getNomeUsuarioById($usuario[0]->usucriou))}}" disabled>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            <label>Dt. Cadastro:</label> 
            <input type="text" name="dtCadastro" id="dtCadastro" class="form-control" placeholder="XX/XX/XXXX" value="{{old('dtCadastro', $carbon::parse($usuario[0]->dtcadastro)->format('d/m/Y h:m:s'))}}" disabled>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Usuário que Editou:</label> 
            <input type="text" name="usueditou" id="usueditou" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" value="{{old('usueditou', \App\Http\Controllers\Utils\UtilsController::getNomeUsuarioById($usuario[0]->usueditou))}}" disabled>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            <label>Dt. Edição:</label> 
            <input type="text" name="dtedicao" id="dtedicao" class="form-control" placeholder="XX/XX/XXXX" value="{{!empty($usuario[0]->dtedicao) ? $carbon::parse($usuario[0]->dtedicao)->format('d/m/Y h:m:s') : ''}}" disabled>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Usuario que Inativou:</label> 
            <input type="text" name="usuexcluiu" id="usuexcluiu" class="form-control" placeholder="XXXXXXXXX XXX XXXXXXXXX XXXXXXXXX" value="{{old('usuexcluiu', \App\Http\Controllers\Utils\UtilsController::getNomeUsuarioById($usuario[0]->usuexcluiu))}}" disabled>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            <label>Dt. Inativação:</label> 
            <input type="text" name="dtexclusao" id="dtexclusao" class="form-control" placeholder="XX/XX/XXXX" value="{{!empty($usuario[0]->dtexclusao) ? $carbon::parse($usuario[0]->dtexclusao)->format('d/m/Y h:m:s') : ''}}" disabled>
        </div>
    </div>
</div>