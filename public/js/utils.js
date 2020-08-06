$(document).ready(function(){
    /**
     * Ativação de plugins jquery globalmente
     */

    //ativando máscaras de entrada 
    $('[data-mask]').inputmask();

    //ativando campos data 
    $('.initData').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        showDropdowns: true,
        showWeekNumbers: false,
        locale: {
            format: 'DD/MM/YYYY',
            daysOfWeek: ["Dom","Seg","Ter","Qua","Qui","Sex","Sab"],
            monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
            firstDay: 0
        },
    }, function(chosen_date) {
        $('.initData').val(chosen_date.format('DD/MM/YYYY'));
    });
});     