function controlarAbaAtiva(idDivPrincipal){
    $(document).ready(function(){
        arrayObjetos = [];

        $("#vert-tabs-tab").find('a').each(function(){
            var id = $(this).attr("id");
            arrayObjetos.push(id);
        });

        var tabActive = {{session()->get('activeTab') ?? '0'}};

        $(arrayObjetos).each(function (key, value) {
            if (key == tabActive){
                console.log(value);
                idTabActive = value;
            }
        });

        $("#"+idTabActive).addClass("active" );
        $("#"+idTabActive.substring(0, idTabActive.length-4)).addClass("show active");
        }); 
}

{{session()->forget('activeTab')}}
