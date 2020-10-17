var token = $('#token').val();

$(document).ready(function () {
    getListaEspecilidades();
});


//eventos
$('#listaEspecilidades').change(function () {
    if (this.value == "") {
        $('#listaEspecialistas').empty();
    }
});

$('#buscarAgendamentos').click(function () {
    getAgendamentos($('#listaEspecilidades').val());
});


///Funções

/**
 * Função que retorna a lista de especilidades da api
 */
function getListaEspecilidades() {
    apiFeegowSpecialties = new ApiFeegowSpecialties(token);
    apiFeegowSpecialties.list().then(
        sucesso => {
            sucesso.content.forEach(element => {
                $("#listaEspecilidades").append("<option value='" + element.especialidade_id + "'>" + element.nome + "</option>");
            });
        }, erro => {
            console.log('erro')
        }
    )

}

/**
 * Função que carrega os agendamentos
 *  
 * */
function getAgendamentos(especialidade_id) {
    if (especialidade_id != "") {
        loader(true);
        $('#listaAgendamento tbody').empty();
        apiGatewayService = new ApiGatewayService();
        apiGatewayService.apiRequest('ajax/get.agendamentos.php', { "especialidade_id": especialidade_id }).then(
            sucesso => {
                sucesso.forEach(element => {
                    var row = "<tr><td>" + element.name + '</td><td>' + element.cpf + '</td><td>' + new Date(element.date_time).toLocaleString('pt-BR') + '</td></tr>';
                    $('#listaAgendamento tbody').append(row);
                });
                setTimeout(function(){  loader(false); }, 1000);
                               
            }, erro => {
                loader(false);
            }
        )
    }

}



function bootboxAlert(msg, callbackFunction) {
    bootbox.alert({
        message: msg,
        centerVertical: true,
        callback: function (result) {
            if (callbackFunction) {
                callbackFunction();
            }

        }
    });
}

function loader(exibir = false) {
    if (exibir) {
        $('#loader').modal('show');
    } else {
        $('#loader').modal('hide');
    }

}