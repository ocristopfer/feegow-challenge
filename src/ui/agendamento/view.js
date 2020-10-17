var token = $('#token').val();
var id_especilidade = null;
var id_profissional = null;

$(document).ready(function () {
    getListaEspecilidades();
    getListaComoConheceu();

    $('#dtNascimento').datepicker({
        format: 'dd/mm/yyyy',
        language: "pt-BR",
    });

});


//eventos
$('#listaEspecilidades').change(function () {
    if (this.value == "") {
        $('#listaEspecialistas').empty();
    }
});

$('#buscarEspecilistas').click(function () {
    id_especilidade = $('#listaEspecilidades').val();

    if (id_especilidade != '') {
        loader(true);
        $('#listaEspecialistas').empty();
        getListaProssifionais(id_especilidade).then(
            success => {
                $('#totalEspecialistas').text(success.length + ' ' + $('#listaEspecilidades option:selected').html() + ' encontrado(s)');
                carregarListaEspecialistas(success, id_especilidade);
            }, erro => {
                loader(false);
                return
            }
        )


    } else {
        bootboxAlert("Selecione ao menos uma especialidade!");
    }

})

$("#salvarCadastro").click(function () {
    var form = $("#formCadastro")
    if (form[0].checkValidity()) {
        salvarAgendamento();
    }
    form.addClass('was-validated');
})

$('#modalAgendamento').on('hidden.bs.modal', function () {
    id_especilidade = null;
    id_profissional = null;
    $('#dtNascimento').val('');
    $('#nome').val('');
    $('#cpf').val('');
    $('#listaComoConheceu').val();
})

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
 * Função que retorna a lista de locais que o usuario posso ter vindo a conhecer a clinica
 */
function getListaComoConheceu() {
    apiFeegowPatient = new ApiFeegowPatient(this.token);
    apiFeegowPatient.listSources().then(
        sucesso => {
            sucesso.content.forEach(element => {
                $("#listaComoConheceu").append("<option value='" + element.origem_id + "'>" + element.nome_origem + "</option>");
            });
        }, erro => {
            console.log('erro')
        }
    )
}

/**
 * Função que retorna a lista de profissionais da especialidade selecionada
 * @param {*} id_especilidade 
 */
function getListaProssifionais(id_especilidade) {
    return new Promise((resolve, reject) => {
        apiFeegowProfessional = new ApiFeegowProfessional(token);
        apiFeegowProfessional.list(true, null, id_especilidade).then(
            sucesso => {
                resolve(sucesso.content);
            }, erro => {
                reject('erro')
            }
        )
    });
}

/**
 * Função que preenche a lista de Profissionais
 * @param {*} lista 
 * @param {*} id_especilidade 
 */
function carregarListaEspecialistas(lista, id_especilidade) {

    if (lista.length > 0) {
        var htmlCard = '<div class="card shadow rounded-lg m-2 " style="width: 18rem; display:none; height: 170px">' +
            '                        <div class="card-body">' +
            '                            <div style="float: left; height:145px"> ' +
            '                               <img src="' + (lista[0].foto != null ? lista[0].foto : './../../assets/professional.jpg') + '" class="rounded-circle float-left mr-2" style="width:80px;height:70px;">' +
            '                            </div> ' +
            '                            <div style="height:80px">' +
            '                               <h6 class="card-title">' + lista[0].nome + '</h6>' +
            '                               <h7 class="card-subtitle mb-2 text-muted">' + (lista[0].conselho != null ? lista[0].conselho + ' ' + lista[0].documento_conselho : 'Sem documento') + '</h7>' +
            '                            </div>' +
            '                            <button class="btn btn-lg btn-success mt-1 rounded-pill " type="button" onclick="abrirModalAgendamento(' + id_especilidade + ', ' + lista[0].profissional_id + ')">Agendar</button>' +
            '                        </div>' +
            '                    </div>';


        $(htmlCard).appendTo('#listaEspecialistas').fadeIn("slow");
        lista.shift();
        carregarListaEspecialistas(lista, id_especilidade)
    }else{
        loader(false);
    }

}


/**
 * Função responsavel pela abertura do modal de agendamento.
 * @param {*} specialty_id 
 * @param {*} professional_id 
 */
function abrirModalAgendamento(specialty_id, professional_id) {
    id_especilidade = specialty_id;
    id_profissional = professional_id;
    $('#modalAgendamento').modal('show')
}


/**
 * Função que verifica se o cpf informado pelo usuário é valido
 * @param {*} cpf 
 */
function validarCPF(cpf) {
    if (cpf != "") {
        apiGatewayService = new ApiGatewayService();
        apiGatewayService.apiRequest('ajax/validar.cpf.php', { "cpf": cpf }).then(
            sucesso => {
                return;
            }, erro => {
                $('#cpf').val('');
            }
        )
    }

}


/**
 * Função responsavel por salvado o agendamento do usuário no banco;
 */
function salvarAgendamento() {
    dtNascimento = $('#dtNascimento').val();
    dtNascimento = dtNascimento.split('/');
    dtNascimento = dtNascimento[2] + '-' + dtNascimento[1] + '-' + dtNascimento[0];
    var dadosPost = {
        specialty_id: id_especilidade,
        professional_id: id_profissional,
        name: $('#nome').val(),
        cpf: $('#cpf').val(),
        source_id: $('#listaComoConheceu').val(),
        birthdate: new Date(dtNascimento).toISOString().slice(0, 19).replace('T', ' '),
        date_time: new Date().toISOString().slice(0, 19).replace('T', ' '),
    }
    apiGatewayService = new ApiGatewayService();
    apiGatewayService.apiRequest('ajax/salvar.agendamento.php', dadosPost).then(
        sucesso => {
            bootboxAlert("Dados salvos com sucesso!", function () { $('#modalAgendamento').modal('hide') });

        }, erro => {
            $('#cpf').val('');
        }
    )
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