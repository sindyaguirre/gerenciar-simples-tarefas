$(function () {
    /*fonte https://www.todoespacoonline.com/w/2014/09/tablesorter-jquery/*/
    // Parser para configurar a data para o formato do Brasil
    $.tablesorter.addParser({
        id: 'datetime',
        is: function (s) {
            return false;
        },
        format: function (s, table) {
            s = s.replace(/\-/g, "/");
            s = s.replace(/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/, "$3/$2/$1");
            return $.tablesorter.formatFloat(new Date(s).getTime());
        },
        type: 'numeric'
    });

    $('.tablesorter.tabelaTarefa').tablesorter({
        // Envia os cabeçalhos 
        headers: {
            5: {
                // Desativa a ordenação para essa coluna 
                sorter: false
            },
            6: {
                // Desativa a ordenação para essa coluna 
                sorter: false
            }
        }
    });

    $("#abrirCadastro").click(function () {
//        $("#cadastro").diplay(true);
//        $("#cadastro").css("display", "none");
        
    });
});
