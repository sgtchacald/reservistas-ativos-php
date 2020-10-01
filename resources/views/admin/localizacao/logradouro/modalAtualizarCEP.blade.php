<!-- Modal -->
<div class="modal fade" id="modaAtualizarCep" tabindex="-1" role="dialog" aria-labelledby="atualizarCepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="atualizarCepModalLabel">Atualize o CEP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="align-content: center">
          <!-- Elemento ID que receberá o embed ViaCEP -->
		  <div id="viacep-embed"></div>
        </div>
      </div>
    </div>
  </div>

@section('js')
	<script>    
		//atribui elemento com ID "viacep-embed" no documento.
		var elemento_pai = document.getElementById("viacep-embed");
		//cria um novo elemento "iframe".
		var iframe = document.createElement('iframe');
		//insere o novo elemento "iframe" como filho do elemento "viacep-embed".
		elemento_pai.appendChild(iframe);
		//define atributos do "iframe".
		iframe.setAttribute('src', 'https://viacep.com.br/embed/');
		iframe.setAttribute('id', 'viacep-iframe');
		iframe.setAttribute('scrolling', 'no');
		iframe.style.width = '310px';
		iframe.style.height = '190px';       
		iframe.style.border = '1px dotted #888';
		iframe.style.background = '#fcfcfc';
	</script>
@stop