
var app = new Vue({
    el: '#app',
    data: {
        unidade_id: 1,
        especialidade_id: '',
        listaEspecialidades: {},
        profissional: {},
        listaProfissionais: {},
        totalProfissionais: '',
        listaComoConheceu: {},
        agendamento: {
            specialty_id: '',
            professional_id: '',
            name: '',
            cpf: '',
            source_id: '',
            birthdate: '',
            date_time: ''
        },
        agendando: false,
        token: $('#token').val(),
    },
    methods: {
        limparListaProfisionais() {
            if (this.especialidade_id == "") {
                this.totalProfissionais = '';
                this.listaProfissionais = {};
            }
        },
        buscarProfissionais() {
            if (this.especialidade_id != '') {
                this.loader(true);
                this.listaProfissionais = {};
                apiFeegowProfessional = new ApiFeegowProfessional(this.token);
                apiFeegowProfessional.list(true, null, this.especialidade_id).then(
                    sucesso => {
                        this.listaProfissionais = sucesso.content;
                        this.totalProfissionais = this.listaProfissionais.length + ' ' + this.listaEspecialidades.find(x => x.especialidade_id == this.especialidade_id).nome + ' encontrado(s)';
                        this.loader(false, 500);
                    }, erro => {
                        this.loader(false);
                        console.log('erro')
                    }
                )
            } else {
                this.bootboxAlert("Selecione ao menos uma especialidade!");
            }

        },
        salvarAgendamento() {
            var form = $("#formCadastro")
            if (form[0].checkValidity() && agendando == false) {
                agendando = true;
                var birthdate = this.agendamento.birthdate;
                this.agendamento.birthdate = this.agendamento.birthdate.split('/');
                this.agendamento.birthdate = this.agendamento.birthdate[2] + '-' + this.agendamento.birthdate[1] + '-' + this.agendamento.birthdate[0];
                this.agendamento.birthdate = new Date(this.agendamento.birthdate).toISOString().slice(0, 19).replace('T', ' '),
                    this.agendamento.date_time = new Date().toISOString().slice(0, 19).replace('T', ' ');

                apiGatewayService = new ApiGatewayService();
                apiGatewayService.apiRequest('ajax/salvar.agendamento.php', this.agendamento).then(
                    sucesso => {
                        this.agendamento.source_id = '';
                        this.bootboxAlert("Dados salvos com sucesso!", function () { $('#modalAgendamento').modal('hide'); agendando = false; });
                    }, erro => {
                        this.agendamento.birthdate = birthdate;
                        this.bootboxAlert("Erro ao salvar agendamento, verifique todos os dados e tente novamente!", function () {
                            agendando = false;
                        });
                    }
                )
                form.removeClass('was-validated');
            } else {
                form.addClass('was-validated');
            }


        },
        abrirModalAgendamento(profissional) {
            this.agendamento.specialty_id = this.especialidade_id;
            this.agendamento.professional_id = profissional.profissional_id;
            $('#modalAgendamento').modal('show')
        },
        validarCPF() {
            if (this.agendamento.cpf != "") {
                apiGatewayService = new ApiGatewayService();
                apiGatewayService.apiRequest('ajax/validar.cpf.php', { "cpf": this.agendamento.cpf }).then(
                    sucesso => {
                        return;
                    }, erro => {
                        this.agendamento.cpf = null;
                    }
                )
            }

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
        limparAgendamento() {
            this.agendamento = {
                specialty_id: '',
                professional_id: '',
                name: '',
                cpf: '',
                source_id: '',
                birthdate: '',
                date_time: ''
            };
        },
        loader(exibir = false, timeout = 0) {
            if (exibir) {
                $('#loader').modal('show');
            } else {
                setTimeout(function () { $('#loader').modal('hide'); }, timeout);
            }

        },
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
        apiFeegowPatient = new ApiFeegowPatient(this.token);
        apiFeegowPatient.listSources().then(
            sucesso => {
                this.listaComoConheceu = sucesso.content;
            }, erro => {
                console.log('erro')
            }
        )

    }
});