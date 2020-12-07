$(document).ready(function(){

    function buscaIdiomasSelecionados(){
        if(sessionStorage.getItem('idiomasSelecionados')){
            $(".zeroRegistros").hide();
            let idiomasSelecionados = [];
            idiomasSelecionados = JSON.parse(sessionStorage.getItem('idiomasSelecionados'));
            idiomasSelecionados.forEach(idiomasSelecionados => {
                $('.listaIdiomasSelecionados').append(`
                    <p>${idiomasSelecionados.usuIdioma} -  ${idiomasSelecionados.usuNivelIdioma}</p>
                `);
            });
        }else{
        }
    }

    $("#adicionarIdioma").click(function(){
        let usuIdioma = $("#usuIdioma").val();
        let usuNivelIdioma = $("#usuNivelIdioma").val();
        let idiomaSelecionado = {
            'usuIdioma': usuIdioma,
            'usuNivelIdioma': usuNivelIdioma
        }


        if((usuIdioma == null || usuIdioma == "")|| (usuNivelIdioma == null || usuNivelIdioma == "")){
            $('.erroIdiomas').append(
                '<div class="alert alert-warning alert-dismissible desaparecer">'
                    + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    + '<i class="icon fas fa-ban"></i>'
                    + '<span>Para adicionar um idioma, preencha os campos abaixo.</span>'
                +'</div>');
        }else{
            $(".zeroRegistros").hide();
            
            let idiomasSelecionados = [];
            
            if(sessionStorage.getItem('idiomasSelecionados')){
                idiomasSelecionados = JSON.parse(sessionStorage.getItem('idiomasSelecionados'));
            }
            
            idiomasSelecionados.push(idiomaSelecionado);
            
            sessionStorage.setItem('idiomasSelecionados', JSON.stringify(idiomasSelecionados));
            
            let url = '{{route("idioma.getidiomabyid", ":idioma") }}';
            
            url = url.replace(':idioma', idiomaSelecionado.usuIdioma);

            $.getJSON(url, function (idioma) {	
                $.each(idioma, function (key, value) {
                    sessionStorage.setItem('varIdiomaSelecionado', value.idnome);
                });
            });

            setTimeout(function(){
                $('.listaIdiomasSelecionados').append(
                    '<span class="badge badge-primary" style="display: inline-block;vertical-align: middle;line-height: normal;">'
                    +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    + sessionStorage.getItem('varIdiomaSelecionado')
                    +'&nbsp;&nbsp;&nbsp;'
                    +'</span>'
                    +'&nbsp;&nbsp;&nbsp;'
                );
            }, 200);

            sessionStorage.removeItem('varIdiomaSelecionado');
        }

        $('#usuIdioma').select2("val", "0");
        $('#usuNivelIdioma').select2("val", "0");
    });

});