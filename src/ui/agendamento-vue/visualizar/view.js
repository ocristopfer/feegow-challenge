
var app = new Vue({
    el: '#app',
    data: {
        especialidade_id: '',
        listaEspecialidades: {},
        totalAgendamentos: '',
        listaAgendamentos: {},
        token: $('#token').val(),
    },
    methods: {
        limparListaAgendamentos(limpar = false) {
            if (this.especialidade_id == "" || limpar == true) {
                this.listaAgendamentos = {};
            }
        },
        buscarAgendamentos() {
            this.loader(true);
            apiGatewayService = new ApiGatewayService();
            apiGatewayService.apiRequest('ajax/get.agendamentos.php', { "especialidade_id": this.especialidade_id }).then(
                sucesso => {
                    this.totalAgendamentos = sucesso.length + ' agendamentos encontrados';
                    this.listaAgendamentos = sucesso;
                    this.loader(false, 500);

                }, erro => {
                    $('#totalAgendamentos').text('0 agendamentos encontrados');
                    this.loader(false, 500);
                }
            )
        },

        bootboxAlert(msg, callbackFunction) {
            bootbox.alert({
                message: msg,
                centerVertical: true,
                callback: function (result) {
                    if (callbackFunction) {
                        callbackFunction();
                    }

                }
            });
        },
        loader(exibir = false, timeout = 0) {
            if (exibir) {
                $('#loader').modal('show');
            } else {
                setTimeout(function () { $('#loader').modal('hide'); }, timeout);
            }

        }

    },
    mounted() {

        //Carrega as especialidades
        apiFeegowSpecialties = new ApiFeegowSpecialties(this.token);
        apiFeegowSpecialties.list().then(
            sucesso => {
                this.listaEspecialidades = sucesso.content
            }, erro => {
                console.log('erro')
            }
        )

    }
});