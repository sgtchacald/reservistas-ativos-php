@section('js')
	<script>
        $(document).ready(function(){
            function cargaComboCidade(idUf, idCidade){
                alert("teste");
                $("select[#"+ idUf + "]").change(function () {
                    var uf = $(this).val();

                    if(uf!=0){
                        $.getJSON('/admin/localizacao/logradouro/getcidadesbyuf/' + uf, function (cidades) {
                            $("select[#"+ idCidade + "]").empty();
                            $("select[#"+ idCidade + "]").append('<option value="">Selecione</option>');
                            $("select[#"+ idCidade + "]").removeAttr('disabled');
                            
                            //console.log(cidades);
                            $.each(cidades, function (key, value) {
                                $("select[#"+ idCidade + "]").append('<option value=' + value.cididibge + '>' + value.cidnome + '</option>');
                            });

                        });
                    }else{
                        $("select[#"+ idCidade + "]").attr('disabled', 'disabled');
                    }
			    });
            }
    });
	</script>
@stop