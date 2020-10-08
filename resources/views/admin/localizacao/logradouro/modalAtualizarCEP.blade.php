<!-- Modal -->
<div class="modal fade" id="modaAtualizarCep" tabindex="-1" role="dialog" aria-labelledby="atualizarCepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  align="center">
        <div class="modal-header">
          <h5 class="modal-title" id="atualizarCepModalLabel">
            Atualização de CEP. 
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="align-content: center">
          <!-- Elemento ID que receberá o embed ViaCEP -->
          <div id="mensagemCepNaoAtualizado" align="center">
            <p>
              <strong> Prezado Veterano! </strong> </br>
              Caso seu CEP não exista em nossa base de dados,
              colabore conosco seguindo as instruções abaixo para que nossos dados estejam sempre atualizados.  
            </p>
          </div>

          <div id="viacep-embed" align="center"></div>
        </div>
      </div>
    </div>
  </div>