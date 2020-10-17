<?php
include_once __DIR__ . '/../../../resources/api/seguranca/token/token.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link rel="icon" type="image/ico" href="./../../../assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./../../../plugins/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./../../../plugins/bootstrap/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" type="text/css" href="view.css" />
</head>

<body>
    <div id='app'>
        <input type="hidden" id="token" value="<?php echo Token::getToken() ?>">
        <div class="container">
            <div id="loader" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="width: 48px">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 mt-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Agendar Consulta
                    </h4>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="m-2">
                            <h5><b>Consulta de</b></h5>
                        </div>

                        <select v-model="especialidade_id" class="custom-select rounded m-1" @change="limparListaProfisionais" style="min-width: 300px;">
                            <option selected value="">Selecione a especialidade</option>
                            <option v-for="especialidades in listaEspecialidades" v-bind:value="especialidades.especialidade_id">
                                {{ especialidades.nome }}
                            </option>
                        </select>

                        <div class="m-1">
                            <button @click="buscarProfissionais" class="btn btn-success  rounded-pill" id="buscarEspecilistas" type="button">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="h5">{{totalProfissionais}}</p>
                </div>
                <div id="listaEspecialistas" class="d-flex flex-wrap justify-content-center">
                    <div v-if="listaProfissionais.length" v-for="profissional in listaProfissionais">
                        <div class="card shadow rounded-lg m-2 cardProfissional">
                            <div class="card-body">
                                <div class="areaFotoProfissional">
                                    <img v-if="profissional.foto" v-bind:src="profissional.foto" class="rounded-circle float-left mr-2 fotoProfissional">
                                    <img v-else src="./../../../assets/professional.jpg" class="rounded-circle float-left mr-2 fotoProfissional">
                                </div>
                                <div class="areaDescricaoProfissional">
                                    <h6 class="card-title">{{profissional.nome}}</h6>
                                    <h7 class="card-text" v-if="profissional.conselho">{{profissional.conselho}} {{profissional.documento_conselho}}</h7>
                                    <h7 class="card-text" v-else>Sem documento</h7>
                                </div>
                                <button class="btn btn-lg btn-success mt-1 rounded-pill " type="button" @click="abrirModalAgendamento(profissional)">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modalAgendamento" tabindex="-1" role="dialog" aria-labelledby="modalAgendamentoTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Preencha seu dados</h5>
                            <button type="button" class="close" data-dismiss="modal" @click="limparAgendamento()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formCadastro" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input required="required" type="text" class="form-control" v-model="agendamento.name" id="nome" name="nome" placeholder="Nome Completo" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <select required="required" v-model="agendamento.source_id" class="custom-select rounded m-1">
                                                <option selected value="">Como conheceu?</option>
                                                <option v-for="comoConheceu in listaComoConheceu" v-bind:value="comoConheceu.origem_id">
                                                    {{ comoConheceu.nome_origem }}
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <datepicker language="pt-BR" v-model="agendamento.birthdate" required="required" class="form-control" id="dtNascimento" placeholder="Nascimento" v-mask="'##/##/####'"></datepicker>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="agendamento.cpf" required="required" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="14" v-mask="'###.###.###-##'" v-on:blur="validarCPF()">
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal" @click="limparAgendamento">Cancelar</button>
                            <button type="button" class="btn btn-primary rounded-pill" @click="salvarAgendamento">Solicitar Horários</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3">
                <button class="btn btn-success rounded-pill" onclick="location.href='../'" type="button">Voltar</button>
            </div>
        </div>

    </div>

    <script type='text/javascript' src="./../../../plugins/jquery/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src="./../../../plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="./../../../plugins/bootstrap/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="./../../../plugins/bootstrap/bootstrap-datepicker.pt-BR.min.js"></script>

    <script type='text/javascript' src="./../../../plugins/vue/vue-2.6.12.js"></script>
    <script type='text/javascript' src="./../../../plugins/vue/vue-the-mask.js"></script>
    <script type='text/javascript' src='./../../../plugins/vue/datepicker.vue.js'></script>

    <script type='text/javascript' src="./../../../plugins/bootbox/bootbox.min.js"></script>

    <script type='text/javascript' src="./../../../resources/integracao/api.gateway.service.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.professional.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.specialties.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.patient.js"></script>

    <script type='text/javascript' src="view.js"></script>


</body>

</html>